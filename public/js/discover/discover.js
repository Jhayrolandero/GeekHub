$(document).ready(function () {
  render_dicover_page();

  function render_dicover_page() {
    $.get(
      "app/controller/CommunityController.php",
      {
        action: "getCommunityPost",
        groupID: null,
      },
      function (data, status) {
        if (status === "success") {
          $("#discover-post").html(data);
        }
      }
    );

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
  }

  function renderComment(groupPostID) {
    $.get(
      "app/controller/CommunityController.php",
      {
        action: "showCommunityComment",
        groupPostID: groupPostID,
      },
      function (data, status) {
        if (status === "success") {
          $("#comment-list").html(data);
        }
      }
    );
  }

  /*
  ===============
      Comment
  ===============
  */
  // Open Comment
  $("#discover-post").on("click", ".comment-btn", function () {
    $(".community-comment-modal").slideDown();

    var groupPostID = $(this)
      .closest(".community-post-card")
      .find(".community-post-id")
      .val();

    var targetID = $(this)
      .closest(".community-post-card")
      .find(".creator_id")
      .val();

    var groupID = $(this)
      .closest(".community-post-card")
      .find(".community-id")
      .val();

    $(".comment-post-id").val(groupPostID);
    $(".comment-target-id").val(targetID);
    $(".comment-community-id").val(groupID);

    renderComment(groupPostID);
  });

  // CLose comment modal
  $(".close-btn").click(function () {
    $(".community-comment-modal").slideUp();
  });

  // Comment

  $("#add-comment-btn").click(function () {
    var comment = $(".comment-input").val();
    var groupPostID = $(".comment-post-id").val();
    var userID = $(".comment-user-id").val();
    var groupID = $(".comment-community-id").val();

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "addCommentCommmunityPost",
        comment: comment,
        groupPostID: groupPostID,
        userID: userID,
      },
      function (data, status) {
        if (status === "success") {
          // Update contents dynamically
          renderComment(groupPostID);
          renderCommunityTimeline(groupID);
        } else {
          alert("Error! Try again");
        }
      }
    );
  });
});
