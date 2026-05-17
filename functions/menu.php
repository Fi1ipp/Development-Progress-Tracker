<?php
error_reporting(E_ERROR | E_PARSE);
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/database.php');
require_once(__ROOT__.'/db/site.php');

    function getDefaults() {
        $dir = __ROOT__."/user_websites/default";
        $files = glob( $dir . "/*.php");
        
        foreach ($files as $file) {
            echo '<li><a href="'.__PATH__.substr($file, strlen(__ROOT__)).'">'.substr(substr($file,strlen($dir)+1,strlen($file)),0,-4).'</a></li><br><br>';
        }
    }

    function getUsersites() {

        $site = new Site();

        $id = $_SESSION['user_id'];
        $dir = __ROOT__."/user_websites";
        $files = glob( $dir . "/*.php");
        
        foreach ($files as $file) {
            $f = substr(substr($file,strlen($dir)+1,strlen($file)),0,-4);
            $check = explode("_",$f);

            if ($id == $check[0]) {
                $title = $site->getSiteName($check[0], $check[1]);

                $site_name = (strlen($title) > 10)?substr($title,0,10)."...":$title;

                $edit_btn = "<button onClick=editName('".$f."')>✎</button>";
                $delete_btn = "<button onClick=deleteProject('".$f."')>⌂</button>";

                echo '<li><a title="'.$title.'" href="'.__PATH__.substr($file, strlen(__ROOT__)).'">'.$site_name.' '.$edit_btn.$delete_btn.'</a></li><br>';
            }
        }
    }
?>