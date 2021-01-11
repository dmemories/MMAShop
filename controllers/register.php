<?php

    class RegisterController extends Controller {

        public function __construct() {
            $this->setView('register');
        }
        
        public function index() {
            $this->getView();
        }

    }

?>