
        <form action="db/namechange.php" method="post">
            <h2>Change Username:</h2>
            <label for="name">New Name:</label> 
            <input type="text" name="name" required placeholder="John Doe" maxlength="48"><br><br>
            <input type="submit" id="submit" value="Submit"><br>
        </form>;

        <form action="db/pwchange.php" method="post">
            <h2>Change Password:</h2>
            <label for="old_password">Old Password:</label>
            <input type="password" name="old_password" required><br><br>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required><br><br>

            <label for="con_new_password">Confirm New Password:</label>
            <input type="password" name="con_new_password" required><br><br>
            <input type="submit" id="submit" value="Submit"><br>
        </form>;

        <form action="db/mailchange.php" method="post">
            <h2>Change Mail:</h2>
            <label for="new_mail">New Mail:</label>
            <input type="text" name="new_mail" required><br><br>
            <input type="submit" id="submit" value="Submit"><br>
        </form>;

        <form action="db/userDel.php" method="post">
            <h2>Delete User</h2>
            <label for="usure">Are You Sure?</label>
            <input type="checkbox" name="usure" required><br><br>
            <input type="submit" id="submit" value="Submit"><br>
        </form>;
