<?php

class Connection {

    protected static $instance;
    private static $dsn = 'mysql:host=localhost;dbname=tutorias_enero;port=3306';
    
    private static $username = 'wendy';
    private static $password = '12345';

    private function __construct() {
        try {
            self::$instance = new PDO(self::$dsn, self::$username, self::$password);
            //self::$instance = new PDO(self::$dsn, self::$username, self::$password, array(PDO::ATTR_PERSISTENT => true));
        }catch (PDOException $e) {
            //echo "Problemas al conectar: xxxx" . $e->getMessage();
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