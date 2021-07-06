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
                            Categories
                        </h1>
                    <div class="col-xs-6">
<?php //ADDING CATEGORY
add_category();
  
?>
                       
                        <form action="" method="post">
                            <div class="form-group">
                                <lebel for="add_category"><b>Add Category</b></lebel>
                                <input type="text" class="form-control" name ="add_category">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Add category</button>
                            </div>
                        </form>
                        
<?php //GETTING CATEGORY FORM
if(isset($_GET['edit_id'])){
?>
<?php include "includes/update_categories.php" ?>
                        
<?php }  ?>

                        
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                               <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Delete</th>
                                <th>Edit</th> 
                               </tr>
                                
                            </thead>
                            <tbody>
<?php  //SHOWING CATEGORY
$all_categories_query = "SELECT * FROM categories";
$result_category = mysqli_query($connection,$all_categories_query);
while( $row = mysqli_fetch_assoc($result_category)){
$cat_id = $row['cat_id'] ;
$cat_item = $row['cat_item'] ;
?>

                               <tr>
                                <td><?php echo $cat_id ?></td>
                                <td><?php echo $cat_item ?></td>
                                <td>
                                <?php echo "<a href='categories.php?id={$cat_id}'>Delete</a>" ?></td>
                                <td>
                                <?php echo "<a href='categories.php?edit_id={$cat_id}'>Edit</a>" ?>
                                </td>
                               </tr>
                               
                               <?php }?>
<?php //DELETING CATEGORY
delete_category();
?>
                           
<?php //UPDATING CATEGORY
update_category();                                

?>
                           
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/footer.php" ?>