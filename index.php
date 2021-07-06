 <?php include "includes/header.php" ?>

    <!-- Navigation -->
    
    <?php include "includes/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php 
    if(isset($_POST['search'])){
        $text = $_POST['search_text'];
       header("Location:search_results.php?search_text=$text" );
        exit;
    }else{
      include "includes/all_posts.php";  
    }
     ?>
                

                <!-- Pager -->

             <?php include "includes/pager.php" ?>   

            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "includes/sidebar.php" ?>
            
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>