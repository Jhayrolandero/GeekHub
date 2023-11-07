<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {


            // Render the contents
            $.get("app/controller/PostController.php?action=getPost", function (data, status) {
                $(".container").html(data);
            });

            // Like system

            // Like the post send post to the php controller
            $(".container").on("click", ".post .like-btn", function (event) {
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
                            $(".container").html(data);
                        });
                    } else {
                        alert("Error occurred! Try later again later");
                    }
                });

                
            });
            
            // Unlike the post send get as an alternative for update API to the php controller
            $(".container").on("click", ".post .unlike-btn", function (event) {
                event.preventDefault();

                var post_id = $(this).closest(".post").find(".post_id").val();
                var user_id = $(this).closest(".post").find(".user_id").val();

               $.get(`app/controller/LikeController.php?action=unlike&post_id=${post_id}&user_id=${user_id}`,
               function(data, status){
                if(status === "success") {
                    // Dynamically update the content
                    $.get("app/controller/PostController.php?action=getPost", function (data, status) {
                        $(".container").html(data);
                    });
                } else {
                        alert("Error occurred! Try later again later");
                }
                });
            });

            
        });

    </script>
</head>

<body>

    <div class="container">
       
    </div>

    
</body>

</html>