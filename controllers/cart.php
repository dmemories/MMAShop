<?php

    class CartController extends Controller {
        
        public function __construct() {
            $this->setView('cart');
        }

        public function index() {
            $this->getView();
        }

    }

?>