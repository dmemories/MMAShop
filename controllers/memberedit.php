<?php

    class membereditController extends Controller {

        public function __construct() {
            $this->loadModel(["member"]);
        }
        
        public function index() {
            if (Auth::check()) {
                $this->setView('memberedit');
                $this->view->email = $_SESSION[AUTH_EMAIL];
                $this->view->name = $_SESSION[AUTH_NAME];
                $memberData = Member::get(['where' => "member_id = " . $_SESSION[AUTH_ID]])[0];
                $this->view->tel = $memberData['tel'];
                $this->view->address = $memberData['address'];
                if (!empty($_POST['tel']) || !empty($_POST['address'])) {
                    if (strlen($_POST['tel']) < 10) {
                        $this->view->setAlertError("Update Failed !", "Invalid Tel !");
                    }
                    else if (strlen($_POST['address']) < 4) {
                        $this->view->setAlertError("Update Failed !", "Invalid Address !");
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
                        if ($updateResult === true) {
                            $this->view->setAlertHref("Done", "Update Successfully !", PATH_ROOT . "memberedit");
                        }
                        else {
                            if (isset($updateResult['error'])) {
                                $this->view->setAlertError("Update Failed !", $updateResult['error']);
                            }
                            else if (isset($updateResult['warning'])) {
                                $this->view->setAlertWarning("Update Failed !", $updateResult['warning']);
                            }
                        }
                    }
                }
                
            }
            else {
                $this->setView('login');
            }
            $this->getView();
        }

    }

?>