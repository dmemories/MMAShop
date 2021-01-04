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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XXXXXXXXXXX</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?=PATH_CSS;?>bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>flaticon.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>barfiller.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?=PATH_CSS;?>style.css" type="text/css">
</head>
<body>
        
<?php

include PATH_MVIEW . 'header.php';
include PATH_VIEW . 'index.php';
include PATH_MVIEW . 'footer.php';

?>


</body>

<!-- Js Plugins -->
<script src="<?=PATH_JS;?>jquery-3.3.1.min.js"></script>
<script src="<?=PATH_JS;?>bootstrap.min.js"></script>
<script src="<?=PATH_JS;?>jquery.nice-select.min.js"></script>
<script src="<?=PATH_JS;?>jquery.barfiller.js"></script>
<script src="<?=PATH_JS;?>jquery.magnific-popup.min.js"></script>
<script src="<?=PATH_JS;?>jquery.slicknav.js"></script>
<script src="<?=PATH_JS;?>owl.carousel.min.js"></script>
<script src="<?=PATH_JS;?>jquery.nicescroll.min.js"></script>
<script src="<?=PATH_JS;?>main.js"></script>
</html>