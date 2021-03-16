<?php

    require_once PATH_MODEL . 'order_detail.php';
    require_once PATH_MODEL . 'product.php';
    require_once PATH_MODEL . 'product_order.php';
    require_once PATH_MODEL . 'product_color.php';

    class OrderController extends Controller {
        
        public function __construct() {
            //$this->setView('order');
        }

        public function index() {
            if (Auth::check()) {
                $this->setView('order');
                $orderDetailArr = OrderDetail::get([ 'where' => "member_id = " . $_SESSION[AUTH_ID] ]);
                if (sizeof($orderDetailArr) > 0) {
                    foreach ($orderDetailArr as $orderDetail) {
                        $orderDetailId = $orderDetail['orderdetail_id'];
                        /* $productOrderArr = ProductOrder::get([ 'where' => "orderdetail_id = " . $orderDetailId ]);
                        $orderData = [];
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
                        ]; */
                    }
                    //$this->view->orderData = $orderDetailData[0];
                }
                else {
                    $this->view->orderData = [];
                }
            }
            else
                $this->setView('login');
            
            
            $this->getView();
        }

    }

?>