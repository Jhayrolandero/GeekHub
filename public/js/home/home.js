$(document).ready(function(){
    
    // Use to get the user's data
    $.get("app/controller/UserController.php?action=getID", function(data, status){
        $("#profile-preview").html(data);
    });
    
    // $.get("app/view/modelPost.php", function(data, status){
    //     $("#model-content-container").html(data);
    // });
    


});