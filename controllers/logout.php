<?php

    class LogoutController extends Controller {

        public function __construct() {}
        
        public function index() {
            Auth::logout();
            Router::redirect("login");
        }

    }

?>