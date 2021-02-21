<?php

    @session_start();
    require_once '../config.php'; 
    require_once '../' . PATH_LIB . 'model.php';
    require_once '../' . PATH_MODEL . 'product.php';
    Model::init();

    /*if () {

    }*/
    var_dump($_SESSION);
    foreach ($_SESSION['cart'] as $productId => $productIdArr) {
        foreach ($productIdArr as $productColorId => $amount) {
           // $_SESSION['cart'][$productId][$colorId]
        }
    }
   

?>