<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("button").click(function() {
                var action = $(this).data("action");
                $.get("app/controller/FriendController.php?action=" + action, function(data) {
                    $("#post-container").html(data);
                });
            });


            

            $("#post-container").on("click", ".suggestion-card .profile-btn", function (event) {
                event.preventDefault();

                var user_id = $(this).closest(".suggestion-card").find(".user_id").val();

                alert(user_id);
            })

            $(".click").click(function(){
                $.get("app/controller/FriendController.php?action=pending", function(data) {
                    $("#post-container").html(data);
                });
            });


            $("#post-container").on("click", ".suggestion-card .accept-btn", function () {

            var friend_ID = $(this).closest(".suggestion-card").find(".friend_id").val();
            var user_ID = $(this).closest(".suggestion-card").find(".user_id").val();

            $.post("app/controller/FriendController.php",
            {
                action: "acceptFriend",
                userID: user_ID,
                friendID: friend_ID
            }, function(data, status){
                if (status === "success") {
                    alert(data);
                } else {
                    alert("Error! Try again");
                }         
            });

            });
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container"></div>

    <button data-action="suggestion">Suggestion</button>
    <button data-action="pending">Pending</button>
    <button data-action="list">List</button>

    <div class="container-fluid">
        <div class="row" id="post-container">
        </div>
    </div>

    <button class="click">Hello</button>

    <div id="content"></div>
    --------------------
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>