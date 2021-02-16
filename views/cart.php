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
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                

                            <?php

                                $totalPrice = 0;
                                foreach ($this->cartData as $cartData) {
                                    $totalPrice += $cartData['price'];
                                    $linkItem = "product/" . $cartData['productId'];
                                    echo "
                                        <script>
                                            var pdtPrice_" . $cartData['productId'] ." = " . $cartData['price'] . ";
                                        </script>
                                        <tr>
                                            <td class=\"product__cart__item\">
                                                <div class=\"product__cart__item__pic\">
                                                    <a href=\"". $linkItem ."\"><img class=\"mycartitem\" src=\"" . PATH_SHOP . $cartData['imgPath'] ."\"></a>
                                                </div>
                                                <div class=\"product__cart__item__text\">
                                                    <a href=\"". $linkItem ."\"><h6>" . $cartData['productName'] . "</h6></a>
                                                    <h5>฿" . $cartData['price'] . "</h5>
                                                </div>
                                            </td>
                                            <td class=\"quantity__item\">
                                                <div class=\"quantity\">
                                                    <div class=\"pro-qty\">
                                                        <input type=\"hidden\" id=\"\" value=\"\">
                                                        <input type=\"text\" value=\"" . $cartData['amount'] . "\">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=\"cart__price\">฿ 30.00</td>
                                            <td class=\"cart__close\"><span class=\"icon_close\"></span></td>
                                        </tr>";
                                }
                                
                            ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a class="bg-orange text-white" href="./shop">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                        <div>&nbsp;</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!--<div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>-->
                    <div class="cart__total text-white">
                        <h6>Cart total</h6>
                        <ul>
                            <!--<li>Subtotal <span>$ 169.50</span></li>-->
                            <li>Total <span>฿ xxxx</span></li>
                        </ul>
                        <a onclick="checkout();" class="primary-btn checkout-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
        function qtyChange() {
            alert(product_2)
        }

        var proQty = $('.pro-qty');
        proQty.prepend('<span class="dec qtybtn" onclick="qtyChange();">-</span>');
        proQty.append('<span class="inc qtybtn" onclick="qtyChange();">+</span>');
        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                if (parseFloat(oldValue) < 10) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    var newVal = 10;
                }
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    var newVal = 1;
                }
            }
            $button.parent().find('input').val(newVal);
        });

    </script>