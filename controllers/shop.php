<?php

    class ShopController extends Controller {

        public function __construct() {
            $this->loadModel(["product_type"]);
            $this->setView('shop');
            $this->view->prodTypeData = ProductType::get();
        }
        
        public function index() {
            $this->getView();
        }


    }

?>