<?php

    class RegisterController extends Controller {

        public function __construct() {
            $this->setView('register');
            $this->loadModel(["member"]);
        }
        
        public function index() {
            $regisData = [
                "email",
                "password",
                "fullname",
                "tel",
                "address"
            ];
            
            $inputCount = 0;
            foreach ($regisData as $val) {
                if (isset($_POST[$val])) {
                    $$val = $_POST[$val];
                    $this->view->$val = $$val;
                    $inputCount++;
                }
            }

            if ($inputCount >= sizeof($regisData)) {
                $regisResult = Member::register([
                    'email' => $email,
                    'password' => $password,
                    'fullname' => $fullname,
                    'tel' => $tel,
                    'address' => $address
                    ], MEM_DEFAULT
                );
                if ($regisResult === true) {
                    $this->view->setAlertHref("Done", "Register Successfully !", PATH_ROOT . "login");
                }
                else {
                    if (isset($regisResult['error'])) {
                        $this->view->setAlertError("Register Failed !", $regisResult['error']);
                    }
                    else if (isset($regisResult['warning'])) {
                        $this->view->setAlertWarning("Register Failed !", $regisResult['warning']);
                    }
                }
            }
            $this->getView();
        }

    }

?>