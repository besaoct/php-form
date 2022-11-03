<?php 

session_start();
ob_start();

$db= mysqli_connect('localhost','root','','phpform') or die("Database is not connected");
if($db){
    $_SESSION['comp']="User";

}
$url=parse_url('localhost/php-form', PHP_URL_HOST);
?>