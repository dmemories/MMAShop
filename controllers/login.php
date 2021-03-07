<?php

    class LoginController extends Controller {

        public function __construct() {
            $this->setView('login');
        }

        private function googleLogin() {
            $token = GoogleAPI::$client->fetchAccessTokenWithAuthCode($_GET["code"]);
             if (isset($token['error'])) {
                echo $token['error'];
                exit();
            }
            else {
                GoogleAPI::$client->setAccessToken($token['access_token']);
                $_SESSION['access_token'] = $token['access_token'];
                $google_service = new Google_Service_Oauth2(GoogleAPI::$client);

                $data = $google_service->userinfo->get();
                $loginResult = Auth::googleLogin($data);
                $this->view->setAlertHref("Welcome " . Auth::getName(), "Login Successfully !", PATH_ROOT . "shop");
            }
        }

        private function defaultLogin() {
            if (empty($_POST['email']) || empty($_POST['password'])) {}
            else {
                $loginResult = Auth::login($_POST['email'], $_POST['password']);
                if ($loginResult === true) {
                    $this->view->setAlertRefresh("Welcome " . Auth::getName(), "Login Successfully !");
                }
                else {
                    if (isset($loginResult['error'])) {
                        $this->view->setAlertError("Login Failed !", $loginResult['error']);
                    }
                    else if (isset($loginResult['warning'])) {
                        $this->view->setAlertWarning("Login Failed !", $loginResult['warning']);
                    }
                    $this->view->tempEmail = $_POST['email'];
                }
            }
        }
        
        public function index() {
            // Already Login
            if (Auth::check()) {
                $this->setView('index');
            }
            else {
                if (empty($_GET['code'])) {
                    $this->defaultLogin();
                }
                else {
                    $this->googleLogin();
                }
            }
            $this->getView();
        }

    }

?>