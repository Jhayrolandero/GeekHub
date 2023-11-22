$(document).ready(function () {
  // Render contents to the home
  // $.get(
  //   "app/controller/UserController.php?action=getID",
  //   function (data, status) {
  //     $("#profile-preview").html(data);
  //   }
  // );
  // window.onhashchange = function () {
  //   if (window.location.hash === "#profile") {
  //     $.get(
  //       "app/controller/UserController.php?action=getProfile&userProfile=you",
  //       function (data, status) {
  //         if (status === "success") {
  //           $("#content").html(data);
  //         } else {
  //           alert("Error! try again");
  //         }
  //       }
  //     );
  //   }
  // };
  $(".dropbtn").click(function (e) {
    e.preventDefault();
    $("#myDropdown").toggle();
  });

  // Render the Friend sidebar
  $.get("app/controller/FriendController.php?action=homeList", function (data) {
    $("#friend-side-nav").html(data);
  });

  // Open community Modal
  $("#community-btn").click(function (e) {
    e.preventDefault();

    $(".create-community-modal").slideDown();
  });

  // Close community post modal
  $("#close-create-community").click(function () {
    $(".create-community-modal").slideUp();
  });

  // Rendercommunity Nav
  $.get(
    "app/controller/CommunityController.php",
    {
      action: "showCommunityNav",
    },
    function (data, status) {
      if (status === "success") {
        $("#community-side-nav").html(data);
      }
    }
  );
});
