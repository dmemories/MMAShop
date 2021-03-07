<?php

    class membereditController extends Controller {

        public function __construct() {
            $this->loadModel(["member"]);
        }
        
        public function index() {
            if (empty($_POST['tel']) || empty($_POST['address'])) {
                if (Auth::check()) {
                    $this->setView('memberedit');
                    $this->view->email = $_SESSION[AUTH_EMAIL];
                    $this->view->name = $_SESSION[AUTH_NAME];
                    $memberData = Member::get(['where' => "member_id = " . $_SESSION[AUTH_ID]])[0];
                    $this->view->tel = $memberData['tel'];
                    $this->view->address = $memberData['address'];
                }
                else {
                    $this->setView('login');
                }
            }
            else {
                $updateResult = Member::update([
                    'set' => "tel=:tel, address=:addr",
                    'bind' => [
                        ':tel' => $_POST['tel'],
                        ':addr' => $_POST['address']
                    ],
                    'where' => "member_id = " . $_SESSION[AUTH_ID]
                ]);
                /*if ($updateResult === true) {
                    $this->view->setAlertHref("Done", "Register Successfully !", PATH_ROOT . "login");
                }
                else {
                    if (isset($updateResult['error'])) {
                        $this->view->setAlertError("Register Failed !", $updateResult['error']);
                    }
                    else if (isset($updateResult['warning'])) {
                        $this->view->setAlertWarning("Register Failed !", $updateResult['warning']);
                    }
                }*/
            }
            $this->getView();
        }

    }

?>