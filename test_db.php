<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('max_execution_time', 10); // 10 segundos máximo

$host = getenv('DB_HOST') ?: 'xcow0g8cwkgkgwggw4kko0s0';
$user = getenv('DB_USER') ?: 'mysql';
$pass = getenv('DB_PASS') ?: 'G11avYQ2gtsAN0Sx58u8QSOUEDoBhWnPDUydzv720s9Z4s2OHcirA7rnzOSLcyLC';
$db = getenv('DB_NAME') ?: 'inventario_db';

echo "<pre>\n";
echo "PHP Version: " . phpversion() . "\n";
echo "Tiempo máximo de ejecución: " . ini_get('max_execution_time') . " segundos\n";
echo "\nIntentando resolver hostname...\n";
$ip = gethostbyname($host);
echo "IP del host '$host': $ip\n";

echo "\nVerificando si el puerto 3306 está abierto...\n";
$fp = @fsockopen($host, 3306, $errno, $errstr, 5);
if (!$fp) {
    echo "ERROR: No se puede conectar al puerto 3306 - $errstr ($errno)\n";
} else {
    echo "Puerto 3306 está abierto y accesible\n";
    fclose($fp);
}

echo "\nIntentando conectar a MySQL...\n";
echo "Host: $host\n";
echo "Usuario: $user\n";
echo "Base de datos: $db\n";

$startTime = microtime(true);

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        echo "\nError de conexión MySQL: " . $conn->connect_error . "\n";
        echo "Código de error: " . $conn->connect_errno . "\n";
    } else {
        $endTime = microtime(true);
        $duration = round($endTime - $startTime, 2);
        echo "\n¡Conexión exitosa a MySQL! (tomó $duration segundos)\n";
        
        // Probar una consulta simple
        $result = $conn->query("SELECT VERSION() as version");
        if ($result) {
            $row = $result->fetch_assoc();
            echo "Versión de MySQL: " . $row['version'] . "\n";
        }
        
        $conn->close();
    }
} catch (Exception $e) {
    echo "\nExcepción capturada: " . $e->getMessage() . "\n";
}

echo "</pre>";
