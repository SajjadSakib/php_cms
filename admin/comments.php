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
                            All Comments
                        </h1>
<?php
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
            include "includes/all_comments.php";
            break;
            
    }

if(isset($_GET['delete'])){
$delete = $_GET['delete'];
$delete_comment_query = "DELETE FROM comments ";
$delete_comment_query .= "WHERE comment_id={$delete}";
$result_delete_comment = mysqli_query($connection,$delete_comment_query);
confirm_query($result_delete_comment);
header("Location: comments.php");
}
if(isset($_GET['approve'])){
$approve = $_GET['approve'];
$approve_comment_query = "UPDATE comments ";
$approve_comment_query .= "SET comment_status='Approved' ";
$approve_comment_query .= "WHERE comment_id={$approve}";
$result_approve_comment = mysqli_query($connection,$approve_comment_query);
confirm_query($result_approve_comment);
header("Location: comments.php");
}
if(isset($_GET['unapprove'])){
$unapprove = $_GET['unapprove'];
$unapprove_comment_query = "UPDATE comments ";
$unapprove_comment_query .= "SET comment_status='Unapproved' ";
$unapprove_comment_query .= "WHERE comment_id={$unapprove}";
$result_unapprove_comment = mysqli_query($connection,$unapprove_comment_query);
confirm_query($result_unapprove_comment);
header("Location: comments.php");
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
        
       