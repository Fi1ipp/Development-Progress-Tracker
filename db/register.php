<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/users.php');

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$con_password = $_POST["confirm_password"];

if (empty($name) || empty($email) || empty($password) || empty($con_password)) {
    die("Chyba: Všetky informácie musia byť vyplnené.");
}

try {
    if ($con_password != $password) {
        throw new Exception("Heslo musí byť v oboch poliach rovnaké.");
    }
    $user = new Users();
    $user->register($name, $email, $password, $con_password);
    return header (header: 'Location: http://localhost/Development%20Progress%20Tracker/index.php');
} catch (Exception $e) {
    http_response_code(response_code: 404);
    die('Chyba pri odosielaní správy do databázy!');
}
?>