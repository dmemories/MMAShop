<?php

    class ShopController extends Controller {

        public function __construct() {
            $this->loadModel(["product", "product_type"]);
            $this->setView('shop');
        }
        
        public function index() {
            $this->prodTypeData = ProductType::get([
                'where' => 'product_type_id = :x',
                'bind' => ['x' => 2]
                //'order' => ['product_type_id', 'desc']
            ]);
            $this->getView();
        }

        public function show($id) {
            $this->view->getView();
        }

    }

?>