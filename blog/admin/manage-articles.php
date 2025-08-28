<?php
session_start();
require_once '../config/db.php'; // Incluir la conexión mysqli

// Proteger la página: si no está logueado, redirigir al login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$message = '';
$message_type = '';

// --- Lógica para eliminar artículo ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $article_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($article_id > 0) {
        if ($conn) { // Asegurarse de que la conexión existe
            try {
                $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
                $stmt->bind_param('i', $article_id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $message = 'Artículo eliminado con éxito.';
                    $message_type = 'success';
                } else {
                    $message = 'No se encontró el artículo para eliminar o ya fue eliminado.';
                    $message_type = 'error';
                }
                $stmt->close();
            } catch (Exception $e) {
                error_log("Error al eliminar artículo: " . $e->getMessage());
                $message = 'Error al eliminar el artículo: ' . $e->getMessage();
                $message_type = 'error';
            }
        } else {
            $message = 'Error: Conexión a la base de datos no disponible.';
            $message_type = 'error';
        }
    }
} else {
    $message = 'ID de artículo no válido para eliminar.';
    $message_type = 'error';
    }
}

// Obtener todos los artículos (después de intentar eliminar, para que la lista se actualice)
$articles = []; // Inicializar array
if ($conn) { // Asegurarse de que la conexión existe
    try {
        $stmt = $conn->prepare('SELECT id, title, category, created_at FROM articles ORDER BY created_at DESC');
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
        $stmt->close();
    } catch (Exception $e) {
        error_log("Error al obtener artículos para gestión: " . $e->getMessage());
        $message = 'Error al cargar los artículos.';
        $message_type = 'error';
        $articles = [];
    }
} else {
    error_log("Error: Conexión a la base de datos no disponible en manage-articles.php");
    $message = 'Error al cargar los artículos (conexión DB no disponible).';
    $message_type = 'error';
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Artículos - Admin</title>
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Gestionar Artículos</h2>
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

            <?php if (!empty($articles)): ?>
                <table class="articles-table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Fecha de Publicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($article['title']); ?></td>
                                <td><?php echo htmlspecialchars($article['category']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($article['created_at'])); ?></td>
                                <td class="actions">
                                    <a href="edit-article.php?id=<?php echo $article['id']; ?>" class="btn-action edit">Editar</a>
                                    <form action="manage-articles.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este artículo? Esta acción es irreversible.');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                        <button type="submit" class="btn-action delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay artículos para gestionar. <a href="new-article.php">Crea uno nuevo</a>.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
