<?php

    class IndexController extends Controller {
        
        public function __construct() {
            $this->setView('index');
        }

        public function index() {
            $this->getView();
        }   

    }

?>