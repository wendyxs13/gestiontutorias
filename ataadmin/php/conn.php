<?php
error_reporting(E_ALL);
class Connection {

    protected static $instance;
    private static $dsn = 'mysql:host=localhost;dbname=ataapares;port=3306';
    
    private static $username = 'vicente_apli'; //root';
    private static $password = 'VAzcZdCBgRW10'; 

    private function __construct() {
        try {
            self::$instance = new PDO(self::$dsn, self::$username, self::$password);
            //self::$instance = new PDO(self::$dsn, self::$username, self::$password, array(PDO::ATTR_PERSISTENT => true));
        }catch (PDOException $e) {
            //echo "Problemas al conectar:" . $e->getMessage();
            echo "Problemas con la conexión";
        }
    }

    private function __clone (){ }

    public static function getInstance() {
        if (!self::$instance) {
            new Connection();
        }

        return self::$instance;
    }

}