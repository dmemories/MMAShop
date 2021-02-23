<?php

    @session_start();
    require_once '../config.php'; 
    require_once '../' . PATH_LIB . 'model.php';
    require_once '../' . PATH_MODEL . 'product_order.php';
    require_once '../' . PATH_MODEL . 'product.php';
    require_once '../' . PATH_MODEL . 'order_detail.php';
    Model::init();

    $orderDetailQuery = OrderDetail::get(['field' => "MAX(orderdetail_id) as max_id"]);
    if (empty($orderDetailQuery[0]['max_id'])) {
        $maxOrderDetailId = 0;
    }
    else {
        $maxOrderDetailId = $orderDetailQuery[0]['max_id'];
    }
    $maxOrderDetailId++;

    $count = 0;
    OrderDetail::$db->beginTransaction();
    foreach ($_SESSION['cart'] as $productId => $productIdArr) {
        foreach ($productIdArr as $productColorId => $amount) {
            if ($amount > 0) {
                $detailAdd = OrderDetail::add([
                    'field' => "`orderdetail_id`, `datetime`, `orderdetail_status_id`, `member_id`, `fullname`, `tel`, `address`",
                    'value' => Model::getQueryString([$maxOrderDetailId, 'current_timestamp()', 1, 6, 'dear', '1234567', 'dddddddddd'])
                ], false);
                if ($detailAdd) {
                    $orderAdd = ProductOrder::add([
                        'field' => "`order_id`, `orderdetail_id`, `product_id`, `product_color_id`, `current_price`, `order_amount`",
                        'value' => Model::getQueryString(['NULL', $maxOrderDetailId, $productId, $productColorId, 500, $amount])
                    ], false);
                    if ($orderAdd) {
                        $count++;
                    }
                    else {
                        $count = -99999;
                        break; break;
                    }
                }
            }
        }
    }
    if ($count > -1) {
        OrderDetail::$db->commit();
        echo (($count == 0)? "2" : "1");
    }
    else {
        OrderDetail::$db->rollBack();
        echo "3";
    }

?>