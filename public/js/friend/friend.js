$(document).ready(function () {
  // Render the suggestion page as default when clicking friend section
  render_friend_page();

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

  function nav_friend_page(action) {
    $.get(
      "app/controller/FriendController.php?action=" + action,
      function (data) {
        $("#friend-content").html(data);
      }
    );
  }

  function render_friend_page() {
    $.get(
      "app/controller/FriendController.php?action=suggestion",
      function (data) {
        $("#friend-content").html(data);
      }
    );
  }

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
          nav_friend_page("suggestion");
          // render_friend_page();
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
          // nav_friend_page("list");
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
          nav_friend_page("pending");
        } else {
          alert("Error! Try again");
        }
      }
    );
  });

  // unfriend user
  $("#friend-content").on("click", ".unfriend-btn", function () {
    // alert("Unfriending");
    var friendshipID = $(this).closest(".friend-card").find(".friend_id").val();

    var userID = $(this).closest(".friend-card").find(".user_id").val();

    $.post(
      "app/controller/FriendController.php",
      {
        action: "unfriendFriend",
        friendshipID: friendshipID,
        userID: userID,
      },
      function (data, status) {
        if (status === "success") {
          // render_friend_page();
          nav_friend_page("list");
        } else {
          alert("Error! Try again");
        }
      }
    );
  });
});
