<?php

    class ContactController extends Controller {
        
        public function __construct() {
            $this->setView('contact');
        }

        public function index() {
            $this->getView();
        }

    }

?>