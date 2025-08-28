<?php
session_start(); // Iniciar la sesión

// Proteger la página: si no está logueado, redirigir al login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Opcional: Obtener el nombre de usuario para mostrarlo
$admin_username = isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : 'Administrador';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ivan Tech Coach Admin</title>
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Bienvenido, <?php echo htmlspecialchars($admin_username); ?>!</h2>
            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
        <nav class="admin-nav">
            <ul>
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="new-article.php">Crear Nuevo Artículo</a></li>
                <li><a href="manage-articles.php">Gestionar Artículos</a></li>
            </ul>
        </nav>
        <div class="dashboard-content">
            <h3>Resumen del Blog</h3>
            <p>Aquí podrás ver estadísticas rápidas y accesos directos a las funciones principales.</p>
            <!-- Contenido del dashboard -->
        </div>
    </div>
</body>
</html>
