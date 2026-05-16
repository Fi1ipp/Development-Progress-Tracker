<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/site.php');

$id = $_POST["id"];
$site_id = $_POST["site_id"];

try {
    $user_id = $_SESSION['user_id'];
    if ($user_id == $id) {
        $site = new Site();
        $site->deleteProject($id,$site_id);
    }
    return header (header: 'Location: http://localhost/Development%20Progress%20Tracker/index.php');
} catch (Exception $e) {
    http_response_code(response_code: 404);
    die('Chyba pri odosielaní správy do databázy!');
}
?>