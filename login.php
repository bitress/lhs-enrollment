<?php 

	session_start();
	session_destroy();
  //include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />

    <!-- Include SweetAlert 2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css">

    <title>LHS | LHS ENROLLMENT SYSTEM </title>
    
    <link rel="icon" type="img" href="img/lhs-logo.png">
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="sign_in.php" method="POST" autocomplete="off" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" onkeyup="lettersonly(this)" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" onkeyup="lettersonly(this)" />
            </div>
            <input type="submit" name="login" value="Login" class="btn solid" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Welcome</h3>
            <p>
              Welcome!, this is the Login page of the LHS Enrollment System
            </p>
            <!--<button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>-->
          </div>
          <img src="img/lhs-logo.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
              laboriosam ad deleniti.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <!-- <script src="app.js"></script> -->

    <!-- Include SweetAlert 2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

    <?php
          if(isset($_SESSION['status_icon'])){
            if($_SESSION['status_icon'] == "success"){
        ?>
              <script>
                  Swal.fire({
                      title: "<?php echo $_SESSION['status']?>",
                      //text: "You clicked the button!",
                      icon: "<?php echo $_SESSION['status_icon']?>",
                      showConfirmButton: false,
                      timer: 1500
                  })
              </script>
        <?php
            }else{
        ?>
              <script>
                Swal.fire({
                    title: "<?php echo $_SESSION['status']?>",
                    //text: "You clicked the button!",
                    icon: "<?php echo $_SESSION['status_icon']?>",
                    showConfirmButton: false,
                    timer: 1500
                })
              </script>
        <?php
            }
            
            unset($_SESSION['status']);
            unset($_SESSION['status_icon']);
          }
        ?>
    <!---->

    <script>
    function lettersonly(input) {
        var regex = /[^a-z, 0-9, _, ., @, "", -]/gi;
        input.value = input.value.replace(regex, "");
    }
    </script>

  </body>
</html>
