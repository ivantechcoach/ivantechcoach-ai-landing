<?php
session_start(); // Iniciar la sesión

// Si el usuario ya está logueado, redirigir al dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error_message = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'invalid_credentials') {
        $error_message = 'Usuario o contraseña incorrectos.';
    } elseif ($_GET['error'] == 'empty_fields') {
        $error_message = 'Por favor, rellena todos los campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Ivan Tech Coach</title>
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Acceso al Panel de Administración</h2>
            <?php if ($error_message): ?>
                <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <form action="auth.php" method="POST" id="loginForm">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required>
                    <span class="error-text" id="usernameError"></span>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                    <span class="error-text" id="passwordError"></span>
                </div>
                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    <script src="js/validation.js"></script>
</body>
</html>
