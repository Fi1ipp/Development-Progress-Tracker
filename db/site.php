<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/database.php');

class Site extends Database {

    public function __construct(){
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function createSite($id, $name) {
        try {  
            $sql = "SELECT * FROM user_sites WHERE (name = ? AND user_id = ?) LIMIT 1;";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $name);
            $statement->bindParam(2, $id);
            $statement->execute();
            $existingSite = $statement->fetch();

            if ($existingSite) {
                throw new Exception(message: "Rovnaká stránka už existuje.");
            }

            $sql = "INSERT INTO user_sites (user_id, name) VALUES (?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id);
            $statement->bindParam(2, $name);
            $statement->execute();

            $site_id = $this->connection->lastInsertId();

            
            $template = __ROOT__ . "/user_websites/template.php"; 
            $new_file = __ROOT__ . "/user_websites/" . $id."_".$site_id . ".php";

            copy($template, $new_file);

        }catch (Exception $e) {
            echo "Chyba pri vkladaní dát do databázy: ".$e->getMessage();
        } finally {
            $this->connection=null;
        }
    }

    public function getSiteName($id, $site_id) {
        $sql = "SELECT name FROM user_sites WHERE (user_id = ? AND site_id = ?) LIMIT 1;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->bindParam(2, $site_id);
        $statement->execute();
        $site_name = $statement->fetch();

        return $site_name['name'];

    }

    public function editProject($id, $site_id, $name) {

        $user_id = $_SESSION['user_id'];
        
        if ($user_id == $id) {
            try {

                $sql = "UPDATE user_sites SET name = ? WHERE user_id = ? AND site_id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->bindParam(1, $name);
                $statement->bindParam(2, $id);
                $statement->bindParam(3, $site_id);
                $statement->execute();

            } catch (Exception $e) {
                echo "Chyba pri aktualizovaní dát v databáze: ".$e->getMessage();
            }
        }
    }

    public function deleteProject($id, $site_id) {

        $user_id = $_SESSION['user_id'];
        
        if ($user_id == $id) {
            try {
                $sql = "DELETE FROM user_sites WHERE user_id = ? AND site_id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->bindParam(1, $id);
                $statement->bindParam(2, $site_id);
                $statement->execute();

                $file = __ROOT__ . "/user_websites/" . $id . "_" . $site_id . ".php";
                unlink($file);

            } catch (Exception $e) {
                echo "Chyba pri mazaní z databázy: ".$e->getMessage();
            }
        }
    }
}

?>