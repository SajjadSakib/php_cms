<?php
if(!isset($_SESSION['username'])){
    die("Access Denied");
}

    
    ?>

<?php include "../includes/db.php";?>
<?php
function confirm_query($result){
global $connection;
if(!$result){
    die("QUERY FAILED" . mysqli_error($connection));
}    
}   

   
function add_category(){
global $connection;   
if(isset($_POST['submit'])){
    $cat_title = $_POST['add_category'];
    if($cat_title == ""||empty($cat_title)){
        echo"This field cannot be blank";
    }
    else{
    $add_categories_query = "INSERT INTO categories(cat_item) ";
    $add_categories_query .= "VALUES('{$cat_title}')";
    $result_add_category = mysqli_query($connection,$add_categories_query);
    if(!$result_add_category){
        die("Category could not be added" . mysqli_error($connection));
    }
    else{
        echo "Category {$cat_title} added successfully";
    }
}
}
}

function delete_category(){
global $connection;
if(isset($_GET['id'])){
$delete_categories_query = "DELETE FROM categories ";
$delete_categories_query .= "WHERE cat_id={$_GET['id']}";
$result_delete_category = mysqli_query($connection,$delete_categories_query);
header("Location: categories.php");
}
}

function update_category(){
global $connection;
if(isset($_POST['update_category'])){
$update_categories_query = "UPDATE categories ";
$update_categories_query .="SET cat_item='{$_POST['update_category']}' ";
$update_categories_query .= "WHERE cat_id={$_GET['edit_id']}";
$result_update_category = mysqli_query($connection,$update_categories_query);
header("Location: categories.php");
}    
}

?>