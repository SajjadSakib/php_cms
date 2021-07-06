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
        case 'add_posts':
            include "add_posts.php";
            break;
        case 'edit_post':
            include "edit_post.php";
            break;
        default:
            include "includes/all_posts.php";
            break;
            
    }

if(isset($_GET['delete'])){
$delete = $_GET['delete'];
$delete_post_query = "DELETE FROM posts ";
$delete_post_query .= "WHERE post_id={$delete}";
$result_post_category = mysqli_query($connection,$delete_post_query);
if($result_post_category){
$delete_comment_query = "DELETE FROM comments ";
$delete_comment_query .= "WHERE comment_post_id={$delete}";
$result_delete_comment = mysqli_query($connection,$delete_comment_query);
confirm_query($result_delete_comment);
header("Location: posts.php");
}}
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