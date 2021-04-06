<?php

    require_once PATH_MODEL . 'order_detail.php';
    require_once PATH_MODEL . 'orderdetail_status.php';

    class AdminOrderController extends Controller {
        
        public function __construct() {}

        public function index() {
            if (Auth::admin()) { 
                $this->setView('admin_order');
                
                $orderStatus = OrderDetailStatus::get();
                $statusOption = "";
                foreach ($orderStatus as $val) {
                    $this->view->orderStatus[($val['orderdetail_status_id'])] = $val['status_name'];
                    $statusOption .= "<option value='". $val['orderdetail_status_id'] ."'>". $val['status_name'] ."</option>";
                }
               
                $orderDetail = OrderDetail::get(['where' => "orderdetail_status_id > 1"]);
                foreach ($orderDetail as $val) {
                    $optionSelectStr = "value='". $val['orderdetail_status_id'] . "'";
                    $this->view->orderData[] = [
                        'id' => $val['orderdetail_id'],
                        'date' => $val['payment_date'],
                        'status' => $this->view->orderStatus[($val['orderdetail_status_id'])],
                        'statusOption' => str_replace($optionSelectStr, $optionSelectStr . " selected", $statusOption)
                    ];
                }
            }
            else {
                $this->setView('login');
            }
            $this->getView();
        }

    }

?>