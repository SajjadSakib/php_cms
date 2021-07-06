<?php


function online_user(){
define("RUNNING_SCRIPT",true);
define("PASSWORD","Sajjad23");
if(isset($_GET['online_user'])){
include "../../includes/db.php";
session_start();
$session = session_id();
$time = time();
$time_out_in_seconds = 5 ;
$time_out = $time - $time_out_in_seconds ;
$session_get_query = "SELECT * FROM user_online WHERE session = '{$session}'";
$get_session_query = mysqli_query($connection,$session_get_query);
$count = mysqli_num_rows($get_session_query);
if($count == NULL){
    $session_add_query = "INSERT INTO user_online(session,time) VALUES('{$session}',{$time})";
    $send_session_query = mysqli_query($connection,$session_add_query);
}else{
    mysqli_query($connection,"UPDATE user_online SET time = {$time} WHERE session = '{$session}'");
}
$user_online_query = "SELECT * FROM user_online WHERE time > {$time_out}";
$send_query = mysqli_query($connection,$user_online_query);
echo mysqli_num_rows($send_query);

}}
online_user();   

?>