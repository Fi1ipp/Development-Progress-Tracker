
<header>
    <div>
        <a href="index.php">
            <img src="img/logo.png" height="40">
        </a>
    </div>
    <nav>
        <ul class="nav-element">
            <li><a href="index.php">Home</a></li>
            
            <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li><a href="user.php">'.htmlspecialchars($_SESSION['name']).'</a></li>';
                    echo '<li><a href="db/logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="login.php">Sign In</a></li>';
                }
            ?>
            
        </ul>
    </nav>
</header>