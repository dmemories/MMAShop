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
                
                <div class="d-sm-flex mb-5 align-items-center">
                  <!--<label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                  </label>
                  -->
                  <span class="ml-auto"><a href="#" class="forgot-pass myFont">Forgot Password</a></span> 
                </div>

                <input type="submit" value="Log In" class="btn btn-block py-2 btn-primary">

                <span class="text-center my-3 d-block text-white">or</span>
                
                
                <div class="">
                  <a href="#" class="btn btn-block py-2 btn-facebook">
                    <span class="icon-facebook mr-3"></span> Login with facebook
                  </a>
                  <a href="<?=GoogleAPI::$client->createAuthUrl();?>" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span> Login with Google</a>
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
      let userEle = document.getElementsByName("username")[0];
      if (userEle.value.length > 0) {
        document.getElementsByName("password")[0].focus();
      }
      else {
        userEle.focus();
      }
    }
    init();
        
  </script>

<?php

  if (isset($this->sweetRefresh)) {
    echo "<script>
      Swal.fire({
        title: \"". $this->sweetRefresh[0] ."\",
        text: \"". $this->sweetRefresh[1] ."\",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.isConfirmed) {
          location.reload();
        }
      })
      </script>";
  }
  else if (isset($this->sweetAlert)) {
    echo "<script>
    Swal.fire(
      '". $this->sweetAlert['title'] ."',
      '". $this->sweetAlert['text'] ."',
      '". $this->sweetAlert['type'] ."'
    )
    </script>";
  }

?>