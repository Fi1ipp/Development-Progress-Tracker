<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/users.php');

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

if (empty($name) || empty($email) || empty($password)) {
    die("Chyba: Všetky informácie musia byť vyplnené.");
}

try {
    $user = new Users();
    $user->login($name, $email, $password);
    return header (header: 'Location: http://localhost/Development%20Progress%20Tracker/index.php');
} catch (Exception $e) {
    http_response_code(response_code: 404);
    die($e->getMessage());
}
?>