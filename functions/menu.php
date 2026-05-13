<?php
    function getDefaults() {
        $dir = __ROOT__."/user_websites/default";
        $files = glob( $dir . "/*.php");
        
        foreach ($files as $file) {
            echo '<li><a href="'.__PATH__.substr($file, strlen(__ROOT__)).'">'.substr($file,strlen($dir)+1,strlen($file)).'</a></li><br><br>';
        }

    }
?>