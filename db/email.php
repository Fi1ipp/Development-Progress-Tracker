<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/users.php');

$new_email = $_POST["new_mail"];

if (empty($new_email)) {
    die("Chyba: Všetky informácie musia byť vyplnené.");
}

try {
    $user = new Users();
    $id = $_SESSION['user_id'];
    $user->newEmail($id, $new_email);
    return header (header: 'Location: http://localhost/Development%20Progress%20Tracker/index.php');
} catch (Exception $e) {
    http_response_code(response_code: 404);
    die($e->getMessage());
}
?>