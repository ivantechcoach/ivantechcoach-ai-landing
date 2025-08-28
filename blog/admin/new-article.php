<?php
session_start();
require_once '../config/db.php'; // Incluir la conexión mysqli

// Proteger la página: si no está logueado, redirigir al login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$message = '';
$message_type = ''; // 'success' o 'error'

// Valores por defecto para el formulario (útil para repoblar en caso de error)
$title = $slug = $excerpt = $content = $image = '';
$category = '';

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $excerpt = trim($_POST['excerpt']);
    $content = trim($_POST['content']);
    $category = trim($_POST['category']);
    $image = trim($_POST['image']); // Por ahora, solo una ruta

    // --- Validación del lado del servidor ---
    if (empty($title) || empty($slug) || empty($content) || empty($category)) {
        $message = 'Por favor, rellena todos los campos obligatorios (Título, Slug, Contenido, Categoría).';
        $message_type = 'error';
    } else {
        if ($conn) { // Asegurarse de que la conexión existe
            try {
                // Verificar si el slug ya existe para evitar duplicados
                $stmt = $conn->prepare("SELECT COUNT(*) FROM articles WHERE slug = ?");
                $stmt->bind_param('s', $slug);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_row();
                if ($row[0] > 0) {
                    $message = 'El slug ya existe. Por favor, elige uno diferente.';
                    $message_type = 'error';
                } else {
                    // Insertar el artículo en la base de datos
                    $stmt = $conn->prepare("INSERT INTO articles (title, slug, excerpt, content, category, image) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param('ssssss', $title, $slug, $excerpt, $content, $category, $image);
                    if ($stmt->execute()) {
                        $message = 'Artículo creado con éxito.';
                        $message_type = 'success';

                        // Limpiar los campos del formulario después de un envío exitoso
                        $title = $slug = $excerpt = $content = $image = '';
                        $category = ''; // Resetear categoría
                    } else {
                        $message = 'Error al crear el artículo: ' . $stmt->error;
                        $message_type = 'error';
                    }
                    $stmt->close();
                }
            } catch (Exception $e) {
                error_log("Error al crear artículo: " . $e->getMessage());
                $message = 'Error al crear el artículo: ' . $e->getMessage();
                $message_type = 'error';
            }
        } else {
            $message = 'Error: Conexión a la base de datos no disponible.';
            $message_type = 'error';
        }
    }
}

// Categorías del informe inicial
$categories = [
    'Ciberseguridad práctica 🛡️',
    'Guías tecnológicas 💻',
    'Inteligencia Artificial accesible 🤖',
    'Tutoriales paso a paso 📝',
    'Historias & Personal Branding 🌟',
    'Proyectos y Comunidad 🌍'
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Artículo - Admin</title>
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Crear Nuevo Artículo</h2>
            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
        <nav class="admin-nav">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="new-article.php" class="active">Crear Nuevo Artículo</a></li>
                <li><a href="manage-articles.php">Gestionar Artículos</a></li>
            </ul>
        </nav>
        <div class="dashboard-content">
            <?php if ($message): ?>
                <p class="message <?php echo $message_type; ?>"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <form action="new-article.php" method="POST" id="newArticleForm">
                <div class="form-group">
                    <label for="title">Título del Artículo:</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title ?? ''); ?>" required>
                    <span class="error-text" id="titleError"></span>
                </div>

                <div class="form-group">
                    <label for="slug">Slug (URL amigable):</label>
                    <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($slug ?? ''); ?>" required>
                    <span class="error-text" id="slugError"></span>
                </div>

                <div class="form-group">
                    <label for="excerpt">Resumen (para el listado):</label>
                    <textarea id="excerpt" name="excerpt" rows="3"><?php echo htmlspecialchars($excerpt ?? ''); ?></textarea>
                    <span class="error-text" id="excerptError"></span>
                </div>

                <div class="form-group">
                    <label for="content">Contenido Completo (HTML):</label>
                    <textarea id="content" name="content" rows="15" required><?php echo htmlspecialchars($content ?? ''); ?></textarea>
                    <span class="error-text" id="contentError"></span>
                </div>

                <div class="form-group">
                    <label for="category">Categoría:</label>
                    <select id="category" name="category" required>
                        <option value="">Selecciona una categoría</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo (isset($category) && $category === $cat) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-text" id="categoryError"></span>
                </div>

                <div class="form-group">
                    <label for="image">URL de Imagen Destacada (Opcional):</label>
                    <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($image ?? ''); ?>">
                    <span class="error-text" id="imageError"></span>
                </div>

                <button type="submit" class="btn-primary">Crear Artículo</button>
            </form>
        </div>
    </div>
    <script src="js/validation.js"></script>
    <script>
        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slugInput = document.getElementById('slug');
            // Simple slug generation: lowercase, replace spaces with hyphens, remove non-alphanumeric
            let slug = title.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        });
    </script>
</body>
</html>
