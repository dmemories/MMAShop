<?php

    require_once PATH_MODEL . 'product.php';
    require_once PATH_MODEL . 'product_color.php';

    class CartController extends Controller {
        
        public function __construct() {
            $this->setView('cart');
        }

        public function index() {
            $this->getView();
        }

    }

?>