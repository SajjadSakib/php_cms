$(document).ready(function(){
   ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.log( error );
        } ); 
    //
    $("#all_boxes").click(function(){
    if(this.checked){
       $(".checkbox").each(function(){
           this.checked = true;
       })
  
    }else{
       $(".checkbox").each(function(){
           this.checked = false;
       })
    }});
 
})

var loadOnlineUsers=()=>{  
$.get("includes/active_user.php?online_user=result", function(data){
$(".useronline").text(data);
})
}

window.setInterval(function(){
loadOnlineUsers() 
},1000);

