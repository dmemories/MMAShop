<?php

    class ShopController extends Controller {
        
        public function index() {
            $this->view->setView('shop')->getView();
        }

    }

?>