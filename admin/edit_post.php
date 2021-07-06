<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
                        <h1 class="page-header">
                            Edit Post
                        </h1>

<?php  //SHOWING ALL POSTS
if(isset($_GET['post_id'])){
$id = $_GET['post_id'];
$specified_post_query = "SELECT * FROM posts WHERE post_id={$id}";
$result_post = mysqli_query($connection,$specified_post_query);
$row = mysqli_fetch_assoc($result_post);
$post_id = $row['post_id'] ;
$post_category_id = $row['post_category_id'] ;
$post_title = $row['post_title'] ;
$post_author = $row['post_author'] ;
$post_date = $row['post_date'] ;
$post_image = $row['post_image'] ;
$post_content = $row['post_content'] ;
$post_tags = $row['post_tags'] ;
$post_status = $row['post_status'] ;
$post_category = "" ;
$post_comment = "" ;
    

}


?>
<?php
if(isset($_POST['update_post'])){
    $post_category_id = $_POST['category_id'];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    
    $target_image_dir = $_FILES['add_image']['name'];
    $client_image_dir = $_FILES['add_image']['tmp_name'];
    $post_content = $_POST['content'];
    $post_tags = $_POST['tags'];
    $post_status = $_POST['post_status'];

    if($target_image_dir === ''){
        $set_image_query = "SELECT * FROM posts WHERE post_id={$id}";
        $result_image_query = mysqli_query($connection,$set_image_query);
        $row = mysqli_fetch_assoc($result_image_query);
        $target_image_dir = $row['post_image'];
        
    }
    
    $add_post_query = "UPDATE posts ";
    $add_post_query .="SET post_category_id = {$post_category_id}, ";
    $add_post_query .="post_title = '{$post_title}',";
    $add_post_query .="post_author = '{$post_author}',";
    $add_post_query .="post_date = now(), ";
    $add_post_query .="post_image = '{$target_image_dir}',";
    $add_post_query .="post_content = '{$post_content}',";
    $add_post_query .="post_tags = '{$post_tags}',"; 
    $add_post_query .="post_comment_count = 0 ,";
    $add_post_query .="post_status = '{$post_status}' ";
    $add_post_query .="WHERE post_id={$id}"; 
    $result_update_post = mysqli_query($connection,$add_post_query);
    if(!$result_update_post){
        die("Post could not be updated" . mysqli_error($connection));
    }
    
    else{
        echo "<p class='bg-success'>Post updated successfully <a href='../post.php?p_id=$id'>View Post</a> or <a href='posts.php'>Edit Others</a></p>";
    
    }
}

?>
                       
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <lebel for="title"><b>Title</b></lebel>
                                <input type="text" class="form-control" name ="title" value="<?php echo $post_title ?>" >
                            </div>
                            <div class="form-group">
                                <lebel for="author"><b>Author</b></lebel>
                                <input type="text" class="form-control" name ="author" value="<?php echo $post_author ?>" >
                            </div>
                            <div class="form-group">
                                <lebel for="add_category"><b>Category</b></lebel>
                                <select class="form-control" name ="category_id">                               
<?php
$all_categories_query = "SELECT * FROM categories";
$result_category = mysqli_query($connection,$all_categories_query);
confirm_query($result_category) ;
while( $row = mysqli_fetch_assoc($result_category)){
$cat_id = $row['cat_id'] ;
$cat_item = $row['cat_item'] ;

?>
                                    <option value="<?php echo $cat_id ?>"><?php echo $cat_item ?></option>
                                <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label> 
                                <img width="100" src="../images/<?php echo $post_image ?>" alt="">
                                <input type="file" class="form-control-file" id="add_image" name="add_image">
                            </div>
                            <div class="form-group">
                                <lebel for="content"><b>Content</b></lebel>
                                <textarea type="text" class="form-control" name ="content" rows="8" id="body" ><?php echo $post_content ?> </textarea>
                            </div>
                            <div class="form-group">
                                <lebel for="tags"><b>Tags</b></lebel>
                                <input type="text" class="form-control" name ="tags" value="<?php echo $post_tags ?>">
                            </div>
                            <div class="form-group">
                                <lebel for="add_category"><b>Post status</b></lebel>
                                <select class="form-control" name ="post_status">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="update_post">Update post</button>
                            </div>
                        </form>

                        