$(document).ready(function () {
  // Render the suggestion page as default when clicking friend section
  $.get(
    "app/controller/FriendController.php?action=suggestion",
    function (data) {
      $("#friend-content").html(data);
    }
  );

  // Render the friend content when clicked
  $(".nav-btn").click(function () {
    var action = $(this).data("action");
    $.get(
      "app/controller/FriendController.php?action=" + action,
      function (data) {
        $("#friend-content").html(data);
      }
    );
  });

  // // See the user's profile
  // $("#friend-content").on(
  //   "click",
  //   ".suggestion-card .profile-btn",
  //   function (event) {
  //     event.preventDefault();

  //     var friend_id = $(this)
  //       .closest(".suggestion-card")
  //       .find(".friend_id")
  //       .val();

  //     $.get(
  //       `app/controller/UserController.php?action=getProfile&buddyID=${friend_id}`,
  //       function (data, status) {
  //         if (status === "success") {
  //           $("#content").html(data);
  //         } else {
  //           alert("Error! try again");
  //         }
  //       }
  //     );
  //   }
  // );

  // Send add request to the user
  $("#friend-content").on("click", ".suggestion-card .add-btn", function () {
    var friend_ID = $(this)
      .closest(".suggestion-card")
      .find(".friend_id")
      .val();
    var user_ID = $(this).closest(".suggestion-card").find(".user_id").val();

    $.post(
      "app/controller/FriendController.php",
      {
        action: "addFriend",
        userID: user_ID,
        friendID: friend_ID,
      },
      function (data, status) {
        if (status === "success") {
          $.get(
            "app/controller/FriendController.php?action=suggestion",
            function (data) {
              $("#friend-content").html(data);
            }
          );
        } else {
          alert("Error! Try again");
        }
      }
    );
  });

  // Send add request Notif to the user
  $("#friend-content").on("click", ".suggestion-card .add-btn", function () {
    var friend_ID = $(this)
      .closest(".suggestion-card")
      .find(".friend_id")
      .val();
    // var user_ID = $(this).closest(".suggestion-card").find(".user_id").val();

    $.post(
      "app/controller/NotificationController.php",
      {
        action: "requestNotif",
        targetID: friend_ID,
      },
      function (data, status) {
        if (status === "success") {
          $.get(
            "app/controller/FriendController.php?action=suggestion",
            function (data) {
              $("#friend-content").html(data);
            }
          );
        } else {
          alert("Error occurred! Try later again later");
        }
      }
    );
  });

  // Accept user friend request
  $("#friend-content").on("click", ".suggestion-card .accept-btn", function () {
    var friendship_ID = $(this)
      .closest(".suggestion-card")
      .find(".friendship_id")
      .val();

    $.post(
      "app/controller/FriendController.php",
      {
        action: "acceptFriend",
        friendshipID: friendship_ID,
      },
      function (data, status) {
        if (status === "success") {
          alert(data);
        } else {
          alert("Error! Try again");
        }
      }
    );
  });
});
