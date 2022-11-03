<?php
    if (!isset($_POST['login'])) {
    ?>
     <script>
         location.replace("reglog.php")
     </script>

     <?php
    }
include_once('db.php');

    if (isset($_SESSION['uname'])) {
    ?>
     <script>
         alert('YOU ARE ALREADY LOGGED IN');
         location.replace("index.php")
     </script>

     <?php
    }
else{

    if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db,$_POST["email"]);
    $pass = mysqli_real_escape_string($db,$_POST["pass"]);
           
            $email_search = "SELECT * FROM register where email='$email'";
            $query = mysqli_query($db, $email_search);
            $emailcount = mysqli_num_rows($query);
            if ($emailcount===1) {
                $email_pass = mysqli_fetch_assoc($query);
                $db_pass = $email_pass['pass'];
                $db_mail = $email_pass['email'];
                $pass_decode = password_verify($pass, $db_pass);

                if ($pass_decode && $db_mail===$email) {
                    $_SESSION['uname'] =  $email_pass['name'];
                    $_SESSION['umail'] =  $email_pass['email'];
                    $_SESSION['login'] = "YOU ARE LOGGED IN";
            ?>
                 <script>
                    //  alert('YOU ARE NOW LOGGED IN');
                     location.replace("index.php")
                 </script>
            <?php

                } else {

                    $_SESSION['logmsg'] = "INCORRECT PASSWORD";
                          ?>
                 <script>
                    //  alert('incorrect Password or mail');
                     location.replace("login.php")
                 </script>
            <?php
                }
            } else {

                $_SESSION['logmsg'] = "ENTER VALID EMAIL";
                      ?>
                 <script>
                    //  alert('no');
                     location.replace("login.php")
                 </script>
            <?php
            }
        }
    }

    ?>
    