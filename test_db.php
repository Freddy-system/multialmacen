<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = getenv('DB_HOST') ?: 'xcow0g8cwkgkgwggw4kko0s0';
$user = getenv('DB_USER') ?: 'mysql';
$pass = getenv('DB_PASS') ?: 'G11avYQ2gtsAN0Sx58u8QSOUEDoBhWnPDUydzv720s9Z4s2OHcirA7rnzOSLcyLC';
$db = getenv('DB_NAME') ?: 'inventario_db';

echo "Intentando conectar a MySQL...\n";
echo "Host: $host\n";
echo "Usuario: $user\n";
echo "Base de datos: $db\n";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error . "\n");
} else {
    echo "¡Conexión exitosa a MySQL!\n";
    $conn->close();
}
