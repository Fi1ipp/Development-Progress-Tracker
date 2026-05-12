<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/users.php');

$old_password = $_POST["old_password"];
$new_password = $_POST["new_password"];
$con_new_password = $_POST["con_new_password"];

if (empty($old_password) || empty($new_password) || empty($con_new_password)) {
    die("Chyba: Všetky informácie musia byť vyplnené.");
}

try {
    $user = new Users();
    $id = $_SESSION['user_id'];
    $user->newPassword($id, $old_password, $new_password, $con_new_password);
    return header (header: 'Location: http://localhost/Development%20Progress%20Tracker/index.php');
} catch (Exception $e) {
    http_response_code(response_code: 404);
    die($e->getMessage());
}
?>