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
                                <th>Order Id</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                            foreach ($this->orderData as $val) {
                                echo '<tr style="text-align: center;">
                                <td class="product__cart__item">
                                    <div style="display: flex;justify-content: center;">
                                       <a href="'. $val['href'] .'"><img class="mycartitem" src="'. $val['img'] .'" style="cursor: pointer;"></a>
                                    </div>
                                </td>
                                <td>#00'. $val['orderId'] .'</td>
                                <td>'. $val['status'] .'</td>
                            </tr>'; 
                            }
                           
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</section>