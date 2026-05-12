<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/users.php');

try {
    $user = new Users();
    $id = $_SESSION['user_id'];
    $user->deleteUser($id);
    return header (header: 'Location: http://localhost/Development%20Progress%20Tracker/index.php');
} catch (Exception $e) {
    http_response_code(response_code: 404);
    die($e->getMessage());
}
?>