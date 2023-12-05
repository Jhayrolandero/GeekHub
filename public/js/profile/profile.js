$(document).ready(function () {
  // Function to load a page based on the hash

  function get_hash_id() {
    var hash = window.location.hash.substring(1);
    var hashParts = hash.split("#");

    return hashParts[1];
  }
  function loadPageFromHash() {
    var hash = window.location.hash.substring(1);
    var hashParts = hash.split("#");
    var route = hashParts[0];

    if (route === "profile") {
      var id = hashParts[1];
      render_user_profile(id);
    }
  }

  // Initial load
  loadPageFromHash();

  // Listen for URL changes
  $(window).on("hashchange", function () {
    loadPageFromHash();
  });

  function render_user_profile(userID) {
    // Getting user info
    $.get(
      `app/controller/UserController.php?action=getProfile&userProfile=${userID}`,
      function (data, status) {
        if (status === "success") {
          $("#profile-container").html(data);

          render_timeline(userID);
          render_stat(userID);
          render_community_nav(userID);
        } else {
          alert("Error! try again");
        }
      }
    );
  }

  function render_timeline(userID) {
    $.get(
      `app/controller/PostController.php?action=getPost&profileID=${userID}`,
      function (data, status) {
        if (status === "success") {
          $(".timeline-section").html(data);
        } else {
          alert("Error! try again");
        }
      }
    );
  }

  function render_stat(userID) {
    $.get(
      "app/controller/UserController.php",
      {
        action: "getStat",
        userID: userID,
      },
      function (data, status) {
        if (status === "success") {
          var buddyCount = data.buddy_count;
          var postCount = data.post_count;
          var likeCount = data.like_count;

          $("#buddy-count").text(buddyCount);
          $("#post-count").text(postCount);
          $("#like-count").text(likeCount);
        } else {
          alert("error");
        }
      }
    );
  }

  function render_community_nav(userID) {
    $.get(
      "app/controller/CommunityController.php",
      {
        action: "showProfileCommunityNav",
        userID: userID,
      },
      function (data, status) {
        if (status === "success") {
          $("#community-side-nav").html(data);
        }
      }
    );
  }

  /*
  ================
      BIO
  ================
  */

  $("#profile-container").on("click", "#add-bio-btn", function () {
    // Now, the code will only run when the button is clicked

    // Access the bio-content inside the click event
    var userID = $("#userID").val();
    var bio = $("#bio-form").val();

    $.post(
      "app/controller/UserController.php",
      {
        action: "addBio",
        userID: userID,
        bio: bio,
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

  /*
  ==============
      Like
  ==============
  */

  // Like the post send post to the php controller
  $("#profile-container").on("click", ".post .like-btn", function (event) {
    event.preventDefault();

    var post_id = $(this).closest(".post").find(".post_id").val();
    var user_id = $(this).closest(".post").find(".user_id").val();

    $.post(
      "app/controller/LikeController.php",
      {
        action: "like",
        post_id: post_id,
        user_id: user_id,
      },
      function (data, status) {
        if (status === "success") {
          // Dynamically update the content
          var profileID = get_hash_id();

          render_timeline(profileID);
          render_stat(profileID);
        } else {
          alert("Error occurred! Try later again later");
        }
      }
    );
  });

  // Unlike the post send get as an alternative for update API to the php controller
  $("#profile-container").on("click", ".post .unlike-btn", function (event) {
    event.preventDefault();

    var post_id = $(this).closest(".post").find(".post_id").val();
    var user_id = $(this).closest(".post").find(".user_id").val();

    $.get(
      `app/controller/LikeController.php?action=unlike&post_id=${post_id}&user_id=${user_id}`,
      function (data, status) {
        if (status === "success") {
          var profileID = get_hash_id();

          render_timeline(profileID);
          render_stat(profileID);
        } else {
          alert("Error occurred! Try later again later");
        }
      }
    );
  });

  /*
  ================
        Post
  ================
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

  // Post System

  // Open Community Post modal
  $("#profile-container").on("click", "#open-post-btn", function () {
    // alert("Hello");
    $(".create-post-modal").slideDown();
  });

  $("#close-create-post").click(function () {
    // alert("Hello");
    $(".create-post-modal").slideUp();
  });

  // Make a post
  $("#post-btn").click(function (event) {
    event.preventDefault(); // Prevent the default form submission
    var content = $("#post-form").val();
    // Create a FormData object
    var userID = $("#user-id-post").val();

    var valid = validateIMGType("image-input");

    // Validate first the image
    if (!valid) {
      alert(
        "Invalid file type. Please select a valid image file (JPG, JPEG, PNG, WEBP)."
      );
      return;
    }

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
        if (status === "success") {
          if (data == 0) {
            alert("No Empty Homie!");
          }

          render_timeline(userID);
          render_stat(userID);
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

  // Update a post
  $("#profile-container").on(
    "click",
    ".post .post-menu-update",
    function (event) {
      event.preventDefault();
      var postID = $(this).closest(".post").find(".post_id").val();
      var pervContent = $(this)
        .closest(".post")
        .find(".post-content")
        .text()
        .trim();
      $("#update-post-id").val(postID);
      $("#update-post-form").val(pervContent);
      $(".update-post-modal").slideDown();
    }
  );

  $("#update-post-btn").click(function (event) {
    event.preventDefault(); // Prevent the default form submission
    var content = $("#update-post-form").val();
    var postID = $("#update-post-id").val();
    // Create a FormData object
    var formData = new FormData();

    // Append the content and image to the FormData
    formData.append("action", "updatePost");
    formData.append("content", content);
    formData.append("postID", postID);

    $.ajax({
      type: "POST",
      url: "app/controller/PostController.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data, status) {
        if (status === "success") {
          if (data == 0) {
            alert("No Empty Homie!");
          }

          var profileID = get_hash_id();

          render_timeline(profileID);
          render_stat(profileID);
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

  // Delete Post
  $("#profile-container").on(
    "click",
    ".post .post-menu-delete",
    function (event) {
      event.preventDefault();

      var postID = $(this).closest(".post").find(".post_id").val();

      $.post(
        "app/controller/PostController.php",
        {
          action: "deletePost",
          postID: postID,
        },
        function (data, status) {
          if (status === "success") {
            var profileID = get_hash_id();

            render_timeline(profileID);
            render_stat(profileID);
          } else {
            alert("Error");
          }
        }
      );
    }
  );

  // Close post modal
  $("#close-update-post").click(function () {
    $(".update-post-modal").slideUp();
  });

  /*
  ==============
      Comment
  ==============
  */

  function render_comment(postID) {
    $.get(
      `app/controller/CommentController.php?action=showComment&postID=${postID}`,
      function (data, status) {
        if (status === "success") {
          $("#comment-list").html(data);
        } else {
          alert("Error!");
        }
      }
    );
  }
  // Show comment box
  $("#profile-container").on("click", ".post .comment-btn", function () {
    var postID = $(this).closest(".post").find(".post_id").val();
    var targetID = $(this).closest(".post").find(".creator_id").val();
    $(".comment-post-id").val(postID);
    $(".comment-target-id").val(targetID);
    $(".comment-modal").slideDown();

    render_comment(postID);
  });

  // Close the comment
  $(".close-btn").click(function () {
    $(".comment-modal").slideUp();
  });

  // Post a comment
  $("#add-comment-btn").click(function () {
    var comment = $(".comment-input").val();
    var postID = $(".comment-post-id").val();
    var userID = $(".comment-user-id").val();

    $.post(
      "app/controller/CommentController.php",
      {
        action: "addComment",
        comment: comment,
        postID: postID,
        userID: userID,
      },
      function (data, status) {
        if (status === "success") {
          // Update contents dynamically
          var profileID = get_hash_id();

          render_comment(postID);
          render_timeline(profileID);
        } else {
          alert("Error! Try again");
        }
      }
    );
  });
  /*
    ================
    Profile Options
    ================
    */

  // Open profile modal
  $("#profile-container").on("click", ".edit-profile-btn", function () {
    var username = $("#profileName").text();

    var imgSrc = profileImageSrc;
    var bgSrc = profileBGSrc;

    $(".curr-profile-name").val(username);
    $("#prev-profile-icon").attr("src", imgSrc);
    $("#prev-profile-bg").attr("src", bgSrc);

    $(".update-profile-modal").slideDown();
  });

  // Close
  $("#close-update-profile").click(function () {
    $(".update-profile-modal").slideUp();
  });

  // Update Profile
  $("#update-profile-btn").click(function (event) {
    event.preventDefault(); // Prevent the default form submission
    var username = $("#username-input").val();
    var userID = $("#user-profile-id").val();

    // Create a FormData object
    var formData = new FormData();

    // Append the content and image to the FormData
    formData.append("action", "updateProfile");
    formData.append("username", username);
    formData.append("userID", userID);
    formData.append("profilePic", $("#profile-pic-input")[0].files[0]);
    formData.append("profileBG", $("#profile-bg-input")[0].files[0]);

    $.ajax({
      type: "POST",
      url: "app/controller/UserController.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data, status) {
        if (status === "success") {
          alert(data);

          render_user_profile(userID);
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
});
