<?php include "includes/header.php" ?>


    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <!-- Blog Post -->
            <?php
            if(!isset($_POST['search'])){
            if(isset($_GET['p_id']) && !empty($_GET['p_id'])){
                  
               $p_id = $_GET['p_id'];
               $all_posts_query = "SELECT * FROM posts WHERE post_id={$p_id} AND post_status ='published'";
                $result_posts = mysqli_query($connection,$all_posts_query);
                $row_num = mysqli_num_rows($result_posts);
                  if($row_num >= 1){
                $row = mysqli_fetch_assoc($result_posts);
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_likes = $row['post_likes'];
                if(isUserLoggedIn()){
                    $user_id = userId();
                   //LIKING THE POST   
                if(isset($_POST['liked']) && !userLikedIt($user_id,$p_id)){
                    
                    $like_query = "INSERT INTO likes(user_id,post_id) VALUES('{$user_id}','{$p_id}')";
                    $send_like = mysqli_query($connection,$like_query);
                    if($send_like){
                        $like_post = "UPDATE posts SET post_likes =$post_likes + 1 WHERE post_id = {$p_id}";
                        $send_post_likes = mysqli_query($connection,$like_post);
                    }
                }
                      //UNLIKING THE POST
                if(isset($_POST['unliked']) && userLikedIt($user_id,$p_id)){
                    
                    $unlike_query = "DELETE FROM likes WHERE user_id = {$user_id}";
                    $send_unlike = mysqli_query($connection,$unlike_query);
                    if($send_unlike){
                        $unlike_post = "UPDATE posts SET post_likes =$post_likes - 1 WHERE post_id = {$p_id}";
                        $send_post_unlikes = mysqli_query($connection,$unlike_post);
                    }
                }
                }
            ?>
              
              <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr> 
                <?php
                if(isUserLoggedIn()){
                if(!userLikedIt($user_id,$p_id)){
                    $like_text = "Like";
                    $class = "like";
                    $icon_class ="glyphicon glyphicon-thumbs-up";
                    $title = "Click to like it";
                }else{
                    $like_text = "Unlike";
                    $class = "unlike";
                    $icon_class ="glyphicon glyphicon-thumbs-down";
                    $title = "Liked it before";
                }
                
                ?>
                 <div class="row">
                     <p style="font-size:20px" class="pull-right"><a href="" data-toggle="tooltip" data-placement="top" title="<?php echo $title ?>" class="<?php echo $class ?>"><span style="font-size:30px" class="<?php echo $icon_class ?>"><?php echo $like_text ?></span></a></p>
                 </div>
                 <?php }else{ ?>
                  <div class="row">
                     <p class="pull-right">Please <a href="login.php">login</a> to like</p>
                 </div>
                    
                        
                    
              <?php  } ?>
                
                <div class="row">
                     <p class="pull-right">Likes:  <?php echo $post_likes ?></p>
                 </div>
                 <div class="clearfix">   </div>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                
                
                <div class="well">
                    <form role="form"  action="" method="post">
                       <div class="form-group">
                            <lebel for="comment_author"><b>Name</b></lebel>
                            <input type="text" class="form-control" name ="comment_author">
                        </div>
                        <div class="form-group">
                            <lebel for="email"><b>Email</b></lebel>
                            <input type="text" class="form-control" name ="email">
                        </div>
                        <div class="form-group">
                           <lebel for="comment"><b>Your comment</b></lebel>
                            <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_comment">Submit</button>
                    </form>
                </div>
                
<?php
if(isset($_POST['submit_comment'])){
    $post_id = $_GET['p_id'];
    $comment_author = $_POST['comment_author'];
    $comment_content = $_POST['comment'];
    $comment_email = $_POST['email'];
    if($comment_author !== '' && $comment_content !=='' && $comment_email !=='' ){
        $add_comment_query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
        $add_comment_query .= "VALUES({$post_id},'{$comment_author}','{$comment_email}','{$comment_content}','Unapproved',now()) ";
        $result_add_comment = mysqli_query($connection,$add_comment_query);
        if(!$result_add_comment){
        die("Query failed " . mysqli_error($connection));
        }    
        $comment_count_query = "UPDATE posts SET post_comment_count=$post_comment_count + 1 WHERE post_id=$p_id";
        $result_comment_count = mysqli_query($connection,$comment_count_query);
        if(!$result_comment_count){
        die("Query failed " . mysqli_error($connection));
        }  
        
    }else{
       echo "<script>alert('Fields cannot be Empty')</script>";
    }

     
    
}
                
                
?>

                <hr>

                <!-- Posted Comments -->

 <?php  //SHOWING ALL POSTS
$all_comments_query = "SELECT * FROM comments WHERE comment_post_id=$p_id AND comment_status='Approved'";
$result_comments = mysqli_query($connection,$all_comments_query);
while( $row = mysqli_fetch_assoc($result_comments)){
$comment_id = $row['comment_id'] ;
$comment_author = $row['comment_author'] ;
$comment_email = $row['comment_email'] ;
$comment_content = $row['comment_content'] ;
$comment_date = $row['comment_date'] ;


?>
              
               
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                       <?php echo $comment_content ?>
                    </div>
                </div>

                <?php } }else{
                      echo "<h1>NO POST AVAILABLE</h1>";
                  } } }else{
                    $text = $_POST['search_text'];
                   header("Location:search_results.php?search_text=$text" );
                    exit;
            } ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php" ?>
           </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php include "includes/footer.php" ?>
       
      
     
    <script>
        var user_id = <?php echo $user_id; ?> ;
        var post_id = <?php echo $p_id; ?>;
    $(document).ready(function(){
        $(".like").click(function(){
         $.ajax({
             url:"/cms/post.php?p_id=" + post_id,
             type:"post",
             data:{
                 liked: 1,
                 user_id: user_id,
                 post_id: post_id
             }
         });
        });
        
        
        $(".unlike").click(function(){
         $.ajax({
             url:"/cms/post.php?p_id=" + post_id,
             type:"post",
             data:{
                 unliked: 1,
                 user_id: user_id,
                 post_id: post_id
             }
         });
        });
        
       $('[data-toggle="tooltip"]').tooltip(); 
        
    })    
        
    </script>