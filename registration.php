
   <?php include "includes/header.php" ?>
    <?php
    isUserLoggedInRedirect() ?>
  <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
  <?php
require 'vendor/autoload.php';
 $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
 $dotenv->load();

 $options = array(
    'cluster' => 'ap2',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    $_ENV['APP_KEY'],
    $_ENV['APP_SECRET'],
    $_ENV['APP_ID'],
    $options
  );


?>
    
<?php
if(isset($_POST['submit'])){
   
$username = mysqli_real_escape_string($connection,$_POST['username']);    
$password = mysqli_real_escape_string($connection,$_POST['password']);    
$email = mysqli_real_escape_string($connection,$_POST['email']);
$error = [
    'username'=>'',
    'password'=>'',
    'email'=>''
];
if($username !== '' && $password !=='' && $email !=='' ){
if(!duplicate_user($username) && !duplicate_email($email) && password_verification($password)){
$password = password_hash($password,PASSWORD_BCRYPT,array("cost"=>10));
$registration_query = "INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role) ";
    $registration_query .= "VALUES('{$username}','{$password}','','','{$email}','image.jpg','subscriber') ";
    $result_registration = mysqli_query($connection,$registration_query);
    if(!$result_registration){
        die("Registration Failed " . mysqli_error($connection));
    }
    else{
        echo "Registration successfully";
        $data['message'] = "{$username} just registered";
        $pusher->trigger('my-channel', 'my-event', $data);
}
}
else{
    if(duplicate_user($username)){
       $error['username'] = "Username alredy exists";
    }
    if(duplicate_email($email)){
       $error['email'] = "Email alredy exists"; 
    }
    if(strlen($password) < 4){
       $error['password'] = "Password cannot be less than 4"; 
    }
    if(strlen($password) > 14){
       $error['password'] = "Password cannot be more than 14"; 
    }
}  
}
else{
   $error['username'] = "Username cannot be empty";
   $error['password'] = "Password cannot be empty";
   $error['email'] = "Email cannot be empty";
}
}

?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input autocomplete="on" type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input autocomplete="on" type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
