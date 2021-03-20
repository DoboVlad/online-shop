<?php 
    include "connection.php";
    class Database {
        private static $db;
        private $connection;
    
        private function __construct() {
            $this->connection = new MySQLi(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        }
    
    
        public static function getConnection() {
            if (self::$db == null) {
                self::$db = new Database();
            }
            return self::$db->connection;
        }
    }
   