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

        public function index() {
            if (Auth::check()) {
                $this->setView('order');
                $orderDetailArr = OrderDetail::get([ 'where' => "member_id = " . $_SESSION[AUTH_ID] ]);
                foreach ($orderDetailArr as $orderDetail) {
                    $total = 0;
                    $productOrderArr = ProductOrder::get([ 'where' => "orderdetail_id = " . $orderDetail['orderdetail_id'] ]);
                    foreach ($productOrderArr as $productOrder) { $total += $productOrder['current_price']; }
                    $firstProduct = Product::get([ 'where' => "product_id = " . $productOrderArr[0]['product_id'] ])[0];
                    $productType = ProductType::get([ 'where' => "product_type_id = " . $firstProduct['product_type_id'] ])[0];
                    $orderStatus = OrderDetailStatus::get([ 'where' => "orderdetail_status_id  = " . $orderDetail['orderdetail_status_id'] ])[0];
                    $this->view->orderData[] = [
                        "img" => PATH_SHOP . $productType['type_name'] . '/' . $firstProduct['product_name'] . '/0.jpg',
                        "status" => $orderStatus['status_name'],
                        "total" => $total
                    ];
                }
/*
                        foreach ($productOrderArr as $productOrder) { 
                            $productData = Product::get(['where' => "product_id = " . $productOrder['product_id']])[0];
                            $productColor = ProductColor::get(['where' => "product_color_id LIKE '%" . $productOrder['product_color_id'] . "%'"])[0];
                            $orderData[] = [
                                'productId' => $productData['product_id'],
                            ];
                            
                            echo $productOrder['product_id'] . ":" . $productOrder['product_color_id'] . ":" . $productOrder['current_price'] . ":" . $productOrder['order_amount'] ;
                        }
                        $this->view->orderData[] = [
                            'orderDetailId' => $orderDetailId,
                            'orderData' => [],
                        ]; 
                    }
                    //$this->view->orderData = $orderDetailData[0];
                }
                else {
                    
                }*/
            }
            else
                $this->setView('login');
            
            
            $this->getView();
        }

    }

?>