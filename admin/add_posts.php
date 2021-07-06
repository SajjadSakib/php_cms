<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
                       <h1 class="page-header">
                            Add Post
                        </h1>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <lebel for="title"><b>Title</b></lebel>
                                <input type="text" class="form-control" name ="title">
                            </div>
                            <div class="form-group">
                                <lebel for="author"><b>Author</b></lebel>
                                <input type="text" class="form-control" name ="author">
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
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <lebel for="content"><b>Content</b></lebel>
                                <textarea type="text" class="form-control" name ="content" rows="10" id="body"></textarea>
                            </div>
                            <div class="form-group">
                                <lebel for="tags"><b>Tags</b></lebel>
                                <input type="text" class="form-control" name ="tags">
                            </div>
                            <div class="form-group">
                                <lebel for="add_category"><b>Post status</b></lebel>
                                <select class="form-control" name ="post_status">
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="add_post">Add post</button>
                            </div>
                        </form>
<?php
if(isset($_POST['add_post'])){
    $post_category_id = $_POST['category_id'];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    
    $target_image_dir = $_FILES['image']['name'];
    $client_image_dir = $_FILES['image']['tmp_name'];
    $post_content = $_POST['content'];
    $post_tags = $_POST['tags'];
    $post_status = $_POST['post_status'];

    $add_post_query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
    $add_post_query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$target_image_dir}','{$post_content}','{$post_tags}', 0,'{$post_status}') ";
    $result_add_post = mysqli_query($connection,$add_post_query);
    if(!$result_add_post){
        die("Post could not be added" . mysqli_error($connection));
    }
    else{
        move_uploaded_file($client_image_dir, "../images/$target_image_dir");
        echo "Post added successfully";
    }
}

?>
                        