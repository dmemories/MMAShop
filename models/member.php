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