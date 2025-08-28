<?php
session_start();
require_once '../config/db.php'; // Incluir la conexión mysqli

// Proteger la página
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$message = '';
$message_type = ''; // 'success' o 'error'

$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article = null;

// Obtener datos del artículo si se proporciona un ID válido
if ($article_id > 0) {
    if ($conn) { // Asegurarse de que la conexión existe
        try {
            $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
            $stmt->bind_param('i', $article_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $article = $result->fetch_assoc();
            $stmt->close();

            if (!$article) {
                $message = 'Artículo no encontrado.';
                $message_type = 'error';
                $article_id = 0; // Invalidar ID si el artículo no se encuentra
            }
        } catch (Exception $e) {
            error_log("Error al obtener artículo para edición: " . $e->getMessage());
            $message = 'Error al cargar el artículo para edición.';
            $message_type = 'error';
            $article_id = 0;
        }
    } else {
        $message = 'Error: Conexión a la base de datos no disponible.';
        $message_type = 'error';
        $article_id = 0;
    }
} else {
    $message = 'ID de artículo no proporcionado.';
    $message_type = 'error';
}

// Manejar el envío del formulario (lógica de actualización)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $article_id > 0) {
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $excerpt = trim($_POST['excerpt']);
    $content = trim($_POST['content']);
    $category = trim($_POST['category']);
    $image = trim($_POST['image']);

    // Validación del lado del servidor
    if (empty($title) || empty($slug) || empty($content) || empty($category)) {
        $message = 'Por favor, rellena todos los campos obligatorios (Título, Slug, Contenido, Categoría).';
        $message_type = 'error';
    } else {
        if ($conn) { // Asegurarse de que la conexión existe
            try {
                // Verificar si el slug ya existe para *otro* artículo
                $stmt = $conn->prepare("SELECT COUNT(*) FROM articles WHERE slug = ? AND id != ?");
                $stmt->bind_param('si', $slug, $article_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_row();
                if ($row[0] > 0) {
                    $message = 'El slug ya existe para otro artículo. Por favor, elige uno diferente.';
                    $message_type = 'error';
                } else {
                    // Actualizar el artículo en la base de datos
                    $stmt = $conn->prepare("UPDATE articles SET title = ?, slug = ?, excerpt = ?, content = ?, category = ?, image = ? WHERE id = ?");
                    $stmt->bind_param('ssssssi', $title, $slug, $excerpt, $content, $category, $image, $article_id);
                    if ($stmt->execute()) {
                        $message = 'Artículo actualizado con éxito.';
                        $message_type = 'success';

                        // Volver a obtener los datos del artículo para mostrar los valores actualizados en el formulario
                        $stmt->close(); // Cerrar el stmt anterior antes de crear uno nuevo
                        $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
                        $stmt->bind_param('i', $article_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $article = $result->fetch_assoc();
                        $stmt->close();
                    } else {
                        $message = 'Error al actualizar el artículo: ' . $stmt->error;
                        $message_type = 'error';
                    }
                }
            } catch (Exception $e) {
                error_log("Error al actualizar artículo: " . $e->getMessage());
                $message = 'Error al actualizar el artículo: ' . $e->getMessage();
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
    <title>Editar Artículo - Admin</title>
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Editar Artículo</h2>
            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
        <nav class="admin-nav">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="new-article.php">Crear Nuevo Artículo</a></li>
                <li><a href="manage-articles.php" class="active">Gestionar Artículos</a></li>
            </ul>
        </nav>
        <div class="dashboard-content">
            <?php if ($message): ?>
                <p class="message <?php echo $message_type; ?>"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <?php if ($article): ?>
                <form action="edit-article.php?id=<?php echo $article_id; ?>" method="POST" id="editArticleForm">
                    <div class="form-group">
                        <label for="title">Título del Artículo:</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title'] ?? ''); ?>" required>
                        <span class="error-text" id="titleError"></span>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug (URL amigable):</label>
                        <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($article['slug'] ?? ''); ?>" required>
                        <span class="error-text" id="slugError"></span>
                    </div>

                    <div class="form-group">
                        <label for="excerpt">Resumen (para el listado):</label>
                        <textarea id="excerpt" name="excerpt" rows="3"><?php echo htmlspecialchars($article['excerpt'] ?? ''); ?></textarea>
                        <span class="error-text" id="excerptError"></span>
                    </div>

                    <div class="form-group">
                        <label for="content">Contenido Completo (HTML):</label>
                        <textarea id="content" name="content" rows="15" required><?php echo htmlspecialchars($article['content'] ?? ''); ?></textarea>
                        <span class="error-text" id="contentError"></span>
                    </div>

                    <div class="form-group">
                        <label for="category">Categoría:</label>
                        <select id="category" name="category" required>
                            <option value="">Selecciona una categoría</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo (isset($article['category']) && $article['category'] === $cat) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="error-text" id="categoryError"></span>
                    </div>

                    <div class="form-group">
                        <label for="image">URL de Imagen Destacada (Opcional):</label>
                        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($article['image'] ?? ''); ?>">
                        <span class="error-text" id="imageError"></span>
                    </div>

                    <button type="submit" class="btn-primary">Actualizar Artículo</button>
                </form>
            <?php else: ?>
                <p>No se pudo cargar el artículo para edición. Por favor, verifica el ID.</p>
                <a href="manage-articles.php" class="btn-primary">Volver a Gestionar Artículos</a>
            <?php endif; ?>
        </div>
    </div>
    <script src="js/validation.js"></script>
    <script>
        // Auto-generate slug from title (only if slug is empty)
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slugInput = document.getElementById('slug');
            if (slugInput.value.trim() === '') { // Only auto-generate if slug is empty
                let slug = title.toLowerCase().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });
    </script>
</body>
</html>
