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
        const servicePath = <?= "\"" . PATH_SERVICE . "\"" ?>;

        function checkout() {

            Swal.fire({
                title: 'Confirm your detail?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    

                    $.post(
                        servicePath + "checkout.php",
                        {
                            name: $("#name").val(),
                            mobile: $("#mobile").val(),
                            address: $("#address").val()
                        },
                        function(data) {
                            let title;
                            let icon;
                            let cbFunc;

                            //console.log(String(data));
                            switch (String(data)) {
                                case "0":
                                    back2Login();
                                    return;
                                    break;
                                case "1":
                                    title = "Order Successfully";
                                    icon = "success";
                                    cbFunc = () => { location.href = rootPath + 'order'; }
                                    break;
                                case "2":
                                    title = "Don't have any products in your cart !";
                                    icon = "warning";
                                    cbFunc = () => {}
                                    break;
                                case "3":
                                    title = "Invalid Name !";
                                    icon = "warning";
                                    cbFunc = () => {}
                                    break;
                                case "4":
                                    title = "Invalid Mobile !";
                                    icon = "warning";
                                    cbFunc = () => {}
                                    break;
                                case "5":
                                    title = "Invalid Address !";
                                    icon = "warning";
                                    cbFunc = () => {}
                                    break;
                                default:
                                    title = "Order Failed";
                                    icon = "error";
                                    cbFunc = () => { console.log("[" + data + "]"); }
                                    break;
                            }

                            Swal.fire({
                                title: title,
                                icon: icon,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    cbFunc();
                                }
                            });
                        }
                    );
                    

                }
            })

            return false;
        }

        /*-------------------
		Quantity change
        --------------------- */
        function getCartData(productId = 0, productColorId = 0, isAdd = false) {  
            $.post(servicePath + "getcart.php", {pid: productId, pcolorId: productColorId, add: (isAdd ? 1 : 0)}, function(data) {
                console.log(data);
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
                    $.post(servicePath + "delcart.php", {pid: productId, pcolorId: productColorId}, function(data) { getCartData(); });
                }
            })
        }
        getCartData();

    </script>