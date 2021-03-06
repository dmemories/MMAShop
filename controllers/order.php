<?php

    require_once PATH_MODEL . 'product.php';
    require_once PATH_MODEL . 'product_color.php';

    class OrderController extends Controller {
        
        public function __construct() {
            $this->setView('order');
        }

        public function index() {
            $this->getView();
        }

    }

?>