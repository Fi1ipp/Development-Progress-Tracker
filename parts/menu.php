<div class="side-menu">
    <nav>
        <ul class="menu-element">
            

            <?php 
            require(__ROOT__."/functions/menu.php");
            ?>

            <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="create"><a href="'.__PATH__.'/user_websites/create.php">+ Create Project</a></li><br><br>';
                    getUsersites();
                } else {
                    getDefaults();
                }
            ?>
            
        </ul>
    </nav>
</div>
<script src="<?php echo __PATH__.'/js/userSiteFunctions.js'; ?>"></script>