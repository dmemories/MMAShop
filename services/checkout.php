<?php

    @session_start();
    require_once '../config.php'; 
    require_once '../' . PATH_LIB . 'model.php';
    require_once '../' . PATH_LIB . 'auth.php';
    require_once '../' . PATH_MODEL . 'member.php';
    require_once '../' . PATH_MODEL . 'product_order.php';
    require_once '../' . PATH_MODEL . 'product.php';
    require_once '../' . PATH_MODEL . 'order_detail.php';
    Model::init();

    if (Auth::check() !== true) {
        echo "0";
        exit();
    }
    else if (empty($_POST['name'])) {
        echo "3";
        exit();
    }
    else if (empty($_POST['mobile'])) {
        echo "4";
        exit();
    }
    else if (empty($_POST['address'])) {
        echo "5";
        exit();
    }

    
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
    $memberData = Member::get(['where' => "member_id = " . $_SESSION[AUTH_ID]])[0];
    if (!empty($_SESSION['cart'])) {
        $detailAdd = OrderDetail::add([
            'field' => "`orderdetail_id`, `datetime`, `orderdetail_status_id`, `member_id`, `fullname`, `tel`, `address`",
            'value' => Model::getQueryString([$maxOrderDetailId, 'current_timestamp()', $_SESSION[AUTH_TYPE], $_SESSION[AUTH_ID], $_POST['name'], $_POST['mobile'], $_POST['address']])
        ], false);
        if ($detailAdd) {
            foreach ($_SESSION['cart'] as $productId => $productIdArr) {
                if ($count < 0) break;
                foreach ($productIdArr as $productColorId => $amount) {
                    if ($amount > 0) {
                        $orderAdd = ProductOrder::add([
                            'field' => "`order_id`, `orderdetail_id`, `product_id`, `product_color_id`, `current_price`, `order_amount`",
                            'value' => Model::getQueryString(['NULL', $maxOrderDetailId, $productId, $productColorId, 500, $amount])
                        ], false);
                        if ($orderAdd) {
                            $count++;
                        }
                        else {
                            $count = -99999;
                            break;
                        }
                    }
                }
            }
        }
    }

    if ($count > 0) {
        OrderDetail::$db->commit();
        unset($_SESSION['cart']);
        echo "1";
    }
    else {
        OrderDetail::$db->rollBack();
        echo (($count == 0) ? "2" : "9999");
    }

?>