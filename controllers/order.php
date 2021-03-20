<?php

    require_once PATH_MODEL . 'order_detail.php';
    require_once PATH_MODEL . 'orderdetail_status.php';
    require_once PATH_MODEL . 'product.php';
    require_once PATH_MODEL . 'product_order.php';
    require_once PATH_MODEL . 'product_color.php';
    require_once PATH_MODEL . 'product_type.php';

    class OrderController extends Controller {
        
        public function __construct() {
            //$this->setView('order');
        }

        public function index($orderDetailId = 0) {
            if (empty($orderDetailId)) {
                if (Auth::check()) { 
                    $this->setView('order');
                    $this->view->orderData = [];
                    $orderDetailArr = OrderDetail::get([ 'where' => "member_id = " . $_SESSION[AUTH_ID] ]);
                    foreach ($orderDetailArr as $orderDetail) {
                        $total = 0;
                        $productOrderArr = ProductOrder::get([ 'where' => "orderdetail_id = " . $orderDetail['orderdetail_id'] ]);
                        foreach ($productOrderArr as $productOrder) { $total += ($productOrder['current_price'] * $productOrder['order_amount']); }
                        $firstProduct = Product::get([ 'where' => "product_id = " . $productOrderArr[0]['product_id'] ])[0];
                        $productType = ProductType::get([ 'where' => "product_type_id = " . $firstProduct['product_type_id'] ])[0];
                        $orderStatus = OrderDetailStatus::get([ 'where' => "orderdetail_status_id  = " . $orderDetail['orderdetail_status_id'] ])[0];
                        $this->view->orderData[] = [
                            "href" => 'order/' . $firstProduct['product_id'],
                            "img" => PATH_SHOP . $productType['type_name'] . '/' . $firstProduct['product_name'] . '/0.jpg',
                            "status" => $orderStatus['status_name'],
                            "total" => $total
                        ];
                    }
                }
                else $this->setView('login');
            }
            else {
                $this->setView('orderdetail');
                /*
                    if (isOwnerDetailId)  next
                    else send err msg
                */
                
                
                $orderStatus = OrderDetailStatus::get([ 'where' => "orderdetail_status_id  = " . $orderDetailId ])[0];
                $this->view->status = $orderStatus['status_name'];

                $total = 0;
                $productOrderArr = ProductOrder::get(['where' => "orderdetail_id = " . $orderDetailId]);
                foreach ($productOrderArr as $productOrder) {
                    $product = Product::get([ 'where' => "product_id = " . $productOrder['product_id'] ])[0];
                    $productType = ProductType::get([ 'where' => "product_type_id = " . $product['product_type_id'] ])[0];
                    $sum = $productOrder['current_price'] * $productOrder['order_amount'];
                    $total += $sum;
                    $this->view->orderData[] = [
                        "proId" => $productOrder['product_id'],
                        "proImg" => PATH_SHOP . $productType['type_name'] . '/' . $product['product_name'] . '/0.jpg',
                        "currPrice" => $productOrder['current_price'],
                        "orderAmount" => $productOrder['order_amount'],
                        "sum" => $sum
                    ];
                }
                $this->view->total = $total;
            }
            
            $this->getView();
        }

    }

?>