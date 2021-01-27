<?php

    class ProductController extends Controller {
        
        public function __construct() {
            $this->setView('product');
        }

        public function index() {
            $this->getView();
        }

    }

?>