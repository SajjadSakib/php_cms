<?php  include "includes/header.php"; ?>

<?php isUserLoggedInRedirect() ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
if(!isset($_GET['forgot'])){
    header("Location:index.php");
    exit;
}
if(isset($_POST['recover-submit'])){
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));
    if(ifEmailExist($email)){
        $token_query = "UPDATE users SET token='{$token}' WHERE user_email='{$email}'";
        $send_token = mysqli_query($connection,$token_query);
    
    $mail = new PHPMailer(true);
    


    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '7871121b56d29d';                     // SMTP username
    $mail->Password   = '39675e83d25248';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('sajjadsakib76@gmail.com', 'Sajjad Sakib');
    $mail->addAddress($email);     // Add a recipient
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Recover your password';
    $mail->Body    = "<p>Please click the link bellow to reset your password</b><br>
                        <a href='http://localhost/cms/reset.php?email={$email}&token={$token}'>Reset Your Password </a> ";    
    

     
    
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
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

<?php
if(isset($_POST['recover-submit']) && $mail->send()){

    echo "<h1>PLEASE CHECK YOUR INBOX</h1>";
}       
else{                            
                            
?>


                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                
<?php }?>                                

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

