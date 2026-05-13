<?php
session_start();
define('__ROOT__', dirname(dirname(__FILE__)));
define('__PATH__', "/Development%20Progress%20Tracker");
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

        $trackers = array( ["To Do", true, ">0", [["test",[["test1",true],["test2",true]]],["test2",[["test2",false]]]]] , ["In Progress", true, "=100",[]] , ["Done", false, null, []]);
        $checked = "checked";

    ?>

    <?php echo '<div style="columns:'.count($trackers).';">'; 
        foreach ($trackers as $t) {
            echo '<div class="track">
            
               <h2>'.$t[0].'</h2>';

            foreach ($t[3] as $li) {
                echo ' <div class="li">
                
                <h3>'.$li[0].'</h3>';

                    foreach ($li[1] as $l) {
                        if ($l[1] === true) {
                            echo '<input type="checkbox" checked id="'.$li[0].'-'.$l[0].'" name="'.$li[0].'-'.$l[0].'">';
                            echo '<label for="'.$li[0].'-'.$l[0].'">'.$l[0].'</label><br><br>';
                        } else {
                            echo '<input type="checkbox" id="'.$li[0].'-'.$l[0].'" name="'.$li[0].'-'.$l[0].'">';
                            echo '<label for="'.$li[0].'-'.$l[0].'">'.$l[0].'</label><br><br>';
                        }
                    }
                echo '</div>';
            }
            
            echo '</div>';
        }
    ?>
    </div>

    
</body>
</html>