<ul>
    <li><a href="<?=PATH_ROOT;?>register">Register</a></li>
    <li>
    <?php
        if (Auth::check()) {
            echo Auth::getName() . "<span class=\"arrow_carrot-down\"></span><ul><li><a href=\"". PATH_ROOT . "memberedit" ."\">Edit</a></li><li><a href=\"". PATH_ROOT . "logout" ."\">Logout</a></li></ul>";
        }
        else {
            echo "<a href=\"". PATH_ROOT . "login" ."\">Login</a>";
        }
    ?>
    </li>
</ul>