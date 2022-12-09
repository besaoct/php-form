<?php

session_start();
ob_start();

if (!isset($_SESSION['uname']) || !isset($_SESSION['adname'])) {
  header("location: reglog.php");
}


?>
<!-- fully functional secure php login and registration form by shafin -->
<!--  @Copyright 2020 PHP_FORM by Shafin-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Animated login and register sliding form">
  <meta name="keywords" content="PHP login form, HTML, CSS, JavaScript, Animated, login, register, sliding, form">
  <meta name="author" content="Amineghafour">
  <title>Login & Register </title>
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">


        <!-- details -->

        <form class="sign-in-form" enctype="multipart/form-data" onsubmit="return">
          <h2 class="title">Details</h2>
          <p style="color:gray;font-weight:600">
            <?php
            if (isset($_SESSION['login'])) {
              echo $_SESSION['login'];
            }
            ?>
          </p>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="<?= $_SESSION['uname'] ?>" name="name" disabled />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="<?= $_SESSION['umail'] ?>" name="email" disabled />
          </div>


          <a href="./logout.php" class="btn" style="width: 420px;
 
    background-color: red;
  border: none;
  text-decoration:none;
  outline: none;color:#fff;
  height: 49px;
  border-radius: 49px;
  cursor: pointer;
 transition: 0.5s;
 border-radius: .25rem;
 display: inherit;
text-align:center;
align-items:center;
justify-content:center;
grid-template-columns: 15% 85%;
padding: 0 0.4rem;
position: relative;">LogOut</a>

        </form>

        <form class="sign-up-form">

          <a href="./logout.php" class="btn" style="width: 420px;
 
    background-color: #5565fa;
  border: none;
  text-decoration:none;
  outline: none;color:#fff;
  height: 49px;
  border-radius: 49px;
  cursor: pointer;
 transition: 0.5s;
 border-radius: .25rem;
 display: inherit;
text-align:center;
align-items:center;
justify-content:center;
grid-template-columns: 15% 85%;
padding: 0 0.4rem;
position: relative;">LogOut</a>

        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Hi, <?= $_SESSION['uname'] ?>
              <p>
                Click the button below to hide details.
              </p>
              <button class="btn transparent" id="sign-up-btn">
                hide
              </button>
        </div>
        <img src="img/log-reg.svg" class="image" alt="" />

      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Want to Show ?</h3>
          <br>
          <button class="btn transparent" id="sign-in-btn">
            CLick here
          </button>
        </div>
        <img src="img/log-reg.svg" class="image" alt="" />
      </div>




    </div>
  </div>

  <script src="js/functions.js"></script>
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>


  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
</body>

</html>