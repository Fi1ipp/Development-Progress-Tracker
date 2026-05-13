<?php
    session_start();
    define('__ROOT__', dirname(dirname(dirname(__FILE__))));
    define('__PATH__', "/Development%20Progress%20Tracker");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php echo '<link rel="stylesheet" href="'.__PATH__.'/css/styles.css">' ?>
    <?php echo '<link rel="stylesheet" href="'.__PATH__.'/css/mainSite.css">' ?>
</head>

<body>
    <?php require(__ROOT__."/parts/menu.php")?>
    <?php require(__ROOT__."/parts/header.php")?>

    <p>hello</p>
    
</body>
</html>