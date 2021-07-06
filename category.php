
<?php include "includes/header.php" ?>


    <!-- Navigation -->
    
    <?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php
            if(!isset($_POST['search'])){
            if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])){
                
            $count_posts_query = "SELECT * FROM posts where post_category_id={$_GET['cat_id']} AND post_status ='published' ORDER BY post_id DESC";
                $count_result_posts = mysqli_query($connection,$count_posts_query);
                $post_count = mysqli_num_rows($count_result_posts);
                if($post_count !== 0){
                    include "includes/pager_req_process.php";
                 $all_posts_query = "SELECT * FROM posts where post_category_id={$_GET['cat_id']} AND post_status ='published' ORDER BY post_id DESC LIMIT $start_limit,$post_perpage";
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

             <?php }  
                }
                else{
                    echo "<h1>NO POST AVAILABLE</h1>";
                    
                    }
                }else{
                
                header("Location:index.php");
                exit;
                }}     
               else{
                    $text = $_POST['search_text'];
                    header("Location:search_results.php?search_text=$text" );
                    exit;}
                ?>
                

                <!-- Pager -->
                
                <?php
                if($post_count !== 0){
                include "includes/pager.php";} ?> 

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php" ?>
            
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>