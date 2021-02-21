<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Shopping cart</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?="./";?>">Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shopping Cart Section Begin -->
    <div id="content"></div>

    <script>

        function checkout() {
            let servicePath = <?= "\"" . PATH_SERVICE . "\"" ?>;
            $.post(servicePath + "checkout.php", {},
                function(data) {
                    if (data != "1") {
                        Swal.fire({
                            title: "Error",
                            text: data,
                            icon: "error",
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                    else {
                        
                    }
                    console.log(data);
                }
            );
            return false;
        }

        /*-------------------
		Quantity change
        --------------------- */
        const servicePath = <?= "\"" . PATH_SERVICE . "\"" ?>;
        function getCartData(productId = 0, productColorId = 0, isAdd = false) {  
            $.post(servicePath + "getcart.php", {pid: productId, pcolorId: productColorId, add: (isAdd ? 1 : 0)}, function(data) {
                $("#content").html(data);
            });
        }

        function delCartData(productId, productColorId) {
            Swal.fire({
                title: "Do you want to delete this item ?",
                icon: "question",
                confirmButtonColor: '#3085d6',
                showDenyButton: true,
                confirmButtonText: 'OK',
                denyButtonText: `Cancel`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(servicePath + "delcart.php", {pid: productId, pcolorId: productColorId}, function(data) {});
                getCartData();
                }
            })
        }
        getCartData();

    </script>