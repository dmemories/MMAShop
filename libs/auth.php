<?php
    
    @include_once PATH_MODEL . 'member.php';
    @include_once '../' . PATH_MODEL . 'member.php';
   

    class Auth {

        public static function check() {
            return !empty($_SESSION[AUTH_NAME]) && !empty($_SESSION[AUTH_EMAIL]);
        }

        public static function admin() {
            return ($_SESSION[AUTH_LV] == 99);
        }

        public static function getName() {
            return $_SESSION[AUTH_NAME];
        }

        public static function getEmail() {
            return $_SESSION[AUTH_EMAIL];
        }
        
        public static function login($email, $password) {
            $result = Member::login($email, $password);
            if (isset($result['error'])) {
                return ['error' => $result['error']];
            }
            else if (isset($result['warning'])) {
                return ['warning' => $result['warning']];
            }
            else {
                $_SESSION[AUTH_ID] = $result['member_id'];
                $_SESSION[AUTH_NAME] = $result['name'];
                $_SESSION[AUTH_EMAIL] = $result['email'];
                $_SESSION[AUTH_TYPE] = MEM_DEFAULT;
                $_SESSION[AUTH_LV] = $memData['member_level'];
                return true;
            }
        }

        public static function googleLogin($data) {
            $fullname = $data['given_name'] . " " . $data['family_name'];
            $email = $data['email'];
            
            $result = Member::get([
                'where' => "`email` = :email AND `member_group_id` = :mgroup",
                'bind' => [
                    ':email' => $email,
                    ':mgroup' => MEM_GOOGLE
                ]
            ]);

            // First Login with Google
            if (sizeof($result) < 1) {
                $regisSucc = Member::register([
                    'email' => $email,
                    'fullname' => $fullname,
                    'tel' => '',
                    'address' => ''
                    ], MEM_GOOGLE
                );
                $wantEditData = ($regisSucc ? true : false);
            }
            else {
                $wantEditData = false;
            }
            if (isset($result['error'])) {
                return ['error' => $result['error']];
            }
            else if (isset($result['warning'])) {
                return ['warning' => $result['warning']];
            }

            $memData = Member::get([
                'where' => "`email` = :email AND `member_group_id` = :mgroup",
                'bind' => [
                    ':email' => $email,
                    ':mgroup' => MEM_GOOGLE
                ]
            ])[0];
            
            $_SESSION[AUTH_ID] = $memData['member_id'];
            $_SESSION[AUTH_NAME] = $memData['fullname'];
            $_SESSION[AUTH_EMAIL] = $memData['email'];
            $_SESSION[AUTH_TYPE] = MEM_GOOGLE;
            $_SESSION[AUTH_LV] = $memData['member_level'];
            return ['wantEdit' => $wantEditData];
        }

        public static function logout() {
            if (self::check()) {
                unset($_SESSION[AUTH_NAME]);
                unset($_SESSION[AUTH_EMAIL]);
                unset($_SESSION[AUTH_TYPE]);
                unset($_SESSION[AUTH_LV]);
                GoogleAPI::$client->revokeToken();
            }
        }

    }


?>