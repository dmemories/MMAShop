<!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Shop</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="shop__option">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div class="shop__option__search">
                            <form action="#">
                                <select class="mySelect">
                                    <?php
                                    
                                        foreach ($this->prodTypeData as $val) {
                                            echo "<option value=\"". $val['product_type_id'] ."\">". ucfirst($val['type_name']) ."</option>";
                                        }
                                    ?>
                                </select>
                                <input type="text" placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="shop__option__right">
                            <select class="mySelect">
                                <option value="">Price</option>
                                <option value="">Name</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

<!-- PRODUCT --------------------------------------------------->

            <div class="row">
                <?php

                    $totalProd = 0;
                    foreach ($this->prodData as $key => $val) {
                        $totalProd++;
                        echo "
                        <div class=\"col-lg-3 col-md-6 col-sm-6\">
                            <div class=\"product__item\">
                                <div class=\"product__item__pic set-bg\" data-setbg=\"". PATH_SHOP . $val['type_name'] . "/" . $val['product_img'] ."\">
                                    <div class=\"product__label\">
                                        <span>". $val['type_name'] ."</span>
                                    </div>
                                </div>
                                <div class=\"product__item__text\">
                                    <h6><a href=\"#\">". $val['product_name'] ."</a></h6>
                                    <div class=\"product__item__price\">฿". $val['product_price'] ."</div>
                                    <div class=\"cart_add\">
                                        <a href=\"#\">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }

                ?>
            </div>
            
<!-------------------------------------------------------------->

            <div class="shop__last__option">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="shop__pagination">
                            <!--<a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#"><span class="arrow_carrot-right"></span></a>
                            -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="shop__last__text">
                            <!--<p>Showing 1-9 of 9 results</p>-->
                            <p>Showing <?=$totalProd;?> results</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
