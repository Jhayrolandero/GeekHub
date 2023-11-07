$(document).ready(function(){
    
// Render contents to the home
    $.get("app/controller/UserController.php?action=getID", function(data, status){
        $("#profile-preview").html(data);
    });
    
   window.onhashchange = function () {
    if (window.location.hash === "#profile") {
        $.get("app/controller/UserController.php?action=getProfile&userProfile=you", 
        function(data, status){
            if(status === "success") {
                $('#content').html(data);
            } else {
                alert("Error! try again");
            }
        });    }
};
});

