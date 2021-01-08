<?php

session_start();
require_once 'config.php';
require_once PATH_LIB . 'auth.php';
require_once 'vendor/autoload.php'; // Google API

class GoogleAPI {

	public static $client;
	public static function init() {
		self::$client = new Google_Client();
		self::$client->setClientId('156691773247-fm3ca4uok2qj7nat41kp9n0h1kntcmgv.apps.googleusercontent.com');
		self::$client->setClientSecret('YdOCrMuZegbUo6iJMhGpNH2H');
		self::$client->setRedirectUri('http://127.0.0.1/MMAShop/login');
		self::$client->addScope('email');
		self::$client->addScope('profile');
	}
	
}

class Model {

	public static $db;

	public static function init() {
		self::$db = new PDO(DB_TYPE . ":dbname=". DB_NAME .";host=" . DB_HOST, DB_USER, DB_PASS);
	}

	public static function get($option = null) {
		$sth = self::$db->prepare(
			"SELECT " . (isset($option['field']) ? $option['field'] : "*") .
			" FROM `". static::$table . "`" .
			(isset($option['where']) ? "WHERE " . $option['where'] : (string) null) .
			(isset($option['order']) ? "ORDER BY " . $option['order'][0] . " " . $option['order'][1] : (string) null) . ";"
		);
		if (isset($option['bind'])) {
			foreach ($option['bind'] as $key => $val) {
				$key = ":" . str_replace(":", "", $key);
				$sth->bindValue("{$key}", $val);
			}
		}
		$sth->execute();
		return $sth->fetchAll((isset($option['fetch']) ? $option['fetch'] : PDO::FETCH_ASSOC));
	}

}

class Controller {

	private $viewName;

	protected function loadModel($modelArr) {
		foreach ($modelArr as $val) {
			require PATH_MODEL . $val . ".php";
		}
	}

	protected function setView($viewName) {
		$this->viewName = $viewName;
	}

	protected function getView($includeAll = true) {
		if ($includeAll) {
			require PATH_MVIEW . 'header.php';
			require PATH_VIEW . $this->viewName . '.php';
			require PATH_MVIEW . 'footer.php';
		}
		else {
			require PATH_VIEW . $this->viewName . '.php';
		}
	}

}

class Router {

	private $url = null;
	private $controller = null;
    private $defaultCtrName = 'index';
    
    public function __construct() {
        $this->setUrl();
		$this->loadContoller();
		$this->callFunction();
	}
	
	public static function redirect($url) {	
		header('Location: ' . $url);
        exit;
	}
    
    private function setUrl() {
		$this->url = isset($_GET['url']) ? $_GET['url'] : null;
		$this->url = str_replace('-', '', $this->url);
		$this->url = filter_var($this->url, FILTER_SANITIZE_URL);
		$this->url = rtrim($this->url, '/');
		$this->url = explode('/', $this->url);
    }

    private function setContoller($controllerName) {
        $controllerPath = PATH_CONTROLLER . $controllerName . ".php";
        if (file_exists($controllerPath)) {
            require $controllerPath;
            $className = strtoupper($controllerName[0]) . substr($controllerName, 1) . "Controller";
            $this->controller = new $className();
            return true;
        }
        else {
            return false;
        }
    }
    
    private function loadContoller() {
        $controllerName = (isset($this->url[0]) ? $this->url[0] : (string) null);
        if ($this->setContoller($controllerName) === false) {
            // Default
            if ($this->setContoller($this->defaultCtrName) === false) {
                exit("Invalid (" . $controllerName . ") Controller !");
            }
        }
	}

	private function callFunction() {
		$urlLength = sizeof($this->url);

		if ($urlLength > 1 and !method_exists($this->controller, $this->url[1])) {
			$this->controller->index();
			return;
		}

		switch ($urlLength) {
			case 5:
				//Controller->Method(Param1, Param2, Param3)
				$this->controller->{$this->url[1]}($this->url[2], $this->url[3], $this->url[4]);
				break;
			
			case 4:
				//Controller->Method(Param1, Param2)
				$this->controller->{$this->url[1]}($this->url[2], $this->url[3]);
				break;
			
			case 3:
				//Controller->Method(Param1, Param2)
				$this->controller->{$this->url[1]}($this->url[2]);
				break;
			
			case 2:
				//Controller->Method(Param1, Param2)
				$this->controller->{$this->url[1]}();
				break;
			
			default:
				$this->controller->index();
				break;
		}
		
	}


}

GoogleAPI::init();
Model::init();
$init = new Router();

?>