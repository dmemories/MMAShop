<?php

class Model {

	public static $db;

	public static function init() {
		self::$db = new PDO(DB_TYPE . ":dbname=". DB_NAME .";host=" . DB_HOST, DB_USER, DB_PASS);
	}

	public static function getQueryString($dataArr) {
		$resultStr = (string) null;

		foreach ($dataArr as $val) {
			$resultStr .= ((strpos($val, "()") === false && strpos($val, "NULL") === false) ? "'" . $val . "'" : $val) . ",";
		}
		return rtrim($resultStr, ",");
	}

	public static function get($option = null) {

		
		if (isset($option['join'])) {
			$joinStr = (string) null;
			foreach ($option['join'] as $val) {
				$strArr = explode(",", $val);
				$tableName = str_replace(" ", "", $strArr[0]);
				$fieldName = str_replace(" ", "", $strArr[1]);
				$joinStr .= " INNER JOIN `" . $tableName . "` ON " . static::$table . "." . $fieldName . " = " . $tableName . "." . $fieldName;
			}
		}

		$sth = self::$db->prepare(
			"SELECT " . (isset($option['field']) ? $option['field'] : "*") .
			" FROM `". static::$table . "` " .
			(!empty($option['join']) ? $joinStr : (string) null) .
			(!empty($option['where']) ? " WHERE " . $option['where'] : (string) null) .
			(!empty($option['order']) ? " ORDER BY " . $option['order'][0] . " " . $option['order'][1] : (string) null) . ";"
		);
		
/*
		echo "SELECT " . (isset($option['field']) ? $option['field'] : "*") .
		" FROM `". static::$table . "` " .
		(!empty($option['join']) ? $joinStr : (string) null) .
		(!empty($option['where']) ? " WHERE " . $option['where'] : (string) null) .
		(!empty($option['order']) ? " ORDER BY " . $option['order'][0] . " " . $option['order'][1] : (string) null) . ";";
*/

		if (isset($option['bind'])) {
			foreach ($option['bind'] as $key => $val) {
				$key = ":" . str_replace(":", "", $key);
				$sth->bindValue("{$key}", $val);
			}
		}
		
		$sth->execute();
		return $sth->fetchAll((isset($option['fetch']) ? $option['fetch'] : PDO::FETCH_ASSOC));
	}

	public static function add($option = null, $wantRollback = true) {
		if ($wantRollback) {
			self::$db->beginTransaction();
		}


		$sth = self::$db->prepare(
			"INSERT INTO `" . static::$table . "` " .
			(isset($option['field']) ? "(". $option['field'] .")" : (string) null) . " " .
			"VALUES (" . $option['value'] . ")" .
			(isset($option['where']) ? "WHERE " . $option['where'] : (string) null) . ";"
		);
		if (isset($option['bind'])) {
			foreach ($option['bind'] as $key => $val) {
				$key = ":" . str_replace(":", "", $key);
				$sth->bindValue("{$key}", $val);
			}
		}


/*
		echo "INSERT INTO `" . static::$table . "` " .
			(isset($option['field']) ? "(". $option['field'] .")" : (string) null) . " " .
			"VALUES (" . $option['value'] . ")" .
			(isset($option['where']) ? "WHERE " . $option['where'] : (string) null) . ";";
*/


		$errMsg = (string) null;
		try {
			$sth->execute();
		}
		catch (PDOException $e) {
			$errMsg = $e->getMessage();
		}
		

		if ($wantRollback) {
			if (empty($errMsg)) {
				self::$db->commit();
				return true;
			}
			else {
				self::$db->rollBack();
				return false;
			}
		}
		else {
			return (empty($errMsg));
		}

	}

}

?>