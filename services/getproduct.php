<?php

    require_once '../config.php'; 
    require_once '../' . PATH_LIB . 'model.php';
    require_once '../' . PATH_MODEL . 'product.php';
    Model::init();

    $condStr = (string) null;
    if (!empty($_GET['type'])) {
        $condStr .= "product.product_type_id = " . $_GET['type'];
    }
    if (!empty($_GET['name'])) {
        $condStr .= (strlen($condStr > 0) ? " AND " : "") . "product.product_name LIKE '%" . $_GET['name'] . "%'";
    }
    /*if (strlen($condStr > 0)) {
        $condStr = substr($condStr, 0, strlen($condStr) - 1);
    }*/
    
    $prodData = Product::get([
        'where' => $condStr,
        'order' => (empty($_GET['order']) ? (string) null : [$_GET['order'], "asc"]),
        'join' => ['product_type, product_type_id']
    ]);

    $totalProd = 0;
    foreach ($prodData as $key => $val) {
        $totalProd++;
        echo "
        <div class=\"col-lg-3 col-md-6 col-sm-6\">
            <div class=\"product__item\">
                <a href=\"product/". $val['product_id'] ."\">
                    <div class=\"product__item__pic set-bg\" style=\"cursor: pointer; background-image: url('../". PATH_SHOP . $val['type_name'] . "/" . $val['product_name'] . "/0.jpg')\">
                        <div class=\"product__label\">
                            <span>". $val['type_name'] ."</span>
                        </div>
                    </div>
                    </a>
                <div class=\"product__item__text\">
                    <h6><a href=\"#\">". $val['product_name'] ."</a></h6>
                    <div class='product_itembuy'>
                        <div class=\"product__item__price\">฿". $val['product_price'] ."</div>
                        <div class=\"cart_add\">
                            <a href=\"#\">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
    echo "<input type='hidden' id='totalResult' value='" . $totalProd . "'/>";

?>