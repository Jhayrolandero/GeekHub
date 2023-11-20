$(document).ready(function () {
  /*
  ================
  AJAX
  ================
  */
  // Function to load a page based on the hash
  function loadPageFromHash() {
    var hash = window.location.hash.substring(1);
    var hashParts = hash.split("#");

    var route = hashParts[0];

    if (route === "group") {
      var id = hashParts[1];
      render_community(id);
    }
  }

  // Initial load
  loadPageFromHash();
  // Listen for URL changes
  $(window).on("hashchange", function () {
    loadPageFromHash();
  });

  function render_community(communityID) {
    // Getting Community info
    $.get(
      "app/controller/CommunityController.php",
      {
        action: "showCommunity",
        communityID: communityID,
      },
      function (data, status) {
        if (status === "success") {
          $("#community-container").html(data);

          $(".community-id").val(communityID);

          renderCommunityTimeline(communityID);
        }
      }
    );
  }

  function renderCommunityTimeline(communityID) {
    // Getting Community posts
    $.get(
      "app/controller/CommunityController.php",
      {
        action: "getCommunityPost",
        groupID: communityID,
      },
      function (data, status) {
        if (status === "success") {
          $(".community-content-section").html(data);
        }
      }
    );
  }

  /*
  ================
  COMMUNITY
  ================
  */

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

  // Join community
  $("#community-container").on("click", ".join-community-btn", function () {
    var communityID = $(".community-id").val();
    var userID = $(".user-id").val();

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "joinCommunity",
        userID: userID,
        groupID: communityID,
        role: "member",
      },
      function (data, status) {
        if (status === "success") {
          alert(data);
          render_community(communityID);
        }
      }
    );
  });

  // leave Community
  $("#community-container").on("click", ".leave-community-btn", function () {
    var communityID = $(".community-id").val();
    var userID = $(".user-id").val();

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "leaveCommunity",
        userID: userID,
        groupID: communityID,
      },
      function (data, status) {
        if (status === "success") {
          alert(data);
          render_community(communityID);
        }
      }
    );
  });

  /*
======================
        POSTING
======================
*/

  // Open COmmunity Post modal
  $("#community-container").on("click", "#create-community-post", function () {
    $(".create-community-post-modal").slideDown();
  });

  // Close community modal
  $("#close-create-community-post").click(function () {
    $(".create-community-post-modal").slideUp();
  });

  // Create Post
  $("#post-btn").click(function (event) {
    event.preventDefault(); // Prevent the default form submission

    var content = $("#post-form").val();
    var communityID = $(".community-id").val();
    var userID = $(".user-id").val();

    var formData = new FormData();
    formData.append("action", "createPostCommunity");
    formData.append("content", content);
    formData.append("communityID", communityID);
    formData.append("userID", userID);
    formData.append("image", $("#image-input")[0].files[0]);

    $.ajax({
      url: "app/controller/CommunityController.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data == 0) {
          alert("No Empty Homie!");
        }
        render_community(communityID);
      },
      error: function () {
        alert("Error");
      },
    });
  });

  /* 
  =============
  
  Like System

  =============
  */

  // Like
  $("#community-container").on("click", ".like-btn", function () {
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
        action: "likeCommmunityPost",
        groupPostID: groupPostID,
        userID: userID,
      },
      function (data, status) {
        if (status === "success") {
          renderCommunityTimeline(communityID);
        } else {
          alert("Error!");
        }
      }
    );
  });

  // Unlike
  $("#community-container").on("click", ".unlike-btn", function () {
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
          renderCommunityTimeline(communityID);
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
  $("#community-container").on("click", ".comment-btn", function () {
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
