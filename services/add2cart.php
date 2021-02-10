<?php

    @session_start();
    require_once '../config.php'; 
    require_once '../' . PATH_LIB . 'model.php';
    require_once '../' . PATH_MODEL . 'product.php';
    require_once '../' . PATH_MODEL . 'product_color.php';
    Model::init();

    if (empty($_POST['pid']) || empty($_POST['pamount']) || empty($_POST['cid'])) {
        echo "Invalid Data #1";
        exit();
    }

    $productId = $_POST['pid'];
    $productAmount = $_POST['pamount'];
    $colorId = $_POST['cid'];
    
    if ($productAmount > SHOP_MAXBUY) {
        echo "Invalid Data #2";
        exit();
    }
    
    $prodData = Product::get([
        'where' => "product.product_id = " . $productId . " AND product_color_id LIKE '%" . $colorId . "%'",
    ]);
    if (sizeof($prodData) < 1) {
        echo "Invalid Data #3";
        exit();
    }
    $prodData = ProductColor::get([
        'where' => "product_color_id = " . $colorId
    ]);
    if (sizeof($prodData) < 1) {
        echo "Invalid Data #4";
        exit();
    }

    $prodData = $prodData[0];

    if (isset($_SESSION['cart'][$productId][$colorId])) {
        $_SESSION['cart'][$productId][$colorId] += $productAmount;
        echo "1";
    }
    else {
        $_SESSION['cart'][$productId][$colorId] = $productAmount;
        echo "1";
    }

?>