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
        $this->host = getenv('DB_HOST') ?: 'xcow0g8cwkgkgwggw4kko0s0';
        $this->user = getenv('DB_USER') ?: 'mysql';
        $this->pass = getenv('DB_PASS') ?: 'G11avYQ2gtsAN0Sx58u8QSOUEDoBhWnPDUydzv720s9Z4s2OHcirA7rnzOSLcyLC';
        $this->ddbb = getenv('DB_NAME') ?: 'inventario_db';

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
 