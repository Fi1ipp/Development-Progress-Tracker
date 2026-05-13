<?php
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
            $existingUser = $statement->fetch();

            if ($existingUser) {
                throw new Exception(message: "Rovnaká stránka už existuje.");
            }

            $sql = "INSERT INTO user_sites (user_id, name) VALUES (?, ?)";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id);
            $statement->bindParam(2, $name);
            $statement->execute();


            $content = "hello";
            $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/myText.txt","wb");
            fwrite($fp,$content);
            fclose($fp);

        }catch (Exception $e) {
            echo "Chyba pri vkladaní dát do databázy: ".$e->getMessage();
        } finally {
            $this->connection=null;
        }
    }

}

?>