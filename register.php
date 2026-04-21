<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="db/register-db.php" method="post">
        <label for="name">Name:</label> 
        <input type="text" name="name" required placeholder="John Doe" maxlength="48"><br><br>

        <label for="email">E-mail:</label>
        <input type="text" name="email" required placeholder="john.doe@email.com" maxlength="128"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required maxlength="40"><br><br>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br><br>
        
        <input type="submit" id="submit" value="Register"><br>
        <a href="login.php">Log In</a>
    </form>
</body>
</html>