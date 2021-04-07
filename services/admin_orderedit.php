<?php

    @session_start();
    require_once '../config.php';
    require_once '../' . PATH_LIB . 'model.php';
    require_once '../' . PATH_LIB . 'auth.php';
    require_once '../' . PATH_MODEL . 'order_detail.php';

    Model::init();

    if (Auth::admin()) {
        $succ = OrderDetail::update([
            'set' => "orderdetail_status_id=:xxx",
            'bind' => [':xxx' => $_POST['statusid']],
            'where' => "orderdetail_id = " . $_POST['id']
        ]);
        echo ($succ ? "1" : "0");
    }
    else {
        exit();
    }

?>