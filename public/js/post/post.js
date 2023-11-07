$(document).ready(function(){
    $(".image-modal").hide();

    // Make a post
    $("#post-btn").click(function(event){
        event.preventDefault(); // Prevent the default form submission
        var content = $("#post-form").val();
        // Create a FormData object
        var formData = new FormData();

        // Append the content and image to the FormData
        formData.append("action", "addPost");
        formData.append("content", content);
        formData.append("image", $("#image-input")[0].files[0]);

        $.ajax({
            type: "POST",
            url: "app/controller/PostController.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data, status) {
                alert(data);
                if (status === "success") {
                    if (data == 0) {
                        alert("No Empty Homie!");
                    }

                    $.get("app/controller/PostController.php?action=getPost", function (data, status) {
                        $(".post-container").html(data);
                    });
                } else {
                    alert("Error occurred! Try again later.");
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert("An error occurred while sending the data.");
            },
        });
        
    });


    // Render the newsfeed
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

    // Image preview
    $(".post-container").on("click", ".post .image-container", function () {
        var imageSrc = $(this).attr("src");
        $(".image-modal .modal-content").attr("src", imageSrc);
        $(".image-modal").show();

    });
    
    $(".close-button").click(function() {
        $(".image-modal").hide();
    });
    
    $(".post-container").on("click", ".post .hide-post", function () {
        $(this).closest(".post").hide();
    });
   
});