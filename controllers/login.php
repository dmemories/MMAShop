<?php

    class LoginController extends Controller {

        public function __construct() {
            $this->setView('login');
        }
        
        public function index() {
           
            $this->getView();
        }


    }

?>