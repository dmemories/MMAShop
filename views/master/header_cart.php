<?php

    require_once PATH_MODEL . 'product.php';
    $totalPriceAll = 0.00;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productId => $val) {
            foreach ($val as $colorId => $amount) {
                $pData = Product::get(["where" => "`product_id` = " . $productId])[0];
                $price = $pData['product_price'];
                $totalPriceAll += ($price * $amount);
            }
        }
    }
?>
<div class="header__top__right__cart">
    <a href="<?=PATH_ROOT . "cart";?>"><img src="<?=PATH_IMG;?>icon/cart.png" alt="" style="width: 23px; height: 27px;"> <!--<span>0</span>--></a>
    <div class="cart__price">Cart: <span>$<?=$totalPriceAll;?></span></div>
</div>