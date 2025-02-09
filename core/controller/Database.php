<?php

class Database {
    private static $instance = null;
    private $con;

    private $user;
    private $pass;
    private $host;
    private $ddbb;

    private function __construct() {
        // Obtener valores de las variables de entorno
        $this->host = getenv('DB_HOST') ?: 'mysql-database-ec0wwcs8gss4ggcgsc4oww88';
        $this->user = getenv('DB_USER') ?: 'mysql';
        $this->pass = getenv('DB_PASS') ?: 'wWC1qD1Ax2hlU2Fs74oykyONTm0T6bzzEf80jYNLW6tOoNfiBpsPIr2N7Xkw2HBJ'; // La contraseña que configuramos
        $this->ddbb = getenv('DB_NAME') ?: 'multialmacen_db';

        $this->con = new mysqli($this->host, $this->user, $this->pass, $this->ddbb);

        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error); 
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->con;
    }
}
 