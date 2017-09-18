<div id=header>
    <h1>Social News</h1>
</div>

<div id=login>
    <?php
        if($_SESSION[validation] != "1")
        {
            echo '<form action="login.php" method="post">
                        Login:
                        <input type="text" name="username" size="14">
                        Password:
                        <input type="password" name="password" size="14" >
                        <button type="submit" name="send">Send</button>
                        <a id="register_content" href="#"><h5>Register</h5></a>
                    </form>';
        } else
        {
            echo 'User: '.$_SESSION[username].'<br>';
            echo 'Permition: '.$_SESSION[permitionLevel].'<br><br>';
            echo '<a id="panel" href="#">Panel</a><br>';
            echo '<a href="logout.php">Logout</a>';
        }
    ?>
</div>

<div id=menu>
    <ul>
        <li><a id="home" href="#">Home</a></li>
        <li><a id="last_news" href="#">Last News</a></li>
    </ul>

</div>