<?php
/**
 * db.sample.php
 * Archivo de configuración de la base de datos (ejemplo).
 * Copia este archivo a db.php y rellena tus credenciales reales.
 * Asegúrate de añadir db.php a tu .gitignore para no subirlo al repositorio.
 */

// Credenciales de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', ''); // Vacío para XAMPP por defecto
define('DB_NAME', 'qanw953');

// Conexión a la base de datos usando MySQLi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$conn->set_charset("utf8mb4");

// Opcional: Configurar PDO para compatibilidad si se usa en otras partes del código
// Aunque la solicitud es usar mysqli, el código existente del blog usa PDO.
// Para una transición suave, podemos inicializar PDO aquí también, o refactorizar todo a mysqli.
// Por ahora, mantendremos PDO para no romper el blog inmediatamente, pero la conexión principal será mysqli.
// La refactorización a mysqli en todo el blog se hará en un paso posterior.

// Ejemplo de inicialización de PDO (si se decide mantenerlo temporalmente)
// try {
//     $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASSWORD);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// } catch (PDOException $e) {
//     die("Error de conexión PDO: " . $e->getMessage());
// }

?>