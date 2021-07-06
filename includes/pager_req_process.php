<?php
if(!defined("RUNNING_SCRIPT") || PASSWORD!=="Sajjad23" ){
    die("Access Denied");
}
?>
<?php
$post_perpage = 4;
$page_num = ceil($post_count/$post_perpage);
if(isset($_GET['page_num'])){
    if(empty($_GET['page_num'])){
        $current_page = 1; 
    }elseif($_GET['page_num'] > $page_num || $_GET['page_num'] < 1){
        echo "<h1>PAGE IS NOT AVAILABLE</h1>";
        exit;
    }
    else{
        $current_page = $_GET['page_num'];
    }

}else{
    $current_page = 1;
}
$start_limit=$current_page*$post_perpage - $post_perpage;
?>