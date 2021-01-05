<?php

    class ShopController extends Controller {

        public function __construct() {
            parent::__construct();
            $this->view->setView('shop');
        }
        
        public function index() {
            $this->view->productData = $this->model->getProduct();
            $this->view->prodTypeData = $this->model->getProductType();
            $this->view->getView();
        }

        public function show($id) {
            $this->view->getView();
        }

    }

?>