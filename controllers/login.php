<?php

    class LoginController extends Controller {

        public function __construct() {
            $this->setView('login');
        }

        private function googleLogin() {
            //It will Attempt to exchange a code for an valid authentication token.
            $token = GoogleAPI::$client->fetchAccessTokenWithAuthCode($_GET["code"]);

            //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
            if (!isset($token['error'])) {
                //Set the access token used for requests
                GoogleAPI::$client->setAccessToken($token['access_token']);

                //Store "access_token" value in $_SESSION variable for future use.
                $_SESSION['access_token'] = $token['access_token'];

                //Create Object of Google Service OAuth 2 class
                $google_service = new Google_Service_Oauth2(GoogleAPI::$client);

                //Get user profile data from google
                $data = $google_service->userinfo->get();

                Auth::googleLogin($data['given_name'], $data['email']);
                $this->sweetRefresh = ["Welcome " . Auth::getName(), "Login Successfully !"];

                //Below you can find Get profile data and store into $_SESSION variable
                /*if(!empty($data['given_name'])) {
                $_SESSION['user_first_name'] = $data['given_name'];
                }

                if(!empty($data['family_name']))
                {
                $_SESSION['user_last_name'] = $data['family_name'];
                }

                if(!empty($data['email']))
                {
                $_SESSION['user_email_address'] = $data['email'];
                }

                if(!empty($data['gender']))
                {
                $_SESSION['user_gender'] = $data['gender'];
                }

                if(!empty($data['picture']))
                {
                $_SESSION['user_image'] = $data['picture'];
                }*/
            }

        }

        private function defaultLogin() {
            if (empty($_POST['email']) or empty($_POST['password'])) {}
            else {
                $loginResult = Auth::login($_POST['email'], $_POST['password']);
                if ($loginResult === true) {
                    $this->sweetRefresh = ["Welcome " . Auth::getName(), "Login Successfully !"];
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
                    $this->tempEmail = $_POST['email'];
                }
            }
        }
        
        public function index() {
            // Already Login
            if (Auth::check()) {
                $this->setView('index');
            }
            else {
                if (empty($_GET['code'])) { $this->defaultLogin(); }
                else { $this->googleLogin(); }
            }
            $this->getView();
        }

    }

?>