<?php
session_start(); // Iniciar la sesión

require_once '../config/db.php'; // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // --- Validación del lado del servidor ---
    if (empty($username) || empty($password)) {
        header('Location: login.php?error=empty_fields');
        exit;
    }

    // --- Verificar credenciales contra la base de datos ---
    $stmt = $conn->prepare("SELECT id, username, password_hash FROM admin_users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password_hash'])) {
        // Credenciales válidas
        session_regenerate_id(true); // Protección contra fijación de sesión
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $user['username'];
        
        // Configurar cookies de sesión seguras (HttpOnly y Secure)
        // Esto ya debería estar configurado en php.ini o en el servidor web para producción.
        // Para desarrollo local, HttpOnly es suficiente.
        ini_set('session.cookie_httponly', 1);
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            ini_set('session.cookie_secure', 1);
        }

        header('Location: dashboard.php');
        exit;
    } else {
        // Credenciales inválidas
        header('Location: login.php?error=invalid_credentials');
        exit;
    }
} else {
    // Si alguien intenta acceder directamente a auth.php sin POST, redirigir al login
    header('Location: login.php');
    exit;
}

// Cerrar la conexión a la base de datos al final del script si no se necesita más
$conn->close();
?>