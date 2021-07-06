<?php
        if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
            die("Access Denied");
        }
                $count_posts_query = "SELECT * FROM posts WHERE post_status ='published' ORDER BY post_id DESC";
                $count_result_posts = mysqli_query($connection,$count_posts_query);
                $post_count = mysqli_num_rows($count_result_posts);
                include "includes/pager_req_process.php";
                $all_posts_query = "SELECT * FROM posts WHERE post_status ='published' ORDER BY post_id DESC LIMIT $start_limit,$post_perpage";
                $result_posts = mysqli_query($connection,$all_posts_query);
                while( $row = mysqli_fetch_assoc($result_posts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
            ?>
              
              <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr> 

             <?php }?>
               

