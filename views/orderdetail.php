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
                                <td>'. $val['currPrice'] .'</td>
                                <td>'. $val['orderAmount'] .'</td>
                                <td>'. $val['sum'] .'</th>
                            </tr>';
                            }
                            echo '<tr style="text-align: center;">
                                <td colspan="2" align="right">
                                    Total
                                </td>
                                <td colspan="2" align="center">'. $this->total .'</th>
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
            
        </div>
    </div>
</section>