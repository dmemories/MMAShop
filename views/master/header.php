<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.MA Shop</title>
    <link rel="icon" href="<?=PATH_IMG;?>icon.png" type = "image/x-icon"> 
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">-->

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

    <!-- JS -->
    <script src="<?=PATH_JS;?>sweetalert2@10.js"></script>
    <script src="<?=PATH_JS;?>jquery-3.3.1.min.js"></script>
    <script src="<?=PATH_JS;?>jquery.nice-select.min.js"></script>
</head>
<body>


<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>


<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__cart">
        <div class="offcanvas__cart__links">
            <a href="#" class="search-switch"><img src="<?=PATH_IMG;?>icon/search.png" alt=""></a>
            <a href="#"><img src="<?=PATH_IMG;?>icon/heart.png" alt=""></a>
        </div>
        <?php include PATH_MVIEW . 'header_cart.php'; ?>
    </div>
    <div class="offcanvas__logo">
        <a href="./index.php"><img src="<?=PATH_IMG;?>logo.png" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__option">
        <?php include PATH_MVIEW . 'header_member.php'; ?>
    </div>
</div>

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header__top__inner">
                        <div class="header__top__left">
                            <?php include PATH_MVIEW . 'header_member.php'; ?>
                        </div>
                        <div class="header__logo">
                            <a href="./index.php"><img src="<?=PATH_IMG;?>logo.png" alt=""></a>
                        </div>
                        <div class="header__top__right">
                            <div class="header__top__right__links">
                                <a href="#" class="search-switch"><img src="<?=PATH_IMG;?>icon/search.png" alt=""></a>
                                <a href="#"><img src="<?=PATH_IMG;?>icon/heart.png" alt=""></a>
                            </div>
                            <?php include PATH_MVIEW . 'header_cart.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li <?=(($this->viewName == "index") ? "class=\"active\"" : "");?>><a href="<?=PATH_ROOT;?>home">Home</a></li>
                        <li <?=(($this->viewName == "shop") ? "class=\"active\"" : "");?>><a href="<?=PATH_ROOT;?>shop">Shop</a>
                            <!--<ul class="dropdown">
                                <li><a href="<?=PATH_ROOT;?>shop-details">Shop Details</a></li>
                                <li><a href="<?=PATH_ROOT;?>shoping-cart">Shoping Cart</a></li>
                                <li><a href="<?=PATH_ROOT;?>checkout">Check Out</a></li>
                                <li><a href="<?=PATH_ROOT;?>wisslist">Wisslist</a></li>
                                <li><a href="<?=PATH_ROOT;?>Class">Class</a></li>
                                <li><a href="<?=PATH_ROOT;?>blog-details">Blog Details</a></li>
                            </ul>-->
                        </li>
                        <li <?=(($this->viewName == "cart") ? "class=\"active\"" : "");?>><a href="<?=PATH_ROOT;?>cart">Cart</a>
                        <li><a href="<?=PATH_ROOT;?>order">My Order</a></li>
                        <li><a href="<?=PATH_ROOT;?>contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->