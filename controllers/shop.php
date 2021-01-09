<?php

    class ShopController extends Controller {

        public function __construct() {
            $this->loadModel(["product", "product_type"]);
            $this->setView('shop');
            $this->view->prodTypeData = ProductType::get();
        }
        
        public function index() {
            $this->view->prodData = Product::get();
            $this->getView();
        }

        public function show($id = 0) {
            if (empty($id)) {
                $this->view->prodData = Product::get();
            }
            else {
                $this->view->prodData = Product::get(['where' => 'product_id = 1']);
            }
            $this->getView();
        }

    }

?>