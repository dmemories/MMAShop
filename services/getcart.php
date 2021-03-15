<?php

    @session_start();
    require_once '../config.php'; 
    require_once '../' . PATH_LIB . 'model.php';
    require_once '../' . PATH_MODEL . 'member.php';
    require_once '../' . PATH_MODEL . 'product.php';
    require_once '../' . PATH_MODEL . 'product_type.php';
    require_once '../' . PATH_MODEL . 'product_color.php';
    Model::init();


    if (!empty($_POST['pid']) && !empty($_POST['pcolorId']) && isset($_POST['add'])) {
        $pid = $_POST['pid'];
        $pcolor = $_POST['pcolorId'];
      
        // Invalid Id & ColorId Handle
        $query = Product::get([
            "where" => "product.product_id = " . $pid . " AND product.product_color_id LIKE '%". $pcolor ."%'",
        ]);
        if (sizeof($query) < 1) {
            exit;
        }

        $isAdd = $_POST['add'];
        if ($isAdd) {
            if ($_SESSION['cart'][$pid][$pcolor] < SHOP_MAXBUY) {
                $_SESSION['cart'][$pid][$pcolor]++;
            }
        }
        else if ($_SESSION['cart'][$pid][$pcolor] > 1) {
            $_SESSION['cart'][$pid][$pcolor]--;
        }
    }

    $memData = Member::get([
        "where" => "`member_id` = " . $_SESSION[AUTH_ID],
    ])[0];
    $memName = $memData['fullname'];
    $memTel = $memData['tel'];
    $memAddr = $memData['address'];

    $cartDataArr = (array) null;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productId => $val) {
            foreach ($val as $colorId => $amount) {
                $pData = ProductColor::get([
                    "where" => "`product_color_id` = " . $colorId,
                ]);
                $colorId = $pData[0]['product_color_id'];
                $colorName = $pData[0]['color_name'];

                $pData = Product::get([
                    "where" => "`product_id` = " . $productId,
                    'join' => ['product_type, product_type_id']
                ]);
                $pName = $pData[0]['product_name'];
                $price = $pData[0]['product_price'];
                $typeName = $pData[0]['type_name'];
            
                $cartDataArr[] = [
                    'productName' => $pName,
                    'productId' => $productId,
                    'colorId' => $colorId,
                    'color' => $colorName,
                    'price' => $price,
                    'imgPath' => $typeName . "/" . $pName . "/0.jpg",
                    'amount' => $amount
                ];
            }
        }
    }

?>

    

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

                                $totalPriceAll = 0;
                                foreach ($cartDataArr as $cartData) {
                                    $total = ($cartData['price'] * $cartData['amount']);
                                    $totalPriceAll += $total;
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
                                                    <a href=\"". $linkItem ."\"><h6>" . $cartData['productName'] . " (" . ucfirst($cartData['color']) . ")</h6></a>
                                                    <h5>฿" . $cartData['price'] . "</h5>
                                                </div>
                                            </td>
                                            <td class=\"quantity__item\">
                                                <div class=\"quantity\">
                                                    <div class=\"pro-qty\">
                                                        <span class=\"dec qtybtn\" onclick=\"getCartData(" . $cartData['productId'] . ", " . $cartData['colorId'] . ", false);\">-</span>
                                                        <input type=\"text\" value=\"" . $cartData['amount'] . "\">
                                                        <span class=\"inc qtybtn\" onclick=\"getCartData(" . $cartData['productId'] . ", " . $cartData['colorId'] . ", true);\">+</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=\"cart__price\">฿ " . $total . "</td>
                                            <td class=\"cart__close\" onclick=\"delCartData(" . $cartData['productId'] . ", " . $cartData['colorId'] . ");\"><span class=\"icon_close\"></span></td>
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
                        <!--<div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>-->
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
                    <div class="cart__total text-white" style="padding: 35px 30px 1px;">
                        <div class="checkout__order__products"><h6>Address</h6></div>
                            <ul class="checkout__total__products">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col"><li>Name :</li></div>
                                        <div class="col"><input type="text" style="margin-top: 4px;" value="<?=$memName;?>"/></div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><li>Mobile :</li></div>
                                        <div class="col"><input type="text" style="margin-top: 4px;" value="<?=$memTel;?>"/></div>
                                    </div>
                                </div>
                                <li><samp>Address : </samp><br/><textarea name="" id="" style="width: 100%;" rows="5"><?=$memAddr;?></textarea></li>
                            </ul>
                    </div> 
                    <div class="cart__total text-white">
                        <h6>Cart total</h6>
                        <ul>
                            <!--<li>Subtotal <span>$ 169.50</span></li>-->
                            <li>Total <span>฿ <?=$totalPriceAll;?></span></li>
                        </ul>
                        <a onclick="checkout();" class="primary-btn checkout-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>