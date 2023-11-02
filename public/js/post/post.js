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


    $.get("app/controller/PostController.php?action=getPost", function(data, status){
        if(status === "success") {
            try{
                $(".post-container").html(data);
            } catch(error) {
                alert(error);
            }
        }
    });

    // Like system

    // Like the post send post to the php controller
    $(".post-container").on("click", ".post .like-btn", function (event) {
        event.preventDefault();

        var post_id = $(this).closest(".post").find(".post_id").val();
        var user_id = $(this).closest(".post").find(".user_id").val();
        
        $.post("app/controller/LikeController.php",
        {
            action : "like",
            post_id : post_id,
            user_id : user_id
        }, function(data, status){
            if(status === "success"){
                // Dynamically update the content
                $.get("app/controller/PostController.php?action=getPost", function (data, status) {
                    $(".post-container").html(data);
                });
            } else {
                alert("Error occurred! Try later again later");
            }
        });

        
    });
    
    // Unlike the post send get as an alternative for update API to the php controller
    $(".post-container").on("click", ".post .unlike-btn", function (event) {
        event.preventDefault();

        var post_id = $(this).closest(".post").find(".post_id").val();
        var user_id = $(this).closest(".post").find(".user_id").val();

        $.get(`app/controller/LikeController.php?action=unlike&post_id=${post_id}&user_id=${user_id}`,
        function(data, status){
        if(status === "success") {
            // Dynamically update the content
            $.get("app/controller/PostController.php?action=getPost", function (data, status) {
                $(".post-container").html(data);
            });
        } else {
                alert("Error occurred! Try later again later");
        }
        });
    });
});