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
                            <form action="" onsubmit="return loadContent();">
                                <select class="mySelect" id="productType" onchange="loadContent();">
                                    <option value="">All</option>
                                    <?php
                                    
                                        foreach ($this->prodTypeData as $val) {
                                            echo "<option value=\"". $val['product_type_id'] ."\">". ucfirst($val['type_name']) ."</option>";
                                        }

                                    ?>
                                </select>
                                <input type="text" id="productName" placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="shop__option__right">
                            Sort By :
                            <select class="mySelect" id="productSort" onchange="loadContent();">
                                <option value="product_name">Name</option>
                                <option value="product_price">Price</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

<!-- PRODUCT --------------------------------------------------->

            <div class="row" id="productContent">
                
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
                            <p>Showing <x id="productTotal"></x> results</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

<script type="text/javascript">
    
    function loadContent() {
        let type = $("#productType").val();
        let name = $("#productName").val();
        let sort = $("#productSort").val();

        if (sort == "") sort = "name";
        
        $.get("services/getproduct.php?type=" + type + "&name=" + name + "&order=" + sort, function(data) {
            $("#productContent").html(data);
        });
        return false;
    }
    loadContent();

</script>