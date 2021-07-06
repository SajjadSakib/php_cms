<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
                       <h1 class="page-header">
                           Add User
                        </h1>

                       
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <lebel for="user_firstname"><b>Firstname</b></lebel>
                                <input type="text" class="form-control" name ="user_firstname">
                            </div>
                            <div class="form-group">
                                <lebel for="user_lastnmae"><b>Lastname</b></lebel>
                                <input type="text" class="form-control" name ="user_lastname">
                            </div>
                            
<!--
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
-->
                            <div class="form-group">
                                <lebel for="user_email"><b>Email</b></lebel>
                                <input type="email" class="form-control" name ="user_email">
                            </div>
                            <div class="form-group">
                                <lebel for="username"><b>Username</b></lebel>
                                <input type="text" class="form-control" name ="username">
                            </div>
                            <div class="form-group">
                                <lebel for="password"><b>Password</b></lebel>
                                <input autocomplete="off" type="password" class="form-control" name ="password">
                                    
                            </div>
                            <div class="form-group">
                                <lebel for="user_role"><b>Role</b></lebel>
                                <select class="form-control" name ="user_role">                               
<?php
//$all_categories_query = "SELECT * FROM categories";
//$result_category = mysqli_query($connection,$all_categories_query);
//confirm_query($result_category) ;
//while( $row = mysqli_fetch_assoc($result_category)){
//$cat_id = $row['cat_id'] ;
//$cat_item = $row['cat_item'] ;

?>
                                    <option value="subscriber">Subscriber</option>
                                    <option value="admin">Admin</option>
                                <?php //}?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="add_user">Add user</button>
                            </div>
                        </form>
<?php
if(isset($_POST['add_user'])){
    $user_firstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection,$_POST['user_lastname']);
    
//    $target_image_dir = $_FILES['image']['name'];
//    $client_image_dir = $_FILES['image']['tmp_name'];
//    
    $username =mysqli_real_escape_string($connection,$_POST['username']);
    $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
    $user_password = mysqli_real_escape_string($connection,$_POST['password']);
    $user_password = password_hash($user_password,PASSWORD_BCRYPT,array("cost"=>10));
    $user_role = mysqli_real_escape_string($connection,$_POST['user_role']);

    $add_user_query = "INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role) ";
    $add_user_query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','image.jpg','{$user_role}') ";
    $result_add_user = mysqli_query($connection,$add_user_query);
    if(!$result_add_user){
        die("User could not be added" . mysqli_error($connection));
    }
    else{
        //move_uploaded_file($client_image_dir, "../images/$target_image_dir");
        echo "User added successfully";
    }
}

?>
                        