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
    define('AUTH_NAME', 'name');
    define('AUTH_EMAIL', 'email');
    define('AUTH_TYPE', 'memberType');

    // Member Group
    define('MEM_DEFAULT', 1);
    define('MEM_GOOGLE', 2);

?>