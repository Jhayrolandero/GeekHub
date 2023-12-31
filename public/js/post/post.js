$(document).ready(function () {
  $(".image-modal").hide();

  // Render the newsfeed

  function render_newsfeed() {
    $.get(
      "app/controller/PostController.php?action=getPost",
      async (data, status) => {
        if (status === "success") {
          try {
            $(".post-container").html(data);
            render_recommend();
          } catch (error) {
            alert(error);
          }
        } else {
          alert(`Error: ${status}`);
        }
      }
    );
  }

  function render_recommend() {
    $.get(
      "app/controller/FriendController.php?action=getRecommend",
      (data, status) => {
        if (status === "success") {
          try {
            $(".recommend-div").html(data);
          } catch (error) {
            alert("Error in rendering recommendations: " + error);
          }
        } else {
          alert(`Error: ${status}`);
        }
      }
    );
  }

  render_newsfeed();

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

  /*
  =====================
      POST SYSTEM
  =====================
  */

  // Make a post
  $("#post-btn").click(function (event) {
    event.preventDefault(); // Prevent the default form submission
    var content = $("#post-form").val();
    var userID = $("#user-id-post").val();

    // Create a FormData object
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
          render_newsfeed();
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
  $(".post-container").on("click", ".post .post-menu-update", function (event) {
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
  });

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

          render_newsfeed();
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
  $(".post-container").on("click", ".post .post-menu-delete", function (event) {
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
          render_newsfeed();
        } else {
          alert("Error");
        }
      }
    );
  });

  // Close post modal
  $("#close-update-post").click(function () {
    $(".update-post-modal").slideUp();
  });

  // Like system

  // Like the post send post to the php controller
  $(".post-container").on("click", ".post .like-btn", function (event) {
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
          render_newsfeed();
        } else {
          alert("Error occurred! Try later again later");
        }
      }
    );
  });

  // Send Notif
  $(".post-container").on("click", ".post .like-btn", function (event) {
    event.preventDefault();

    var postID = $(this).closest(".post").find(".post_id").val();
    var targetID = $(this).closest(".post").find(".creator_id").val();

    $.post(
      "app/controller/NotificationController.php",
      {
        action: "likeNotif",
        postID: postID,
        targetID: targetID,
      },
      function (data, status) {
        if (status === "success") {
        } else {
          alert("Error occurred! Try later again later");
        }
      }
    );
  });

  // Unlike the post send get as an alternative for update API to the php controller
  $(".post-container").on("click", ".post .unlike-btn", function (event) {
    event.preventDefault();

    var post_id = $(this).closest(".post").find(".post_id").val();
    var user_id = $(this).closest(".post").find(".user_id").val();

    $.get(
      `app/controller/LikeController.php?action=unlike&post_id=${post_id}&user_id=${user_id}`,
      function (data, status) {
        if (status === "success") {
          render_newsfeed();
        } else {
          alert("Error occurred! Try later again later");
        }
      }
    );
  });

  // Image preview
  $(".post-container").on("click", ".post .image-container", function () {
    var imageSrc = $(this).attr("src");
    $(".image-modal .modal-content").attr("src", imageSrc);
    $(".image-modal").show();
  });

  // hide image preview
  $(".close-button").click(function () {
    $(".image-modal").fadeOut();
  });

  // Hide post
  $(".post-container").on("click", ".post .hide-post", function () {
    $(this).closest(".post").slideUp();
  });
});
