<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Admin Order</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="<?="./";?>">Home</a>
                        <span>Admin Order</span>
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
                                <th>Order Id</th>
                                <th>Inform Date</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Save</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                            foreach ($this->orderData as $val) {
                                echo '
                                <tr style="text-align: center;">
                                    <td>#00'. $val['id'] .'</td>
                                    <td>'. $val['date'] .'</td>
                                    <td>
                                        <select id="status_'. $val['id'] .'" style="height: 30px;">
                                            '. $val['statusOption'] .'
                                        </select>
                                    </td>
                                    <td class="">
                                        <a href="5678"><img class="mycartitem" src="'. PATH_ICON . "view.png" .'" style="cursor: pointer; width: 50px; height: 50px;"></a>
                                    </td>
                                    <td class="">
                                        <div style="display: flex;justify-content: center;">
                                        <a href="5678"><img class="mycartitem" src="'. PATH_ICON . "save.png" .'" style="cursor: pointer; width: 50px; height: 50px;"></a>
                                        </div>
                                    </td>
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