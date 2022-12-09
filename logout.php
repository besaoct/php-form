<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['uname']);
unset($_SESSION['loggedin']);
session_destroy();
session_start();
$_SESSION['msg'] = 'YOU ARE LOGGED OUT ! PLEASE LOGIN';
header('location:reglog.php');