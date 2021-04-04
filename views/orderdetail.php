<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Order Id #<?=$this->orderId;?></h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?="../";?>">Home</a>
                        <a href="<?="../order";?>">My Order</a>
                        <span>Order Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
    <form action="upload" id="imgform" method="post" enctype="multipart/form-data">
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
                                       <a href="'. PATH_ROOT . "product/" . $val['proId'] .'"><img class="mycartitem" src="'. $val['proImg'] .'" style="cursor: pointer;"></a>
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
                            echo '<tr style="text-align: center;">
                                <td colspan="2" align="right">
                                    Order Date
                                </td>
                                <td colspan="2" align="center">'. date("d / M / Y", strtotime($this->orderDate)) . '</th>
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
                        <li>
                            <?php
                                if (empty(strpos($this->paymentImg, "noimg"))) {
                                    echo "<img onclick=\"window.open('". $this->paymentImg ."')\" src=\"". $this->paymentImg ."\" style=\"width:240px; cursor:pointer;\"/><br/>";
                                }
                                else {
                                    echo "<img src=\"". $this->paymentImg ."\" style=\"width:240px;\"/><br/>";
                                }
                            
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="cart__total text-white">
                    <?php
                        if (@$this->isComplete != 3) {
                            echo "<ul>
                                <li>Select your payment image <input type=\"file\" name=\"paymentfile\"/></li>
                                </ul>
                                <a onclick=\"paymentImgSubmit()\" class=\"primary-btn checkout-btn\">Upload</a>";
                        }
                    ?>
                </div>
            </div>
            

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="continue__btn">
                    <a class="bg-orange text-white" href="../order">Back</a>
                </div>
            </div>

        </div>
    </div>
    <input type="hidden" name="orderId" value="<?=$this->orderId;?>"/>
    </form>
</section>


<script>
    function paymentImgSubmit() {
        if (document.getElementsByName('paymentfile')[0].files.length > 0)
            document.getElementById('imgform').submit()
    }
</script>