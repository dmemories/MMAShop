<?php

    require_once PATH_MODEL . 'product.php';
    require_once PATH_MODEL . 'product_color.php';

    class CartController extends Controller {
        
        public function __construct() {
            $this->setView('cart');
        }

        public function index() {
            /*foreach ($_SESSION['cart'] as $key => $val) {
                unset($_SESSION['cart'][$key]);
            }*/
           // unset($_SESSION['cart']);
            foreach ($_SESSION['cart'] as $productId => $val) {
                foreach ($val as $colorId => $amount) {
                    //echo "PID [" . $productId . "] : Color [" . $colorId . "] : Amount : " . $amount . "<br/>";

                    $pData = ProductColor::get([
                        "where" => "`product_color_id` = " . $colorId,
                    ]);
                    $colorName = $pData[0]['color_name'];

                    $pData = Product::get([
                        "where" => "`product_id` = " . $productId,
                        'join' => ['product_type, product_type_id']
                    ]);
                    $pName = $pData[0]['product_name'];
                    $price = $pData[0]['product_price'];
                    $typeName = $pData[0]['type_name'];
                
                    $this->view->cartData[] = [
                        'productId' => $productId,
                        'color' => $colorName,
                        'price' => $price,
                        'imgPath' => $typeName . "/" . $pName . "/0.jpg",
                        'amount' => $amount
                    ];
                }
            }
            
            $this->getView();
        }

    }

?>