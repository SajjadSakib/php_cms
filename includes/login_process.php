<?php session_start() ?>
<?php ob_start() ?>
<?php 
define("RUNNING_SCRIPT",true);
define("PASSWORD","Sajjad23");

?> 
<?php include "db.php" ?>
<?php
if(isset($_POST['login'])){
$login_username = mysqli_real_escape_string($connection,$_POST['username']);
$login_password = mysqli_real_escape_string($connection,$_POST['password']);
$all_user_query = "SELECT * FROM users";
$result_user = mysqli_query($connection,$all_user_query);
while( $row = mysqli_fetch_assoc($result_user)){
$db_user_id = $row['user_id'] ;
$db_username = $row['username'] ;
$db_user_firstname = $row['user_firstname'] ;
$db_user_lastname = $row['user_lastname'] ;
$db_user_email = $row['user_email'] ;
$db_user_role = $row['user_role'] ;
$db_user_password = $row['user_password'];
$password_check = password_verify($login_password,$db_user_password);
if($login_username === $db_username && $password_check){
$_SESSION['username'] = $db_username;
$_SESSION['user_email'] = $db_user_email;
$_SESSION['user_role'] = $db_user_role;
$_SESSION['user_id'] = $db_user_id;
header("Location:../admin/index.php");
break;
}
else{
header("Location:../index.php");
}}
 }







?>