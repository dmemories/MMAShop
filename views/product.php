<?php

    if (empty($this->prodData)) { ?>
        <div class="breadcrumb-option" style="background-co;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="breadcrumb__text">
                            <h2>Product Not Found</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">

                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    else { ?>
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Product detail</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?="../";?>">Home</a>
                        <a href="<?="../shop";?>">Shop</a>
                        <span><?=$this->prodData['product_name'];?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <!-- Shop Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    
                    <div class="product__details__img">
                        <?php
                            $phpPath = str_replace("views", "", dirname(__FILE__)) . "public\images\shop\\";
                            $phpPath = str_replace("\\", "/", $phpPath) . $this->prodData['type_name'] . "/" . $this->prodData['product_name']  . "/";
                            $imgPath = PATH_SHOP . $this->prodData['type_name'] . "/" . $this->prodData['product_name']  . "/";
                        ?>
                        <div class="product__details__big__img">
                            <img class="big_img" src="<?=$imgPath . "0.jpg";?>">
                        </div>
                        <div class="product__details__thumb">
                            <?php
                            
                                for ($i = 0; $i < 10; $i++) {
                                    $imgFilePath = $phpPath . $i . ".jpg";
                                    if (file_exists($imgFilePath)) {
                                        echo "
                                            <div class=\"pt__item\">
                                                <img data-imgbigurl=\""  . $imgPath . $i . ".jpg" . "\" src=\"" . $imgPath . $i . ".jpg" ."\">
                                            </div>";
                                    }
                                    else {
                                        break;
                                    }
                                }

                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <div class="product__label"><?=ucfirst($this->prodData['type_name']);?></div>
                        <h4><?=$this->prodData['product_name'];?></h4>
                        <h5><?="฿".$this->prodData['product_price'];?></h5>
                        <p><?=$this->prodData['product_detail'];?></p>
                        <ul>
                            <li>Quantity: </li>
                            <div class="product_color_option">                            
                            <select>
                            <?php
                                for ($i = 1; $i < 11; $i++) {
                                    echo "<option value=\"". $i ."\">". $i ."</option>";
                                }
                            ?>
                            </select>
                            <!--<div class="product__details__option">
                            <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" max="10">
                                    </div>
                                </div>
                                
                            </div>
                            -->
                            <li>Color: </li>
                            <div class="product_color_option">                            
                            <select>
                            <?php
                                foreach ($this->prodColor as $val) {
                                    echo "<option value=\"". $val['product_color_id'] ."\">". ucwords($val['color_name']) ."</option>";
                                }
                            ?>
                            </select>
                        </div>
                        </ul>
                        <a href="#" class="primary-btn">Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php } ?>


    <br/><br/><br/><br/>