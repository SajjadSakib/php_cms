<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
     <div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="" method="post">
                    <div class="input-group">
                        <input name="search_text" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="search"class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!-- /.input-group -->
                </div>
                <div class="well">  <!--login-group-->
                   <?php 
                    if(isset($_SESSION['user_role'])){
                        echo "<h4> Logged in as " . $_SESSION['username'] . "</h4>";
                        echo "<a href='includes/logout.php'><button class='btn btn-primary'>Logout</button></a>";
                        
                    }
                    else{
                    ?>
                   
                   
                    <h4>User Login</h4>
                    <form action="includes/login_process.php" method="post">
                    <div class="form-group">
                     
                        <input name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group">
                        <input autocomplete="off" name="password" type="password" class="form-control" placeholder="Password">
                       
                        <span class="input-group-btn">
                            <button name="login" class="btn btn-primary" type="submit">
                                <span>Login</span>
                            </button>
                        </span>
                        
                       </div>
                   <div class="form-group">
                        <a href="forgot.php?forgot=<?php echo uniqid(true)?>">Forgot password?</a>
                  </div>
                    </form><!-- /.login-group-->
                    <?php } ?>
                </div>
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">

                           
                            <ul class="list-unstyled">
                        <?php
                            $all_categories_query = "SELECT * FROM categories";
                            $result_categories = mysqli_query($connection,$all_categories_query);
                            while( $row = mysqli_fetch_assoc($result_categories)){
                             ?>   
                           
                                <li><a href="<?php echo "category.php?cat_id={$row['cat_id']}" ?>"><?php echo $row['cat_item'] ?></a>
                                </li>
                                
                        <?php        
                             }  
                        ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>
