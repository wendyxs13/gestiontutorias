<?php
error_reporting(E_ALL);
class Connection {

    protected static $instance;
    private static $dsn = 'mysql:host=localhost;dbname=ataapares;port=3306';
    private static $username;
    private static $password;

    // Método para inicializar los valores según la IP
    private static function init() {
        if ($_SERVER['SERVER_ADDR'] == '148.206.96.7') {
            self::$username = 'vicente_apli';
            self::$password = 'VAzcZdCBgRW10';
        } else {
            self::$username = 'root';
            self::$password = '';
        }
    }

    private function __construct() {
        try {
            self::$instance = new PDO(self::$dsn, self::$username, self::$password);
            //self::$instance = new PDO(self::$dsn, self::$username, self::$password, array(PDO::ATTR_PERSISTENT => true));
        } catch (PDOException $e) {
            //echo "Problemas al conectar:" . $e->getMessage();
            echo "Problemas con la conexión";
        }
    }

    private function __clone() {
        
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::init(); // Llamamos al método para inicializar credenciales
            new Connection();
        }
        return self::$instance;
    }

}
