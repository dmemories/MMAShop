<?php

    @session_start();

    if (!empty($_POST['pid']) && !empty($_POST['pcolorId'])) {
        $pid = $_POST['pid'];
        $pcolor = $_POST['pcolorId'];

        if ($_SESSION['cart'][$pid][$pcolor]) {
            unset($_SESSION['cart'][$pid][$pcolor]);

            $wantClearId = true;
            foreach ($_SESSION['cart'][$pid] as $key => $val) {
                if (!empty($_SESSION['cart'][$pid][$key])) { $wantClearId = false; break; }
            }
            if ($wantClearId) {
                unset($_SESSION['cart'][$pid]);
            }
        }
    }


?>