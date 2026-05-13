<header>
    <div>
        <?php 
        echo '<a href="'.__PATH__.'/index.php">';
        echo    '<img src="'.__PATH__.'/img/logo.png" height="40"></a>';
        ?>
    </div>
    <nav>
        <ul class="nav-element">
            <?php
                echo '<li><a href="'.__PATH__.'/index.php">Home</a></li>';
        
                if (isset($_SESSION['user_id'])) {
                    echo '<li><a href="'.__PATH__.'/user.php">'.htmlspecialchars($_SESSION['name']).'</a></li>';
                    echo '<li><a href="'.__PATH__.'/db/logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="'.__PATH__.'/login.php">Sign In</a></li>';
                }
            ?>
            
        </ul>
    </nav>
</header>