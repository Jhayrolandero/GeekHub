$(document).ready(function(){
    $.get("app/controller/UserController.php?action=getID", function(data, status){
        $("#profile-preview").html(data);
    });
});