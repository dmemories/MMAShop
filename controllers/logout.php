<?php

    class LogoutController extends Controller {

        public function __construct() {}
        
        public function index() {
            Auth::logout();
            foreach ($_SESSION as $key => $val) {
                unset($_SESSION[$key]);
            }
            Router::redirect("login");
        }

    }

?>