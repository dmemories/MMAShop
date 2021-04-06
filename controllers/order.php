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
            if ($orderDetailId == "upload" && Auth::check()) {
                $orderDetailId = $_POST['orderId'];

                $orderDetail = OrderDetail::get([
                    'where' => "orderdetail_id = " . $orderDetailId . " AND member_id = " . $_SESSION[AUTH_ID]
                ]);
                if (sizeof($orderDetail) !== 1)
                    $errReason = "Error #01";
                else {
                    $orderDetail = $orderDetail[0];
                    $target_dir = "public/images/payment/";
                    $target_file = $target_dir . basename($_FILES["paymentfile"]["name"]);
                    $errReason = (string) null;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $imgShaName = hash('sha1', ($_SESSION[AUTH_ID] . $orderDetailId));
                    $allowType = ["jpg", "png", "jpeg"];

                    $check = getimagesize($_FILES["paymentfile"]["tmp_name"]);
                    if ($check == false) $errReason = "File is not an image.";
                    else if ($_FILES["paymentfile"]["size"] > 10485760) $errReason = "Sorry, your file is too large.";
                    else if ($orderDetail['orderdetail_status_id'] == 3) $errReason = "This order has been completed already.";
                    else if ($imageFileType != $allowType[0] && $imageFileType != $allowType[1] && $imageFileType != $allowType[2]) $errReason = "Sorry, only JPG, JPEG, PNG files are allowed.";
                    else {
                        foreach ($allowType as $fileType) {
                            if (file_exists($target_dir . $imgShaName . "." . $fileType))
                                unlink($target_dir . $imgShaName . "." . $fileType);
                        }
                        if (move_uploaded_file($_FILES["paymentfile"]["tmp_name"], $target_dir . $imgShaName . "." . $imageFileType) !== true)
                            $errReason = "Sorry, there was an error uploading your file.";
                    }
                }
                $this->setView('order');
                $this->view->orderData = [];
                if (empty($errReason)) {
                    date_default_timezone_set("Asia/Bangkok");
                    OrderDetail::update([
                        'set' => "orderdetail_status_id=:xxx, payment_date=:yyy",
                        'bind' => [':xxx' => '2', ':yyy' => date('Y-m-d H:i:s')],
                        'where' => "orderdetail_id = " . $orderDetailId . " AND orderdetail_status_id <> 3"
                    ]);
                    $this->view->setAlertHref("Upload Successfully !", "", "./" . $orderDetailId);
                }
                else
                    $this->view->setAlertHref($errReason, "", "./" . $orderDetailId, "error");
            }
            else if (empty($orderDetailId)) {
                if (Auth::check()) { 
                    $this->setView('order');
                    $this->view->orderData = [];
                    $orderDetailArr = OrderDetail::get([ 'where' => "member_id = " . $_SESSION[AUTH_ID] ]);
                    foreach ($orderDetailArr as $orderDetail) {
                        //$total = 0;
                        $productOrderArr = ProductOrder::get([ 'where' => "orderdetail_id = " . $orderDetail['orderdetail_id'] ]);
                        //foreach ($productOrderArr as $productOrder) { $total += ($productOrder['current_price'] * $productOrder['order_amount']); }
                        $firstProduct = Product::get([ 'where' => "product_id = " . $productOrderArr[0]['product_id'] ])[0];
                        $productType = ProductType::get([ 'where' => "product_type_id = " . $firstProduct['product_type_id'] ])[0];
                        $orderStatus = OrderDetailStatus::get([ 'where' => "orderdetail_status_id  = " . $orderDetail['orderdetail_status_id'] ])[0];
                        $this->view->orderData[] = [
                            "orderId" => $orderDetail['orderdetail_id'],
                            "href" => 'order/' . $orderDetail['orderdetail_id'],
                            "img" => PATH_SHOP . $productType['type_name'] . '/' . $firstProduct['product_name'] . '/0.jpg',
                            "status" => $orderStatus['status_name'],
                            //"total" => $total
                        ];
                    }
                }
                else $this->setView('login');
            }
            else {
                if (Auth::check()) { 
                    $orderDetail = OrderDetail::get([
                        'where' => "orderdetail_id = " . $orderDetailId . " AND member_id = " . $_SESSION[AUTH_ID]
                    ]);
                    // Owner order id
                    if (sizeof($orderDetail) === 1) {
                        $this->setView('orderdetail');
                        $this->view->orderId = $orderDetailId;
                        $this->view->orderDate = $orderDetail[0]['datetime'];
                        $this->view->name = $orderDetail[0]['fullname'];
                        $this->view->tel = $orderDetail[0]['tel'];
                        $this->view->address = $orderDetail[0]['address'];
                        $this->view->isComplete = $orderDetail[0]['orderdetail_status_id'];
                        $orderStatus = OrderDetail::get([
                            "where" => "`orderdetail_id` = " . $orderDetailId,
                            'join' => ['orderdetail_status, orderdetail_status_id']
                        ])[0];
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
                        
                        // Set img
                        $localPaymentPath = "./public/images/payment/";
                        $imgName = hash('sha1', $_SESSION[AUTH_ID] . $orderDetailId);

                        if (file_exists($localPaymentPath . $imgName . ".jpg"))
                            $this->view->paymentImg = PATH_PAYMENT . $imgName . ".jpg";
                        else if (file_exists($localPaymentPath . $imgName . ".png"))
                            $this->view->paymentImg = PATH_PAYMENT . $imgName . ".png";
                        else
                            $this->view->paymentImg = PATH_PAYMENT . "noimg.png";
                    }
                    else {
                        // Not found order id
                        $this->setView('order');
                        $this->view->orderData = [];
                    }
                }
                else {
                    $this->setView('login');
                }
            }
            
            $this->getView();
        }

    }

?>