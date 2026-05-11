<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/users.php');
$user = new Users();
$user->logout();
?>