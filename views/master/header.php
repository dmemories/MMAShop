<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.MA Shop</title>
    <link rel="icon" href="<?=PATH_IMG;?>icon.png" type = "image/x-icon"> 
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
        <ul>
            <li>Register</li>
            <li>
                <a href="#">Login</a> <span class="arrow_carrot-down"></span>
                <ul>
                    <li>Logout</li>
                </ul>
            </li>
        </ul>
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
                            <ul>
                                <li>Register</li>
                                <li>
                                    <a href="#">Login</a> <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <li>Logout</li>
                                    </ul>
                                </li>
                            </ul>
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
                        <li <?=(($this->pageName == "index") ? "class=\"active\"" : "");?>><a href="./home">Home</a></li>
                        <li <?=(($this->pageName == "shop") ? "class=\"active\"" : "");?>><a href="./shop">Shop</a>
                            <ul class="dropdown">
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./wisslist.html">Wisslist</a></li>
                                <li><a href="./Class.html">Class</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./shop.html">My Order</a></li>
                        <li><a href="./blog.html">Cart</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->