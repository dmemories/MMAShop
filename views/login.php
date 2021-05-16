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
  <div class="myContents">
  <div class="d-md-flex myFont" style="opacity: 1.0;">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
              <div class="text-center mb-5">
                <h3 class="text-uppercase text-white"><strong>M-MA</strong></h3>
              </div>
              <form action="login" method="post">
                <div class="form-group first">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email"
                  <?php
                    if (isset($this->tempEmail)) {
                      echo "value=\"". $this->tempEmail ."\"";
                      unset($this->tempEmail);
                    }
                  ?>
                  >
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <br/>
               <!--  <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                  
                  <span class="ml-auto"><a href="#" class="forgot-pass myFont">Forgot Password</a></span>
                </div>
 -->
                <div style="display: flex; align-items: center; justify-content: center; text-align: center">
                  <a href="#" class="btn btn-block py-2 btn-mma" style="border-radius: 20px;">
                    Login
                  </a>
                </div>
                
                <span class="text-center my-3 d-block text-white">or</span>
                
                
                <div style="display: flex; margin: auto; text-align: center; align-items: center; justify-content: center; margin-bottom: 20px;">
                  <img src='<?=PATH_ICON . "btn_fb.png"?>' style="width: 40px; height: 40px; margin-right: 20px;"/>
                  <a href="#" class="btn btn-block py-2 btn-facebook mybtn">
                    Login with facebook
                  </a>
                </div>
                
                <div style="display: flex; margin: auto; text-align: center; align-items: center; justify-content: center;">
                  <img src='<?=PATH_ICON . "btn_gg.png"?>' style="width: 40px; height: 40px; margin-right: 20px;"/>
                  <a href="<?=GoogleAPI::$client->createAuthUrl();?>" class="btn btn-block py-2 btn-google mybtn">
                    Login with Google
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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