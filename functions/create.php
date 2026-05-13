<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/site.php');

$name = $_POST["name"];

if (empty($name)) {
    die("Chyba: Všetky informácie musia byť vyplnené.");
}

try {
    $site = new Site();
    $id = $_SESSION['user_id'];
    $site->createSite($id, $name);
    return header (header: 'Location: http://localhost/Development%20Progress%20Tracker/index.php');
} catch (Exception $e) {
    http_response_code(response_code: 404);
    die('Chyba pri odosielaní správy do databázy!');
}
?>