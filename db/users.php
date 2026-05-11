<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/database.php');

class Users extends Database {

    public function __construct(){
        $this->connect();
        $this->connection = $this->getConnection();
    }



    public function register($name, $email, $password, $con_password) {
        try {

            if ($con_password == $password) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            } else {
                throw new Exception(message: "Heslo nieje rovnaké.");
            }
            
            $sql = "SELECT * FROM users WHERE (name = ? OR email = ?) LIMIT 1;";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $name);
            $statement->bindParam(2, $email);
            $statement->execute();
            $existingUser = $statement->fetch();

            if ($existingUser) {
                throw new Exception(message: "Požívateľ už existuje.");
            }
            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $name);
            $statement->bindParam(2, $email);
            $statement->bindParam(3, $hashedPassword);
            $statement->execute();
        }catch (Exception $e) {
            echo "Chyba pri vkladaní dát do databázy: ".$e->getMessage();
        } finally {
            $this->connection=null;
        }
    }



    public function login($name, $email, $password) {
        $sql = "SELECT * FROM users WHERE (name = ? OR email = ?)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $name);
        $statement->bindParam(2, $email);
        $statement->execute();
        $user = $statement->fetch();
        if (!$user) {
            throw new Exception(message: "Požívateľ s daným menom neexistuje.");
        }

        $storedPassword = $user['password'];
        if (!password_verify($password, $storedPassword)) {
            throw new Exception(message: "Nesprávne heslo.");
        }

        session_start();
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['name'] = $user['name'];
    }



    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: http://localhost/Development%20Progress%20Tracker/index.php");
        exit();
    }

}

?>