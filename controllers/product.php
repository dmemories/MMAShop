<?php

    class ProductController extends Controller {
        
        public function __construct() {
            $this->setView('product');
        }

        public function index($prodId = "") {
            if (!empty($prodId)) {
                $this->loadModel(["product", "product_color"]);
                $this->view->prodData = Product::get([
                    "where" => "`product_id` = " . $prodId,
                    'join' => ['product_type, product_type_id']
                ]);
                if (sizeof($this->view->prodData) > 0) {
                    $this->view->prodData = $this->view->prodData[0];
                    foreach (explode(",", str_replace(" ", "", $this->view->prodData['product_color_id'])) as $val) {
                        $this->view->prodColor[] = ProductColor::get([
                            "where" => "`product_color_id` = " . $val
                        ])[0];
                    }
                }
                else {
                    $this->view->prodData = "";
                }
                
                
            }
            $this->getView();
        }

    }

?>