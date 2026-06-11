<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
define('__PATH__', "/Development%20Progress%20Tracker");
require_once(__ROOT__.'/db/site.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php echo '<link rel="stylesheet" href="'.__PATH__.'/css/styles.css">' ?>
    <?php echo '<link rel="stylesheet" href="'.__PATH__.'/css/form.css">' ?>
    <?php echo '<link rel="stylesheet" href="'.__PATH__.'/css/mainSite.css">' ?>

</head>

<body>
    <?php   
        require __ROOT__."/parts/menu.php";
        require __ROOT__."/parts/header.php";

    ?>

    <div id="container"></div>


    <script src="<?php echo __PATH__.'/functions/trackers.js'; ?>"></script>

    <script>

        <?php
            $site = new Site();

            $ids = basename($_SERVER['PHP_SELF'], '.php');
            $ids = explode("_", $ids);

            $data = $site->getData($ids[0], $ids[1]);



            if ($ids[0] === $_SESSION['user_id']) {

                echo 'const trackers = new Trackers(localStorage.getItem("'.basename($_SERVER['PHP_SELF'], '.php').'") , JSON.stringify(' . $data . '));';
                echo 'document.getElementById("container").appendChild(trackers.loadTrackerBase());';

            }

        ?>

    </script>


    
</body>
</html>