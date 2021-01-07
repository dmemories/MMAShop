<?php

    // Main
    define('PATH_LIB', 'libs/');
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
    define('PATH_IMG',	 PATH_PUBLIC . 'images/');
    
	// Database
	define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'mma_shop');
    
    // Auth
    define('AUTH_USER', 'username');
	
	// Google ApiClient
	/*require_once 'vendor/autoload.php';
    $gclient = new Google_Client();
    $gclient->setClientId('156691773247-fm3ca4uok2qj7nat41kp9n0h1kntcmgv.apps.googleusercontent.com');
    $gclient->setClientSecret('YdOCrMuZegbUo6iJMhGpNH2H');
    $gclient->setRedirectUri('http://127.0.0.1/MMAShop');
    $gclient->addScope('email');
    $gclient->addScope('profile');
*/
?>