<?php

    class Member extends Model {
        public static $table = "member";

        public static function login($email, $password) {
            if (!preg_match("/^\w+@[a-z_]+?\.[a-zA-Z]{2,3}$/i", $email)) {
                return ['warning' => "Invalid email format !"];
            }
            else if (!preg_match("/^[a-z0-9]{4,20}+$/i", $password)) {
                return ['warning' => "Your password must be a-z or 0-9 and has 4-20 characters."];
            }
            $result = self::get([
                'where' => "`email` = :email AND `password` = :pass",
                'bind' => [
                    ':email' => $email,
                    ':pass' => $password
                ]
            ]);
            switch (sizeof($result)) {
                case 0: return ['warning' => "Invalid email or password !"];
                case 1: return ['name' => $result[0]['name'], 'email' => $result[0]['email']];
                case 2: return ['error' => "login error #01"];
            }
        }


        public static function register($data, $regisGroup) {
            $skipPass = true;
            switch ($regisGroup) {
                // MMA Member
                case MEM_DEFAULT :
                        $allKey = ['email', 'password', 'fullname', 'tel', 'address', 'province', 'tambon', 'postcode']; break;
                        $skipPass = false;
                // Google Member
                case MEM_GOOGLE : $allKey = ['email', 'fullname', 'tel', 'address', 'province', 'tambon', 'postcode']; break;
                // Unknown
                default : return ['erorr' => "Invalid group [". $regisGroup ."] !"]; break;
            }

            foreach ($allKey as $key) {
                if (!isset($data[$key])) {
                    echo ucwords($key) . " is invalid !";
                    return ['error' => ucwords($key) . " is invalid !"];
                }
                else { $$key = $data[$key]; }
            }
            
            if (!preg_match("/^\w+@[a-z_]+?\.[a-zA-Z]{2,3}$/i", $email)) {
                return ['warning' => "Invalid email format !"];
            }
            // MMA Member
            if (($skipPass === false) && (!preg_match("/^[a-z0-9]{4,23}+$/i", $password))) {
                return ['warning' => "Your password should be A-Z or 0-9 and has 4-23 characters !"];
            }

            $result = self::add([
                'field' => "member_id, member_group_id, member_level, email, fullname, tel, address, province, tambon, postcode",
                'value' => "NULL, :mgid, 0, :email, :fname, :tel, :addr, :prov, :tambon, :pcode",
                'bind' => [
                    ':mgid' => $regisGroup,
                    ':email' => $email,
                    ':fname' => $fullname,
                    ':tel' => $tel,
                    ':addr' => $address,
                    ':prov' => $province,
                    ':tambon' => $tambon,
                    ':pcode' => $postcode
                ]
            ]);
        }
    }

?>