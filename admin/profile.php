<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Profile
                            <small><?php echo $_SESSION['username']?></small>
                        </h1>


<?php
if(isset($_SESSION['user_id'])){
$u_id = $_SESSION['user_id'];
$get_user_query = "SELECT * FROM users WHERE user_id={$u_id}";
$result_user = mysqli_query($connection,$get_user_query);
confirm_query($result_user) ;
$row = mysqli_fetch_assoc($result_user);
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];   
$username = $row['username'];
$user_email = $row['user_email'];
$db_user_password = $row['user_password'];
$user_role = $row['user_role'];    
}
?>
<?php
if(isset($_POST['update_profile'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    
//    $target_image_dir = $_FILES['image']['name'];
//    $client_image_dir = $_FILES['image']['tmp_name'];
//    
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['password'];
    if(!empty($user_password)){
        if($user_password !== $db_user_password){
            $hash_password = password_hash($user_password,PASSWORD_BCRYPT,array("cost"=>10));
        }else{
            $hash_password = $db_user_password;
        }
    }
    
    
    $user_role = $_SESSION['user_role'];

    $update_user_query = "UPDATE users ";
    $update_user_query .="SET user_firstname = '{$user_firstname}',";
    $update_user_query .="user_lastname = '{$user_lastname}',";
    $update_user_query .="username = '{$username}',";
    $update_user_query .="user_email = '{$user_email}', ";
    $update_user_query .="user_password = '{$hash_password}',";
    $update_user_query .="user_role = '{$user_role}',"; 
    $update_user_query .="user_image = 'image.jpg' ";
    $update_user_query .="WHERE user_id={$u_id}"; 
    $result_update_user = mysqli_query($connection,$update_user_query);
    if(!$result_update_user){
        die("Profile could not be updated" . mysqli_error($connection));
    }
    else{
        echo "Profile updated successfully";
    }
}

?>                      
                       

                       
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <lebel for="user_firstname"><b>Firstname</b></lebel>
                                <input type="text" class="form-control" name ="user_firstname" value="<?php echo $user_firstname ?>">
                            </div>
                            <div class="form-group">
                                <lebel for="user_lastnmae"><b>Lastname</b></lebel>
                                <input type="text" class="form-control" name ="user_lastname" value="<?php echo $user_lastname ?>">
                            </div>
                            
<!--
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
-->
                            <div class="form-group">
                                <lebel for="user_email"><b>Email</b></lebel>
                                <input type="email" class="form-control" name ="user_email" value="<?php echo $user_email ?>">
                            </div>
                            <div class="form-group">
                                <lebel for="username"><b>Username</b></lebel>
                                <input type="text" class="form-control" name ="username" value="<?php echo $username ?>">
                            </div>
                            <div class="form-group">
                                <lebel for="password"><b>Password</b></lebel>
                                <input type="password" class="form-control" name ="password" value="<?php echo $db_user_password ?>">
                                    
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="update_profile">Update profile</button>
                            </div>
                        </form>

  </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/footer.php" ?>                       