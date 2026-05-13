<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/user.css">
</head>

<?php
    session_start();
    define('__ROOT__', dirname(__FILE__));
    define('__PATH__', "/Development%20Progress%20Tracker");
?>

<body>
    <?php require __ROOT__."/parts/header.php"?>
    <div class="dif">

        <form style="height:inherit; padding-top:40px; padding-bottom:40px;">
            <button type="button" onclick="changeName()" >Change Username</button><br>
            <button type="button" onclick="changePW()" >Change Password</button><br>
            <button type="button" onclick="changeEmail()" >Change Email</button><br><br>
            <button type="button" onclick="deleteUser()" >Delete User</button>
        </form>

        
        <form action="db/username.php" method="post" style="display:none" id="username">
            <h2>Change Username:</h2>
            <label for="name">New Name:</label> 
            <input type="text" name="name" required placeholder="John Doe" maxlength="48"><br><br>
            <input type="submit" id="submit" value="Submit"><br>
        </form>

        <form action="db/password.php" method="post" style="display:none" id="password">
            <h2>Change Password:</h2>
            <label for="old_password">Old Password:</label>
            <input type="password" name="old_password" required><br><br>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required><br><br>

            <label for="con_new_password">Confirm New Password:</label>
            <input type="password" name="con_new_password" required><br><br>
            <input type="submit" id="submit" value="Submit"><br>
        </form>

        <form action="db/email.php" method="post" style="display:none" id="email">
            <h2>Change Mail:</h2>
            <label for="new_mail">New Mail:</label>
            <input type="text" name="new_mail" required><br><br>
            <input type="submit" id="submit" value="Submit"><br>
        </form>

        <form action="db/delete.php" method="post" style="display:none" id="delete">
            <h2>Delete User</h2>
            <label for="usure">Are You Sure?</label>
            <input type="checkbox" name="usure" required><br><br>
            <input type="submit" id="submit" value="Submit"><br>
        </form>

    </div>

    <script src="js/user.js"></script>

    
</body>
</html>