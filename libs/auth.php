<?php

    require_once PATH_MODEL . 'member.php';

    class Auth {

        public static function check() {
            return !empty($_SESSION[AUTH_USER]);
        }

        public static function username() {
            return $_SESSION[AUTH_USER];
        }

        public static function login($username, $password) {
            $result = Member::login($username, $password);
            if (isset($result['error'])) {
                return $result['error'];
            }
            else {
                $_SESSION[AUTH_USER] = $result;
                return true;
            }
        }

        public static function logout() {
            if (self::check()) {
                unset($_SESSION[AUTH_USER]);
            }
        }

    }


?>