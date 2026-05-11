<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/config.php');

class Database {

    private $connection;

    public function connect() {

        $config = DATABASE;

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        );

        try {
            $this->$connection = new PDO('mysql:host='.$config['HOST'].';dbname='.$config['DBNAME'].";port=".$config['PORT'], $config['USER_NAME'], $config['PASSWORD'], $options);
        } catch (PDOException $e) {
            die("Chyba pripojenia: " . $e->getMessage());
        }

    }

    public function getConnection() {
        return $this->$connection;
    }

}

?>