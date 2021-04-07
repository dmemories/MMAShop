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
                                        <a href="order/'. $val['id'] .'" target="_blank"><img class="mycartitem" src="'. PATH_ICON . "view.png" .'" style="cursor: pointer; width: 50px; height: 50px;"></a>
                                    </td>
                                    <td class="">
                                        <div style="display: flex;justify-content: center;">
                                        <img onclick="saveOrderId('. $val['id'] .')" class="mycartitem" src="'. PATH_ICON . "save.png" .'" style="cursor: pointer; width: 50px; height: 50px;">
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

<script>
    
    function saveOrderId(id) {
        let statusId = document.getElementById("status_" + id).value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 1) {
                    Swal.fire({
                        title: "Save Successfully",
                        text: "",
                        icon: "success",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //location.reload();
                        }
                    })
                }
                else {
                    console.log(this.responseText);
                    Swal.fire({
                        title: "Save Error",
                        text: "",
                        icon: "error",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //location.reload();
                        }
                    })
                }
            }
        };
        xhttp.open("POST", <?="\"" . PATH_SERVICE . "admin_orderedit.php\"";?>, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + id + "&statusid=" + statusId);
    }

</script>