<?php

  echo "
  <style>
  
  .myContents {
    background: url(". PATH_IMG . "login/bg01.jpg" .") no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  }


  </style>";

  

?>

<link rel="stylesheet" href="<?=PATH_CSS;?>login_style.css" type="text/css">
<form action="" method="post" onsubmit="return checkSubmit();" style="margin: 0px;">
<div class="myContents">
  <div class="d-md-flex myFont" style="opacity: 1.0;">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 class="text-uppercase text-white"><strong>Member Data</strong></h3>
              </div>
              <form action="login" method="post">
                <div class="form-group first">
                  <label>Email</label>
                  <input type="ema#9e9e9eil" class="form-control" style="background-color: #cccccc;" value="<?=$this->email;?>" required disabled>
                </div>
                <div class="form-group last mb-3">
                  <label>Full-Name</label>
                  <input type="text" class="form-control" style="background-color: #cccccc;" value="<?=$this->name;?>" required>
                </div>
                <div class="form-group last mb-3">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" name="tel" value="<?=$this->tel;?>" required>
                </div>
                <div class="form-group last mb-3">
                  <label>Address</label>
                  <textarea class="form-control" name="address" rows="3" maxlength="107" style="resize: none;" required><?=$this->address;?></textarea>
                </div>
 
                <div class="text-center">
                  <input type="submit" value="Save" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script>


  function init() {
    let ele = document.getElementsByName("tel")[0];
    ele.focus();
  }
  init();

  function checkSubmit() {
    let tel = document.getElementsByName("tel")[0].value;
    let address = document.getElementsByName("address")[0].value;
    
    if (!validateTel(tel)) {
      Swal.fire(
				'',
				'Invalid Mobile Number',
				'warning'
			)
			return false;
    }
    else if (!validateAddress(address)) {
      Swal.fire(
				'',
				'Invalid Address',
				'warning'
			)
			return false;
    }

    return true;
  }

</script>