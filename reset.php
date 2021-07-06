<?php  include "includes/header.php"; ?>
<?php isUserLoggedInRedirect() ?>
<?php
if(!isset($_GET['email']) || !isset($_GET['token'])){
    header("Location:index.php");
    exit;
}elseif(empty($_GET['email']) || empty($_GET['token'])){
    header("Location:index.php");
    exit;
}
$email = $_GET['email'];
$token = $_GET['token'];
$confirm_query = "SELECT * FROM users WHERE user_email='{$email}' AND token='{$token}'";
$send_confirm_query = mysqli_query($connection,$confirm_query);
$confirm_count = mysqli_num_rows($send_confirm_query);
if($confirm_count == 0){
    header("Location:index.php");
    exit;
}else{
    if(isset($_POST['reset-submit'])){
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $confirm_password = mysqli_real_escape_string($connection,$_POST['confirm_password']);
        $error = [
            'password'=>'',
            'confirm_password'=>''
            
        ];
      if($password === $confirm_password){
          if(password_verification($password)){
              $password = password_hash($password,PASSWORD_BCRYPT,array("cost"=>10));
              $reset_query ="UPDATE users SET user_password='{$password}', token='' WHERE user_email='{$email}'";
              $send_reset_query = mysqli_query($connection,$reset_query);
               header("Location:login.php");
               exit;
              
          }else{
              if(strlen($password) < 4){
                $error['password'] = $error['confirm_password'] = "Password cannot be less than 4"; 
            }
            if(strlen($password) > 14){
                $error['password'] = $error['confirm_password'] = "Password cannot be more than 14"; 
            }
        }
    }else{
         $error['password'] = $error['confirm_password'] = "Password didn't match"; 
      }
}
}
?>


<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset your password</h2>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="">

                                    <div class="form-group">
                                        <label for="password" class="input-group">New password</label>
                                        <input  name="password" placeholder="Enter password" class="form-control"  type="password">
                                        <p class="input-group"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>

                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password" class="input-group">Confirm password</label>
                                        <input  name="confirm_password" placeholder="Confirm password" class="form-control"  type="password">
                                        <p class="input-group"><?php echo isset($error['confirm_password']) ? $error['confirm_password'] : '' ?></p>

                                    </div>
                                    <div class="form-group">
                                        <input name="reset-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                </form>

                            </div><!-- Body-->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

