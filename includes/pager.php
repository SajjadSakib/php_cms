<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
$page_name = basename($_SERVER['PHP_SELF']);
if(isset($_GET['cat_id'])){
    $first_query = "cat_id=" . $_GET['cat_id'] . "&";
}elseif(isset($_GET['search_text'])){
    $first_query = "search_text=" . $_GET['search_text'] . "&";
}else{
    $first_query ="";
}



?>


<ul class="pager">
<?php
if($current_page > 1){
    $previous_page = $current_page - 1;
    echo "<li class='previous'>
            <a href='$page_name?{$first_query}page_num=$previous_page'>&larr; Newer</a>
        </li>";
}
for($i=1;$i<=$page_num;$i++){
  if($i == $current_page) { 
?>


<li >
    <a class="active_link" href="<?php echo $page_name . '?' . $first_query ?>page_num=<?php echo $i ?>"><?php echo $i ?></a>
</li>
<?php }else{ ?>
<li>
    <a href="<?php echo $page_name . '?' . $first_query ?>page_num=<?php echo $i ?>"><?php echo $i ?></a>
</li>  
<?php  }}
if($current_page < $page_num ){
    
    $next_page = $current_page + 1;
    echo "<li class='next'>
            <a href='$page_name?{$first_query}page_num=$next_page'> Older &rarr;</a>
        </li>";
}
?>
</ul>