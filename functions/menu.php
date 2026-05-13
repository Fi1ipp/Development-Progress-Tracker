<?php
error_reporting(E_ERROR | E_PARSE);
require_once(__ROOT__.'/db/database.php');

    function getDefaults() {
        $dir = __ROOT__."/user_websites/default";
        $files = glob( $dir . "/*.php");
        
        foreach ($files as $file) {
            echo '<li><a href="'.__PATH__.substr($file, strlen(__ROOT__)).'">'.substr(substr($file,strlen($dir)+1,strlen($file)),0,-4).'</a></li><br><br>';
        }
    }
?>