<?php

    require_once PATH_MODEL . 'member.php';

    class Auth {

        public static function check() {
            return !empty($_SESSION[AUTH_NAME]) and !empty($_SESSION[AUTH_EMAIL]);
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
                $_SESSION[AUTH_NAME] = $result['name'];
                $_SESSION[AUTH_EMAIL] = $result['email'];
                return true;
            }
        }

        public static function googleLogin($name, $email) {
            $_SESSION[AUTH_NAME] = $name;
            $_SESSION[AUTH_EMAIL] = $email;
            return true;
        }

        public static function logout() {
            if (self::check()) {
                unset($_SESSION[AUTH_NAME]);
                unset($_SESSION[AUTH_EMAIL]);
                GoogleAPI::$client->revokeToken();
            }
        }

    }


?>