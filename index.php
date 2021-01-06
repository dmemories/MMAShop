<?php

    // Main
    define('PATH_MODEL', 'models/');
    define('PATH_VIEW', 'views/');
    define('PATH_CONTROLLER', 'controllers/');
    define('PATH_MVIEW', 'views/master/');

	$strExp = explode("\\", __DIR__);
	$dirName = $strExp[(sizeof($strExp) - 1)];
	define('PATH_ROOT', '../../../../' . $dirName . '/');
    define('PATH_PUBLIC', PATH_ROOT . 'public/');
	define('PATH_CSS', PATH_PUBLIC . 'css/');
    define('PATH_JS', PATH_PUBLIC . 'js/');
    define('PATH_IMG',	 PATH_PUBLIC . 'img/');
    
	// Database
	define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'mma_shop');

?>

<?php

class Model {

	public static $db;
	public static $table;
	public static $data;

	public static function init() {
		self::$db = new PDO(DB_TYPE . ":dbname=". DB_NAME .";host=" . DB_HOST, DB_USER, DB_PASS);
	}

	// get("product_id, product_name", "product_id = :xxx", ["xxx" => $pid], ["product_id", "DESC"], PDO::FETCH_ASSOC)
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
		Model::init();
        $this->setUrl();
		$this->loadContoller();
		$this->controller->index();
       // $this->callFunction();
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
		$length = count($this->_url);
		if ($length > 1) {
			if (!method_exists($this->_controller, $this->_url[1])) {
				exit("Invalid Function (" . $this->_url[1] . ")");
			}
		}
		
		switch ($length) {
			case 5:
				//Controller->Method(Param1, Param2, Param3)
				$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
				break;
			
			case 4:
				//Controller->Method(Param1, Param2)
				$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
				break;
			
			case 3:
				//Controller->Method(Param1, Param2)
				$this->_controller->{$this->_url[1]}($this->_url[2]);
				break;
			
			case 2:
				//Controller->Method(Param1, Param2)
				$this->_controller->{$this->_url[1]}();
				break;
			
			default:
				//$this->_controller->index();
				break;
		}
		
	}


}

$init = new Router();

?>