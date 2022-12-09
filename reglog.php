<?php

include_once('db.php');
if (isset($_SESSION['uname'])) {
  header("location: index.php");

}
?>

<?php
if (isset($_POST["reg"])) {

  $name = mysqli_real_escape_string($db, $_POST["name"]);
  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $pass = mysqli_real_escape_string($db, $_POST["pass"]);
  $cpass = mysqli_real_escape_string($db, $_POST["cpass"]);


  $emailquery = "SELECT * FROM register WHERE email='$email'";
  $query = mysqli_query($db, $emailquery);
  $emailcount = mysqli_num_rows($query);
  if ($emailcount > 0) {
    $_SESSION['logmsg'] = "Email already exists. Please Register again";
    header("location: reglog.php");
  } else {
    if ($pass === $cpass) {
      $pass = password_hash($pass, PASSWORD_BCRYPT);
      $token = bin2hex(openssl_random_pseudo_bytes(15));
      $stmt = $db->prepare("INSERT INTO register(name, email, pass) VALUES ( ?,  ?, ? )");
      $stmt->bind_param("sss", $name, $email, $pass);
      $stmt->execute();
      if ($stmt) {
        header("location: index.php");
        unset($_SESSION['logmsg']);
        $_SESSION["loggedin"] = true;
        $_SESSION["name"] = $name;
        $_SESSION['logmsg'] = "You are registered now. Please login";

      }
      $stmt->close();


    } else {
      $_SESSION["logmsg"] = "Password does not match.";
      header("location: reglog.php");
    }
  }


}

?>




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

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body onLoad="onLoad()">
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">

        <!-- login -->


        <form method="POST" action="./login.php" class="sign-in-form" enctype="multipart/form-data" onsubmit="return">
          <h2 class="title">Login</h2>
          <?php
          if (isset($_SESSION['logmsg'])) {
          ?>
          <style>
            .swal2-title {
              font-size: medium;
            }
          </style>
          <script>
            Swal.fire({
              position: 'top-end',
              icon: 'warning',
              title: `<?php echo $_SESSION['logmsg']; ?>`,

              showConfirmButton: true,
              timer: 5500
            })


          </script>

          <?php
          } else {
            unset($_SESSION['logmsg']);

            echo " ";
          }
          ?>

          </button>




          <div class="input-field">
            <i class="fas fa-user" aria-hidden="true"></i>
            <input type="email" placeholder="Email" name="email" minlength="6"
              pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" required="">
          </div>
          <div class="input-field">
            <i class="fas fa-lock" aria-hidden="true"></i>
            <input type="password" class="form-control" name="pass" placeholder="Password" required="">
          </div>
          <input type="submit" name="login" value="Login" class="btn solid" style="  width: 420px;
 
    background-color: #11866c;
  border: none;
  outline: none;color:#fff;
  height: 49px;
  border-radius: 49px;cursor: pointer;
transition: 0.5s;
border-radius: .25rem;
display: grid;
grid-template-columns: 15% 85%;
padding: 0 0.4rem;
position: relative;">
        </form>
        <!-- register -->

        <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" class="sign-up-form"
          enctype="multipart/form-data" onsubmit="return">
          <h2 class="title">Register</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="name" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" minlength="6"
              pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" name="email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="pass" minlength="6" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Confirm Password" name="cpass" required />
          </div>

          <input type="submit" name="reg" class="btn" value="Sign up" style="  width: 420px;
 
    background-color: #11866c;
  border: none;
  outline: none;color:#fff;
  height: 49px;
  border-radius: 49px;cursor: pointer;
transition: 0.5s;
border-radius: .25rem;
display: grid;
grid-template-columns: 15% 85%;
padding: 0 0.4rem;
position: relative;" />




        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Register</h3>
          <p>
            Keep in touch by signing up below.
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/log-reg.svg" class="image" alt="" />

      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Already registered ?</h3>
          <br>
          <button class="btn transparent" id="sign-in-btn">
            Sign In
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