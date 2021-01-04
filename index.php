<?php

    // Main
    define('PATH_MODEL', 'models/');
    define('PATH_VIEW', 'views/');
    define('PATH_CONTROLLER', 'controllers/');
    define('PATH_MVIEW', 'views/master/');

    define('PATH_PUBLIC', 'public/');
    define('PATH_CSS', PATH_PUBLIC . 'css/');
    define('PATH_JS', PATH_PUBLIC . 'js/');
    define('PATH_IMG', PATH_PUBLIC . 'img/');
    
    // Database
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '1234');
    define('DB_NAME', 'test');
    

?>


<?php

class Model {
	function __construct() {
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}
}

class View {
	private $pageName;

	public function setView($viewName) {
		$this->pageName = $viewName;
		return $this;
	}

	public function getView($noInclude = true) {
		if ($noInclude) {
			require PATH_VIEW . $this->pageName . '.php';	
		}
		else {
			require PATH_VIEW . 'header.php';
			require PATH_VIEW . $this->pageName . '.php';
			require PATH_VIEW . 'footer.php';
		}
		return $this;
	}
}

class Controller {
	public $view;
	public $model;

	public function __construct() {
		$this->view = new View();
	}

	public function setModel($modelName) {
		$file = PATH_MODEL . $modelName . '.php';
		if (file_exists($file)) {
			require $file;
			$modelName .= "Model";
			$this->model = new $modelName;
		}
    }
    

}

class Router {

	private $url = null;
	private $controller = null;
    private $defaultCtrName = 'index';
    
    public function __construct() {
        $this->setUrl();
        $this->setController();
       // $this->callFunction();
    }
    
    private function setUrl() {
		$this->url = isset($_GET['url']) ? $_GET['url'] : null;
		$this->url = str_replace('-', '', $this->url);
		$this->url = filter_var($this->url, FILTER_SANITIZE_URL);
		$this->url = rtrim($this->url, '/');
		$this->url = explode('/', $this->url);
    }

    private function loadContoller($controllerName) {
        $controllerPath = PATH_CONTROLLER . $controllerName . ".php";
        if (file_exists($controllerPath)) {
            require $controllerPath;
            $className = strtoupper($controllerName[0]) . substr($controllerName, 1) . "Controller";
            $this->_controller = new $className();
            $this->_controller->setModel($controllerName);
            return true;
        }
        else {
            return false;
        }
        
    }
    
    private function setController() {
        $controllerName = (isset($this->url[0]) ? $this->url[0] : (string) null);
        if ($this->loadContoller($controllerName) === false) {
            // Default
            if ($this->loadContoller($this->defaultCtrName) === false) {
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