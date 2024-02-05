<?php
namespace App\Library;

use PDO;
use PDOException;

class Database {
    private $driver;
    private $host;
    private $db;
    private $username;
    private $password;
    private static $instance = null;

    private function __construct($driver, $host, $db, $username, $password) {
        $this->driver = $driver;
        $this->host = $host;
        $this->db = $db;
        $this->username = $username;
        $this->password = $password;
    }

    public static function getInstance($driver, $host, $db, $username, $password) {
        if (self::$instance === null) {
            self::$instance = new self($driver, $host, $db, $username, $password);
        }
        return self::$instance;
    }

    public function connect() {
        try {
            $dsn = "{$this->driver}:host={$this->host};dbname={$this->db}";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }

    // Prevenir la clonación del objeto
    function __clone() { }

    // Prevenir la deserialización del objeto
    function __wakeup() { }
}
