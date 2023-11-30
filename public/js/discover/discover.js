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

  // Create a community
  $("#create-community-btn").click(function () {
    var groupName = $("#group-name").val();
    var groupDesc = $("#group-desc").val();

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "createCommunity",
        groupName: groupName,
        groupDesc: groupDesc,
      },
      function (data, status) {
        if (status === "success") {
          alert(data);
        } else {
          alert("Error!");
        }
      }
    );
  });

  /* 
  =============
  Like System
  =============
  */

  // Like
  $("#discover-post").on("click", ".like-btn", function () {
    var groupPostID = $(this)
      .closest(".community-post-card")
      .find(".community-post-id")
      .val();

    var userID = $(this).closest(".community-post-card").find(".user-id").val();

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "likeCommmunityPost",
        groupPostID: groupPostID,
        userID: userID,
      },
      function (data, status) {
        if (status === "success") {
          render_dicover_page();
        } else {
          alert("Error!");
        }
      }
    );
  });

  // Unlike
  $("#discover-post").on("click", ".unlike-btn", function () {
    var groupPostID = $(this)
      .closest(".community-post-card")
      .find(".community-post-id")
      .val();
    var userID = $(this).closest(".community-post-card").find(".user-id").val();
    var communityID = $(this)
      .closest(".community-post-card")
      .find(".community-id")
      .val();

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "unlikeCommmunityPost",
        groupPostID: groupPostID,
        userID: userID,
      },
      function (data, status) {
        if (status === "success") {
          render_dicover_page();
        } else {
          alert("Error!");
        }
      }
    );
  });

  /*
  ====================
  COMMENT
  ====================
  */

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

  $(".add-community-comment-btn").click(function () {
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
          render_dicover_page();
        } else {
          alert("Error! Try again");
        }
      }
    );
  });

  /*
  ================
    POST SYSTEM
  ================
  */

  // Delete Post
  $("#discover-post").on(
    "click",
    ".community-post-menu-delete",
    function (event) {
      event.preventDefault();

      var groupPostID = $(this)
        .closest(".community-post-card")
        .find(".community-post-id")
        .val();

      // alert(groupPostID);
      $.post(
        "app/controller/CommunityController.php",
        {
          action: "deleteCommunityPost",
          groupPostID: groupPostID,
        },
        function (data, status) {
          if (status === "success") {
            alert(data);
            var communityID = get_hash_community_id();

            renderCommunityTimeline(communityID);
            render_communtiy_stat(communityID);
          } else {
            alert("Error");
          }
        }
      );
    }
  );

  // Open Update Post
  $("#discover-post").on(
    "click",
    ".community-post-menu-update",
    function (event) {
      event.preventDefault();

      var groupPostID = $(this)
        .closest(".community-post-card")
        .find(".community-post-id")
        .val();

      var pervContent = $(this)
        .closest(".community-post-card")
        .find(".post-content")
        .text()
        .trim();

      $("#update-community-post-id").val(groupPostID);
      $("#update-community-post-form").val(pervContent);

      // alert(groupPostID);
      // alert(pervContent);

      $(".update-community-post-modal").slideDown();
    }
  );

  // Close update
  $("#close-update-community-post").click(function () {
    $(".update-community-post-modal").slideUp();
  });

  // Update post
  $("#update-community-post-btn").click(function () {
    var content = $("#update-community-post-form").val();
    var groupPostID = $("#update-community-post-id").val();

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "updateCommunityPost",
        content: content,
        groupPostID: groupPostID,
      },
      function (data, status) {
        if (status === "success") {
          var groupID = get_hash_community_id();

          renderCommunityTimeline(groupID);
          render_communtiy_stat(groupID);
          // alert(data);
        } else {
          alert("Error!");
        }
      }
    );
  });

  /*
  =================
  Create Community
  ================
  */

  // Open community Modal
  $("#community-btn").click(function (e) {
    e.preventDefault();

    $(".create-community-modal").slideDown();
  });

  // Close community post modal
  $("#close-create-community").click(function () {
    $(".create-community-modal").slideUp();
  });
});
