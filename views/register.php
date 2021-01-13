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
  }</style>";

  

?>

<link rel="stylesheet" href="<?=PATH_CSS;?>login_style.css" type="text/css">
<form action="#register" method="post">
<div class="myContents">
  <div class="d-md-flex myFont" style="opacity: 1.0;">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 class="text-uppercase text-white"><strong>Register</strong></h3>
              </div>
              <form action="login" method="post">
                <div class="form-group first">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email"
                  <?php
                    if (isset($this->tempEmail)) {
                      echo "value=\"". $this->tempEmail ."\"";
                      unset($this->tempEmail);
                    }
                  ?>
                  required>
                </div>
                <div class="form-group last mb-3">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group last mb-3">
                  <label>Full-Name</label>
                  <input type="text" class="form-control" name="fullname">
                </div>
                <div class="form-group last mb-3">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" name="tel">
                </div>
                <div class="form-group last mb-3">
                  <label>Address</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="107" style="resize: none;"></textarea>
                </div>
 
                <div class="text-center">
                  <input type="submit" class="btn btn-success">
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
    let emailEle = document.getElementsByName("email")[0];
    if (emailEle.value.length > 0) {
      document.getElementsByName("password")[0].focus();
    }
    else {
      emailEle.focus();
    }
  }
  init();
        
</script>