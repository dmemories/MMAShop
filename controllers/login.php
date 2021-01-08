<?php

    class LoginController extends Controller {

        public function __construct() {
            $this->setView('login');
        }
        
        public function index() {
            // Already Login
            if (Auth::check()) {
                $this->setView('index');
            }
            else {
                if (empty($_POST['username']) or empty($_POST['password'])) {}
                else {
                    $loginResult = Auth::login($_POST['username'], $_POST['password']);
                    if ($loginResult === true) {
                        $this->sweetRefresh = ["Welcome " . Auth::username(), "Login Successfully !"];
                    }
                    else {
                        if (isset($loginResult['error'])) {
                            $this->sweetAlert = [
                                "type" => "error",
                                "title" => "Login Failed !",
                                "text" => $loginResult['error']
                            ];
                        }
                        else if (isset($loginResult['warning'])) {
                            $this->sweetAlert = [
                                "type" => "warning",
                                "title" => "Login Failed !",
                                "text" => $loginResult['warning']
                            ];
                        }
                    }
                }
            }
            $this->getView();
        }

    }

?>