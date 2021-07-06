<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
<?php include "includes/db.php" ?>
<?php
function duplicate_user($username){
global $connection;
$username_query = "SELECT * FROM users WHERE username = '{$username}'";
$result_username = mysqli_query($connection,$username_query);
return mysqli_num_rows($result_username);    
}

function duplicate_email($email){
global $connection;
$email_query = "SELECT * FROM users WHERE user_email = '{$email}'";
$result_email = mysqli_query($connection,$email_query);
return mysqli_num_rows($result_email);    
}

function password_verification($password){
    if(strlen($password) < 4 || strlen($password) > 14){
        return FALSE;
    }else{
        return TRUE;
    }
}

function userLikedIt($user_id,$post_id){
    global $connection;
    $user_like_query = "SELECT * FROM likes WHERE user_id = {$user_id} AND post_id = {$post_id}";
    $send_user_like = mysqli_query($connection,$user_like_query);
    $count = mysqli_num_rows($send_user_like);
    return $count == 0 ? false : true;
}

function isUserLoggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    }else{
        return false;
    }
}

function isUserLoggedInRedirect(){
    if(isUserLoggedIn()){
        header("Location: index.php");
        exit;
    }}

function userId(){
    return $_SESSION['user_id'];    
}

function ifEmailExist($email){
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email='{$email}'";
    $send_query = mysqli_query($connection,$query);
    $rows = mysqli_num_rows($send_query);
    if($rows == 0){
        return false;
    }else{
        return true;
    }
    
    
    
    
    
    
}
?>