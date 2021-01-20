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
<form action="" method="post" onsubmit="return checkSubmit();">
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
                    if (isset($this->email)) {
                      echo "value=\"". $this->email ."\"";
                      unset($this->email);
                    }
                  ?>
                  required>
                </div>
                <div class="form-group last mb-3">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password"
                  <?php
                    if (isset($this->password)) {
                      echo "value=\"". $this->password ."\"";
                      unset($this->password);
                    }
                  ?>
                  required>
                </div>
                <div class="form-group last mb-3">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" name="password2" required>
                </div>
                <div class="form-group last mb-3">
                  <label>Full-Name</label>
                  <input type="text" class="form-control" name="fullname"
                  <?php
                    if (isset($this->fullname)) {
                      echo "value=\"". $this->fullname ."\"";
                      unset($this->fullname);
                    }
                  ?>
                  required>
                </div>
                <div class="form-group last mb-3">
                  <label>Mobile Number</label>
                  <input type="text" class="form-control" name="tel"
                  <?php
                    if (isset($this->tel)) {
                      echo "value=\"". $this->tel ."\"";
                      unset($this->tel);
                    }
                  ?>
                  required>
                </div>
                <div class="form-group last mb-3">
                  <label>Address</label>
                  <textarea class="form-control" name="address" rows="3" maxlength="107" style="resize: none;" required><?php if (isset($this->address)) { echo $this->address; unset($this->address); } ?></textarea>
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
      document.getElementsByName("email")[0].focus();
    }
    else {
      emailEle.focus();
    }
  }
  init();

  function IsMatchingCode(str){
		var myRegExp = /^[A-Za-z0-9]{4,23}$/;
		return myRegExp.test(str);
	}

  function validateEmail(email){
		var myRegExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return myRegExp.test(email);
  }
  

  function checkSubmit() {
    let email = document.getElementsByName("email")[0].value;
    let password1 = document.getElementsByName("password")[0].value;
    let password2 = document.getElementsByName("password2")[0].value;
		let fullname = document.getElementsByName("fullname")[0].value;
    let tel = document.getElementsByName("tel")[0].value;
    let address = document.getElementsByName("address")[0].value;
    
    if (!validateEmail(email)) {
			Swal.fire(
				'',
				'Invalid email format',
				'warning'
			)
			return false;
		}
		else if (!IsMatchingCode(password1)) {
			Swal.fire(
				'',
				'Your password should be A-Z or 0-9 and has 4-23 characters !',
				'warning'
			)
			return false;
		}
		else if (password1 != password2) {
			Swal.fire(
				'',
				'Your password is not match',
				'warning'
			)
			return false;
		}
    return true;
  }

</script>