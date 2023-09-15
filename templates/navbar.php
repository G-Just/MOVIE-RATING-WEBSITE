<div id="navbar">

        <a href="home.php">Home</a>
        <a href="view_ratings.php">View ratings</a>
        <a href="add_rating.php">Add rating</a>

        <div id="user-buttons">
                <?php
                if (isset($_SESSION['usersID'])) {
                        $username = $_SESSION['usersUsername'];
                        $id = $_SESSION['usersID'];
                        echo "<a href='profile.php'>$username</a>";
                        echo "<a href='includes_h/logout_h.php'>Logout</a>";
                } else {
                        echo "<a href='login.php'>Login</a>";
                        echo "<a href='signup.php'>Signup</a>";
                }
                ?>
        </div>

</div>