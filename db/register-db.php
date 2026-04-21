<?php
$host = "localhost";
$dbname = "devprogresstracker";
$port = 3306;
$username = "root";
$password = "";

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);

try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$dbname.";port=".$port, $username,
        $password, $options);
} catch (PDOException $e) {
    die("Chyba pripojenia: " . $e->getMessage());
}

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$con_password = $_POST["confirm_password"];

$sql = "INSERT INTO users (name, email, password) VALUE ('".$name."', '".$email."', '".$password."')";

try {

    if ($con_password != $password) { 
        $message = "Password is not the same";
        throw new Exception("Password not the same");
    }

    $insert = $conn->prepare($sql)->execute();
    header("Location: http://localhost/Development%20Progress%20Tracker/index.php");
    return $insert;
} catch (\Exception $e) {
    header("Location: http://localhost/Development%20Progress%20Tracker/register.php");
    return false;
}

$conn = null;

?>