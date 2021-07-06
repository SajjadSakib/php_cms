<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
                        <h1 class="page-header">
                            All Posts
                        </h1>
<?php
if(isset($_POST['checkBoxes'])){
    foreach($_POST['checkBoxes'] as $checkbox){
        if($_POST['bulkOptions'] !== ''){
            $bulkoption = $_POST['bulkOptions'];
            switch($bulkoption){
                case "draft":
                    $update_query = "UPDATE posts SET post_status='{$bulkoption}' WHERE post_id=$checkbox";
                    $result_query = mysqli_query($connection,$update_query);
                    confirm_query($result_query);
                    break;
                case "published":
                    $update_query = "UPDATE posts SET post_status='{$bulkoption}' WHERE post_id=$checkbox";
                    $result_query = mysqli_query($connection,$update_query);
                    confirm_query($result_query);
                    break;
                case "delete":

                    $update_query = "DELETE FROM posts WHERE post_id=$checkbox";
                    $result_query = mysqli_query($connection,$update_query); 
                    confirm_query($result_query);
                    break;
                case "clone":
                    $all_post_query = "SELECT * FROM posts WHERE post_id=$checkbox";
                    $result_post = mysqli_query($connection,$all_post_query);
                    $row = mysqli_fetch_assoc($result_post);
                    $post_title = $row['post_title'] ;
                    $post_category = $row['post_category_id'];
                    $post_author = $row['post_author'] ;
                    $post_date = $row['post_date'] ;
                    $post_image = $row['post_image'] ;
                    $post_tags = $row['post_tags'] ;
                    $post_status = $row['post_status'] ;
                    $post_category = $row['post_category_id'] ;
                    $post_comment_count = $row['post_comment_count'] ;
                    $post_content = $row['post_content'];
                    
                    
                    
                    $add_post_query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
                    $add_post_query .= "VALUES('{$post_category}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', 0,'{$post_status}') ";
                    $result_add_post = mysqli_query($connection,$add_post_query);
                    break;
            }
            
            
        }
//        echo $checkbox;
    }
}

?>            
            <?php include "delete_modal.php" ?>
                         
                    <form action="" method="post">
                          
                          <table class="table table-bordered table-hover">
                           
                               <div class="correction col-xs-4" id="bulkOptionContainer">
                                   <select class="form-control" name="bulkOptions">
                                       <option value="">Select Option</option>
                                       <option value="draft">Draft</option>
                                       <option value="published">Published</option>
                                       <option value="delete">Delete</option>
                                       <option value="clone">Clone</option>
                                   </select>
                               </div>
                               <div class="col-xs-4">
                                   <input type="submit" name="submit" value ="Apply" class="btn btn-success custom_b"><a href="posts.php?source=add_posts" class="btn btn-primary">Add New</a>
                               </div>
                            <thead>
                               <tr>
                               <th><input type="checkbox" id="all_boxes"></th>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>View Post</th>                                
                                <th>Delete</th>
                                <th>Edit</th>
                                 
                               </tr>
                                
                            </thead>
                            <tbody>
<?php  //SHOWING ALL POSTS
$all_post_query = "SELECT * FROM posts ORDER BY post_id DESC";
$result_post = mysqli_query($connection,$all_post_query);
while( $row = mysqli_fetch_assoc($result_post)){
$post_id = $row['post_id'] ;
$post_title = $row['post_title'] ;
$post_author = $row['post_author'] ;
$post_date = $row['post_date'] ;
$post_image = $row['post_image'] ;
$post_tags = $row['post_tags'] ;
$post_status = $row['post_status'] ;
$post_category = $row['post_category_id'] ;
$post_comment_count = $row['post_comment_count'] ;

?>

                               <tr>
                                <td><input type="checkbox" name="checkBoxes[]" value="<?php echo $post_id ?>" class="checkbox"></td>
                                <td><?php echo $post_id ?></td>
                                <td><?php echo $post_title ?></td>
                                <td><?php echo $post_author ?></td>
                                <td><?php 
$all_categories_query = "SELECT * FROM categories WHERE cat_id=$post_category";
$result_category = mysqli_query($connection,$all_categories_query);
confirm_query($result_category) ;
$row = mysqli_fetch_assoc($result_category);
$cat_item = $row['cat_item'] ;                                   
echo $cat_item;                                   
                                    
                                    
                                    ?></td>
                                <td><?php echo $post_status ?></td>
                                <td><?php echo "<img width='100px' src='../images/{$post_image}'>" ?></td>
                                <td><?php echo $post_tags ?></td>
                                <td><?php echo $post_comment_count ?></td>
                                <td><?php echo $post_date ?></td>
                                <td><?php echo "<a href='../post.php?p_id=$post_id' >View Post</a>"; ?></td>
                                <td><?php echo "<a rel='$post_id' href='javascript:void(0);' class='delete_link'>Delete </a>"; ?></td>
                                 <td><?php echo "<a href='posts.php?source=edit_post&post_id=$post_id' >Edit </a>";?></td>
                                </tr>
                               
                               <?php }?>
                 </tbody>
                        </table>
                        
                       </form>
                       
                      

            <script>
                $(document).ready(function(){
                $(".delete_link").click(function(){
                var post_id = $(this).attr("rel");
                var link = 'posts.php?delete=' + post_id;
                $("#modal_delete_button").attr("href",link);
                $("#delete_modal").modal('show');
                 
                
                })
                    
                });
                

            </script>
