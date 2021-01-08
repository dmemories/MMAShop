<?php

    class Member extends Model {

        public static $table = "member";

        public static function login($username, $password) {
            if (!preg_match("/^[a-z0-9]{4,20}+$/i", $username)) {
                return ['error' => "Username ของคุณต้องเป็นตัวอักษร a-z หรือ 0-9 และมีความยาว 4-20 ตัวอักษร"];
            }
            else if (!preg_match("/^[a-z0-9]{4,20}+$/i", $password)) {
                return ['error' => "Password ของคุณต้องเป็นตัวอักษร a-z หรือ 0-9 และมีความยาว 4-20 ตัวอักษร"];
            }
            $result = self::get([
                'where' => "`username` = :user AND `password` = :pass",
                'bind' => [
                    ':user' => $username,
                    ':pass' => $password
                ]
            ]);
            switch (sizeof($result)) {
                case 0: return ['warning' => "Invalid username or password !"];
                case 1: return $result[0]['username'];
                case 2: return ['error' => "login error #01"];
            }
        }


        /*$query = $conn->prepare("SELECT account_id, userid FROM `login` WHERE userid=? AND user_pass=?;");
		$query->bind_param("ss", $id, $pass);
		$query->execute();
		$result = $query->get_result();
		$query->close();
		if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
			$_SESSION['accid'] = $data['account_id'];
			$_SESSION['gameid'] = $data['userid'];
			echo "1";
		}
		else {
            echo "ID หรือ Password ผ่านไม่ถูกต้อง";
		}*/

    }

?>