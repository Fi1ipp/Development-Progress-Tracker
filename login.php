<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="db/login.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required placeholder="John Doe"><br><br>

        <label for="email">E-mail:</label>
        <input type="text" name="email" required placeholder="john.doe@email.com"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" id="submit" value="Log In"><br>
        <a href="register.php">Register</a>
    </form>
</body>
</html>