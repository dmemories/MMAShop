<?php

    // Main
    define('PATH_LIB', 'libs/');
    define('PATH_MODEL', 'models/');
    define('PATH_VIEW', 'views/');
    define('PATH_CONTROLLER', 'controllers/');
    define('PATH_MVIEW', 'views/master/');

	$strExp = explode("\\", __DIR__);
	$dirName = $strExp[(sizeof($strExp) - 1)];
	//define('PATH_ROOT', '../../../../' . $dirName . '/');
	define('PATH_ROOT', 'http://124.121.90.115/mmashop/');//'https://dearkit.com/');
    define('PATH_PUBLIC', PATH_ROOT . 'public/');
    define('PATH_SERVICE',	 PATH_ROOT . 'services/');
	define('PATH_CSS', PATH_PUBLIC . 'css/');
    define('PATH_JS', PATH_PUBLIC . 'js/');
    define('PATH_IMG',	 PATH_PUBLIC . 'images/');
    define('PATH_ICON',	 PATH_IMG . 'icon/');
    define('PATH_PAYMENT',	 PATH_IMG . 'payment/');
    define('PATH_SHOP',	 PATH_IMG . 'shop/');
    

	// Database
	define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');//'u898848369_root');
    define('DB_PASS', '1234');//'ntldR135792468');
    define('DB_NAME', 'mma_shop');//'u898848369_mma_shop');
    
    // Auth
    define('AUTH_ID', 'id');
    define('AUTH_NAME', 'name');
    define('AUTH_EMAIL', 'email');
    define('AUTH_TYPE', 'memberType');
    define('AUTH_LV', 'level');

    // Order Status Group
    define('ORDER_STATUS_EMPTY', 1);
    define('ORDER_STATUS_PENDING', 2);
    define('ORDER_STATUS_WAITITEM', 2);

    // Member Group
    define('MEM_DEFAULT', 1);
    define('MEM_GOOGLE', 2);

    // Shop
    define('SHOP_MAXBUY', 50);

?>