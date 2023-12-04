$(document).ready(function () {
  /*
  ================
  AJAX
  ================
  */
  // Function to load a page based on the hash

  function get_hash_community_id() {
    var hash = window.location.hash.substring(1);
    var hashParts = hash.split("#");

    return hashParts[1];
  }
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
          render_communtiy_stat(communityID);
          render_top_members(communityID);
          render_community_nav();
        }
      }
    );
  }

  function render_community_nav() {
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

  function render_top_members(communityID) {
    $.get(
      "app/controller/CommunityController.php",
      {
        action: "getTopMembers",
        groupID: communityID,
      },
      function (data, status) {
        if (status === "success") {
          $("#community-top-members").html(data);
        } else {
          $("#community-top-members").html("<p>Error!</p>");
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

  function render_communtiy_stat(communityID) {
    $.get(
      "app/controller/CommunityController.php",
      {
        action: "getCommunityStat",
        groupID: communityID,
      },
      function (data, status) {
        if (status === "success") {
          var memberCount = data.member_count;
          var postCount = data.post_count;
          var likeCount = data.like_count;

          $("#member-count").text(memberCount);
          $("#post-count").text(postCount);
          $("#like-count").text(likeCount);
        } else {
          alert("error");
        }
      }
    );
  }

  /*
  ================
      COMMUNITY
  ================
  */

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

  // Delete COmmunity

  $(".delete-community").click(function () {
    var userID = $("#user-profile-id").val();
    var communityID = $("#community-id").val();

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "deleteCommunity",
        userID: userID,
        groupID: communityID,
      },
      function (data, status) {
        if (status === "success") {
          alert(data);
        } else {
          alert("Error");
        }
      }
    );
  });

  // Updating COmmunity profile
  $("#community-container").on("click", ".edit-community-btn", function () {
    var communityName = $("#community-name").text();
    var communityDesc = $("#bio-form").text().trim();

    var imgSrc = profileImageSrc;
    var bgSrc = profileBGSrc;

    $("#community-name-input").val(communityName);
    $("#community-desc-input").val(communityDesc);
    $("#prev-community-icon").attr("src", imgSrc);
    $("#prev-community-bg").attr("src", bgSrc);
    $(".update-community-modal").slideDown();
  });

  // Close
  $("#close-update-community").click(function () {
    $(".update-community-modal").slideUp();
  });

  // Update Community
  $("#update-community-btn").click(function (event) {
    event.preventDefault(); // Prevent the default form submission

    // alert("Hello");
    var communityName = $("#community-name-input").val();
    var communityID = $("#community-id").val();
    var communityDesc = $("#community-desc-input").val();

    // Create a FormData object
    var formData = new FormData();

    // Append the content and image to the FormData
    formData.append("action", "updateCommunity");
    formData.append("communityName", communityName);
    formData.append("communityID", communityID);
    formData.append("communityPic", $("#community-pic-input")[0].files[0]);
    formData.append("communityBG", $("#community-bg-input")[0].files[0]);
    formData.append("communityDesc", communityDesc);

    $.ajax({
      type: "POST",
      url: "app/controller/CommunityController.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data, status) {
        if (status === "success") {
          alert(data);

          render_community(communityID);
          $(".update-community-modal").slideUp();
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

  /*
======================
        POSTING
======================
*/

  // Function for validating Picture
  function validateIMGType(fileID) {
    // Get the file input element
    var fileInput = document.getElementById(fileID);

    // Get the selected file
    var file = fileInput.files[0];

    // Check if a file is selected
    if (file) {
      // Get the file extension
      var extension = file.name.split(".").pop().toLowerCase();

      // Array of allowed image file extensions
      var allowedExtensions = ["jpg", "jpeg", "png", "webp"];

      // Check if the file extension is in the allowed extensions array
      if (allowedExtensions.indexOf(extension) === -1) {
        fileInput.value = "";

        return false;
      } else {
        return true;
      }
    }
    return true;
  }

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

        alert(data);

        renderCommunityTimeline(communityID);
        render_communtiy_stat(communityID);
        render_top_members(communityID);
      },
      error: function () {
        alert("Error");
      },
    });
  });

  // Delete Post
  $("#community-container").on(
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
            render_top_members(communityID);
          } else {
            alert("Error");
          }
        }
      );
    }
  );

  // Open Update Post
  $("#community-container").on(
    "click",
    ".community-post-menu-update",
    function (event) {
      event.preventDefault();
      var groupPostID = $(this)
        .closest(".community-post-card")
        .find(".community-post-id")
        .val();

      var prevContent = $(this)
        .closest(".community-post-card")
        .find(".post-content")
        .text()
        .trim();

      $("#update-community-post-id").val(groupPostID);
      $("#update-community-post-form").val(prevContent);
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
          render_communtiy_stat(communityID);
          // render_community_nav();
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
          render_communtiy_stat(communityID);
          // render_community_nav();
          // loadPageFromHash();
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

  // Close comment modal
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
          renderCommunityTimeline(groupID);
        } else {
          alert("Error! Try again");
        }
      }
    );
  });

  // Delete Comment
  $(".community-comment-modal").on(
    "click",
    ".comment-card .comment-menu-delete",
    function () {
      var commentID = $(this)
        .closest(".comment-card")
        .find(".comment-id")
        .val();
      var groupPostID = $(this)
        .closest(".comment-card")
        .find(".comment-post-id")
        .val();
      $.post(
        "app/controller/CommunityController.php",
        {
          action: "deleteCommentCommunity",
          commentID: commentID,
        },
        function (data, status) {
          if (status === "success") {
            // Render the new comment list
            renderComment(groupPostID);
            // Render the timeline
            var communityID = get_hash_community_id();
            renderCommunityTimeline(communityID);
          } else {
            alert("Error!");
          }
        }
      );
    }
  );
});
