
<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">
           
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin page
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                    </div>
                           
                <!-- /.row -->
                
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                      <div class='huge'>
<?php
$post_num_query = "SELECT * FROM posts";
$post_num_result = mysqli_query($connection,$post_num_query);
$post_num = mysqli_num_rows($post_num_result);
echo $post_num;
?>

                                           
                                           
                                           </div>
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="posts.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                         <div class='huge'>
<?php
$comment_num_query = "SELECT * FROM comments";
$comment_num_result = mysqli_query($connection,$comment_num_query);
$comment_num = mysqli_num_rows($comment_num_result);
echo $comment_num;
?>                                         
                                         
                                         </div>
                                          <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="comments.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                        <div class='huge'>
<?php
$user_num_query = "SELECT * FROM users";
$user_num_result = mysqli_query($connection,$user_num_query);
$user_num = mysqli_num_rows($user_num_result);
echo $user_num;
?>                                            
                                            </div>
                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="users.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class='huge'>
<?php
$categories_num_query = "SELECT * FROM categories";
$categories_num_result = mysqli_query($connection,$categories_num_query);
$categories_num = mysqli_num_rows($categories_num_result);
echo $categories_num;
?>                                              
                                            </div>
                                             <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="categories.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                                    <!-- /.row -->
                </div>
                <!-- /.row -->
                
<?php
$post_num_query = "SELECT * FROM posts WHERE post_status='draft'";
$post_num_result = mysqli_query($connection,$post_num_query);
$dr_post_num = mysqli_num_rows($post_num_result);


$ap_comment_num_query = "SELECT * FROM comments WHERE comment_status='Unapproved'";
$ap_comment_num_result = mysqli_query($connection,$ap_comment_num_query);
$ap_comment_num = mysqli_num_rows($ap_comment_num_result);

$dr_comment_num_query = "SELECT * FROM comments WHERE comment_status='Approved'";
$dr_comment_num_result = mysqli_query($connection,$dr_comment_num_query);
$dr_comment_num = mysqli_num_rows($dr_comment_num_result);

?>                 
                
                
                
                
                
                
                <div class="row">
                    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'count' ],
            
            
            
<?php
$data = ['Users','All Posts','Draft Post','Approved Comments','Unapproved Comments','Categories'];
$count = [$user_num,$post_num,$dr_post_num,$ap_comment_num,$dr_comment_num,$categories_num];
for($i=0;$i<6;$i++){
    echo "['{$data[$i]}',{$count[$i]}],";
}
            
            
            
            
?>
//          ['2014', 1000]

        ]);

        var options = {
          chart: {
            title: 'Dashboard Overview'
            
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
             <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>  
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/footer.php" ?>
        
       
      
     
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9acc76676e08c2140937', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        toastr.success(data['message']);
//      alert(JSON.stringify(data['message']));
    });
  </script>