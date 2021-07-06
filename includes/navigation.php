<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
   

<?php include "db.php" ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                
                <?php
                    $all_categories_query = "SELECT * FROM categories";
                    $result_category = mysqli_query($connection,$all_categories_query);
                    while( $row = mysqli_fetch_assoc($result_category)){
                        $cat_id = $row['cat_id'];
                        $cat_item = $row['cat_item'];
                        $category_class = '';
                        $registration_class ='';
                        $login_class ='';
                        $page_name = basename($_SERVER['PHP_SELF']);
                        if($page_name == 'category.php'  && $_GET['cat_id'] == $cat_id){
                            $category_class = 'active';
                        }
                        if($page_name == 'registration.php'){
                            $registration_class = 'active';
                        }
                        if($page_name == 'login.php'){
                            $login_class = 'active';
                        }
                        echo "<li class='{$category_class}'><a href='category.php?cat_id={$cat_id}'>{$cat_item}</a></li>" ;
                    }
                if(isUserLoggedIn()){
                ?>
                    <li>
                        <a href="admin/index.php">Admin</a>
                    </li>
                    <li>
                        <a href="includes/logout.php">Logout</a>
                    </li>
                    <?php } 
                    if(!isUserLoggedIn()){ ?>
                    <li class="<?php echo $login_class ?>">
                        <a href="login.php">Login</a>
                    </li>
                    <li class="<?php echo $registration_class ?>">
                        <a href="registration.php">Register</a>
                    </li>
                    <?php }
                    
                    if(isset($_SESSION['username'])){
                        if(isset($_GET['p_id'])){
                        echo "<li>
                                <a href='admin/posts.php?source=edit_post&post_id={$_GET['p_id']}'>Edit</a>
                            </li>";
                    }
                    }
                    ?>
                    
                    
<!--
                    <li>
                        <a href="#">Contact</a>
                    </li>
-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>