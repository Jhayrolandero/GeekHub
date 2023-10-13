$(document).ready(function(){
    $("#post-btn").click(function(event){
        event.preventDefault(); // Prevent the default form submission
        
        var content = $("#post-form").val();
        $.post("app/controller/PostController.php",
        {
            action: "addPost",
            content: content
        },function(data, success){
            alert(data);
        });
    });
});