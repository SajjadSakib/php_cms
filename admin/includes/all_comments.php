<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
        <?php include "delete_modal.php" ?>                      

                        <table class="table table-bordered table-hover">
                            <thead>
                               <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Email</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>In respose to</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>                                
                                
                                 
                               </tr>
                                
                            </thead>
                            <tbody>
<?php  //SHOWING ALL POSTS
$all_comments_query = "SELECT * FROM comments";
$result_comments = mysqli_query($connection,$all_comments_query);
while( $row = mysqli_fetch_assoc($result_comments)){
$comment_id = $row['comment_id'] ;
$comment_author = $row['comment_author'] ;
$comment_email = $row['comment_email'] ;
$comment_content = $row['comment_content'] ;
$comment_status = $row['comment_status'] ;
$comment_date = $row['comment_date'] ;
$comment_post_id = $row['comment_post_id'] ;


?>

                               <tr>
                                <td><?php echo $comment_id ?></td>
                                <td><?php echo $comment_author ?></td>
                                <td><?php echo $comment_email ?></td>

                                <td><?php echo $comment_content ?></td>
                                <td><?php echo $comment_status ?></td>
                                <td><?php 
$get_post_query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
$result_post = mysqli_query($connection,$get_post_query);
confirm_query($result_post) ;
$row = mysqli_fetch_assoc($result_post);
$post_title = $row['post_title'] ;                                   
echo "<a href='../post.php?p_id=$comment_post_id'>$post_title</a>" ;                                   
                                    
                                    
                                    ?></td>
                                <td><?php echo $comment_date ?></td>
                                <td><?php echo "<a href='comments.php?approve=$comment_id' >Approve </a>"; ?></td>
                                <td><?php echo "<a href='comments.php?unapprove=$comment_id' >Unapprove </a>"; ?></td>
                                <td><?php echo "<a class='delete_link' href='javascript:void(0);' rel=$comment_id' >Delete </a>"; ?></td>
                               </tr>
                               
                               <?php }?>
                 </tbody>
                        </table>
                        
                <script>
                $(document).ready(function(){
                $(".delete_link").click(function(){
                var comment_id = $(this).attr("rel");
                var link = 'comments.php?delete=' + comment_id;
                $("#modal_delete_button").attr("href",link);
                $("#delete_modal").modal('show');
                 
                
                })
                    
                });
                

                </script>