<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
<?php 
if(isset($_SESSION['user_role'])){
if(isset($_GET['source'])){
    $source = $_GET['source'];
}else{
    $source ="";
}
    switch($source){
        case 'add_user':
            include "add_user.php";
            break;
        case 'edit_user':
            include "edit_user.php";
            break;
        default:
            include "includes/all_users.php";
            break;
            
    }

if(isset($_GET['delete_user'])){
$delete_user = $_GET['delete_user'];
$delete_user_query = "DELETE FROM users WHERE user_id=$delete_user";
$result_delete_user = mysqli_query($connection,$delete_user_query);
header("Location: users.php");
}
if(isset($_GET['change_to_admin'])){
$admin_user = $_GET['change_to_admin'];
$admin_user_query = "UPDATE users SET user_role='admin' WHERE user_id=$admin_user";
$result_delete_user = mysqli_query($connection,$admin_user_query);
header("Location: users.php");
}
if(isset($_GET['change_to_subscriber'])){
$subscriber_user = $_GET['change_to_subscriber'];
$subscriber_user_query = "UPDATE users SET user_role='subscriber' WHERE user_id=$subscriber_user";
$result_subscriber_user = mysqli_query($connection,$subscriber_user_query);
header("Location: users.php");
}
}
?>
                    </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/footer.php" ?>