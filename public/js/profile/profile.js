$(document).ready(function () {
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

  // Function to load a page based on the hash
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
          // console.log(data);
          $("#profile-container").html(data);

          render_timeline(userID);
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
          render_timeline(user_id);
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
          render_timeline(user_id);
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

  // Post System

  // Open COmmunity Post modal

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

          $.get(
            "app/controller/PostController.php?action=getPost",
            function (data, status) {
              $(".post-container").html(data);
            }
          );
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
            $.get(
              "app/controller/PostController.php?action=getPost",
              function (data, status) {
                $(".post-container").html(data);
              }
            );
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
          render_comment(postID);
          render_timeline(userID);
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

    $(".curr-profile-name").val(username);
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
          // if (data == 0) {
          //   alert("No Empty Homie!");
          // }
          // $.get(
          //   "app/controller/PostController.php?action=getPost",
          //   function (data, status) {
          //     $(".post-container").html(data);
          //   }
          // );
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
