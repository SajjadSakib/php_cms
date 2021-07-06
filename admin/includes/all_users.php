<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
                        <h1 class="page-header">
                            All Users
                        </h1>
                   
                   <?php include "delete_modal.php" ?>        

                    <table class="table table-bordered table-hover">
                            <thead>
                               <tr>
                                
                                <th>Id</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Make Admin</th>
                                <th>Make Subscriber</th>
                                <th>Edit</th>                                
                                <th>Delete</th>
                                 
                               </tr>
                                
                            </thead>
                            <tbody>
<?php  //SHOWING ALL POSTS
$all_user_query = "SELECT * FROM users";
$result_user = mysqli_query($connection,$all_user_query);
while( $row = mysqli_fetch_assoc($result_user)){
$user_id = $row['user_id'] ;
$username = $row['username'] ;
$user_firstname = $row['user_firstname'] ;
$user_lastname = $row['user_lastname'] ;
$user_email = $row['user_email'] ;
$user_role = $row['user_role'] ;

?>

                               <tr>
                                <td><?php echo $user_id ?></td>
                                <td><?php echo $username ?></td>
                                <td><?php echo $user_firstname ?></td>
                                <td><?php echo $user_lastname ?></td>
                                <td><?php echo $user_email ?></td>
                                <td><?php echo $user_role ?></td>
                                <td><?php echo "<a href='users.php?change_to_admin=$user_id' >Admin </a>"?></td>
                                <td><?php echo "<a href='users.php?change_to_subscriber=$user_id' >Subscriber </a>"?></td>
                                <td><?php echo "<a href='users.php?source=edit_user&u_id=$user_id' >Edit </a>"?></td>
                                <td><?php echo "<a class='delete_link' rel=$user_id href='javascript:void(0);'>Delete </a>"?></td>
                                </tr>
                               
                               <?php }?>
                 </tbody>
                        </table>
                        
                <script>
                $(document).ready(function(){
                $(".delete_link").click(function(){
                var user_id = $(this).attr("rel");
                var link = 'users.php?delete_user=' + user_id;
                $("#modal_delete_button").attr("href",link);
                $("#delete_modal").modal('show');
                 
                
                })
                    
                });
                

                </script>       