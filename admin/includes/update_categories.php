<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
<?php
  $category_query = "SELECT * FROM categories ";
 $category_query .= "WHERE cat_id={$_GET['edit_id']}";
 $result_specified_category = mysqli_query($connection,$category_query);                                           
$row = mysqli_fetch_assoc($result_specified_category);
 if($row){
 ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <lebel for="add_category"><b>Update Category</b></lebel>
                                <input type="text" class="form-control" name ="update_category" value="<?php echo $row['cat_item'];} ?>">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit">Update category</button>
                            </div>
                        </form>