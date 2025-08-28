<?php
/**
 * create_admin_user.php
 * Script temporal para crear un usuario administrador inicial.
 * ¡EJECUTAR UNA SOLA VEZ Y LUEGO ELIMINAR ESTE ARCHIVO!
 */

require_once '../config/db.php';

// Datos del usuario administrador a crear
$username = 'admin';
$password = 'adminpass'; // ¡CAMBIA ESTA CONTRASEÑA POR UNA SEGURA!
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// 1. Crear la tabla admin_users si no existe
$sql_create_table = "
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Tabla 'admin_users' creada o ya existe.<br>";
} else {
    echo "Error al crear la tabla: " . $conn->error . "<br>";
    $conn->close();
    exit;
}

// 2. Insertar el usuario administrador (solo si no existe ya)
$stmt = $conn->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?) ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash)");
$stmt->bind_param('ss', $username, $hashed_password);

if ($stmt->execute()) {
    echo "Usuario '" . htmlspecialchars($username) . "' creado/actualizado con éxito. Contraseña: '" . htmlspecialchars($password) . "' (¡CÁMBIALA!).<br>";
} else {
    echo "Error al insertar usuario: " . $stmt->error . "<br>";
}

$stmt->close();
$conn->close();

echo "<br>¡IMPORTANTE: Elimina este archivo (create_admin_user.php) de tu servidor inmediatamente después de usarlo!";
?>