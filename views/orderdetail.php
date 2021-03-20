<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>My Order</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?="./";?>">Home</a>
                        <span>My Order</span>
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
            <div class="col">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr style="text-align: center;">
                                <th>Product</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Sum</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                            foreach ($this->orderData as $val) {
                                echo '<tr style="text-align: center;">
                                <td class="product__cart__item">
                                    <div style="display: flex;justify-content: center;">
                                       <img class="mycartitem" src="'. $val['proImg'] .'" style="cursor: pointer;">
                                    </div>
                                </td>
                                <td>'. number_format($val['currPrice']) .'</td>
                                <td>'. $val['orderAmount'] .'</td>  
                                <td>'. number_format($val['sum']) .'</th>
                            </tr>';
                            }
                            echo '<tr style="text-align: center;">
                                <td colspan="2" align="right">
                                    Total
                                </td>
                                <td colspan="2" align="center">'. number_format($this->total) .'</th>
                            </tr>';
                            echo '<tr style="text-align: center;">
                                <td colspan="2" align="right">
                                    Status
                                </td>
                                <td colspan="2" align="center">'. $this->status .'</th>
                            </tr>';
                            
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            

            <div class="col-lg-4">
                <div class="cart__total text-white" style="padding: 35px 30px 1px;">
                    <div class="checkout__order__products" style="text-align: center;"><h6>Payment Inform</h6></div>
                    <ul class="checkout__total__products" style="text-align: center;">
                        <?php
                            // if img not exist, display invalid img.
                            // upload system.
                        ?>
                        <li><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Metallica_at_The_O2_Arena_London_2008.jpg/1200px-Metallica_at_The_O2_Arena_London_2008.jpg" style="width: 240px; height:240px;"/><br/></li>
                    </ul>
                </div>
                <div class="cart__total text-white">
                    <ul>
                        <li>Select your payment image <input type="file"/></li>
                    </ul>
                    <a onclick="" class="primary-btn checkout-btn">Upload</a>
                </div>
            </div>
            

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="continue__btn">
                    <a class="bg-orange text-white" href="../order">Back</a>
                </div>
            </div>

        </div>
    </div>
</section>