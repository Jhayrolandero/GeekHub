$(document).ready(function () {
  // Function to render comments
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

  // Function to render post
  function render_post() {
    $.get(
      "app/controller/PostController.php?action=getPost",
      function (data, status) {
        if (status === "success") {
          $(".post-container").html(data);
        } else {
          alert("Error!");
        }
      }
    );
  }

  // Show comment box
  $(".post-container").on("click", ".post .comment-btn", function () {
    var postID = $(this).closest(".post").find(".post_id").val();
    var targetID = $(this).closest(".post").find(".creator_id").val();
    var username = $(this).closest(".post").find(".username").text();

    $(".comment-post-id").val(postID);
    $(".comment-target-id").val(targetID);
    $(".comment-title").text(username + "'s post");
    $(".comment-modal").slideDown();

    render_comment(postID);
    // $.get(
    //   `app/controller/CommentController.php?action=showComment&postID=${postID}`,
    //   function (data, status) {
    //     if (status === "success") {
    //       $("#comment-list").html(data);
    //     } else {
    //       alert("Error!");
    //     }
    //   }
    // );
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
          render_post();
          // $.get(
          //   `app/controller/CommentController.php?action=showComment&postID=${postID}`,
          //   function (data, status) {
          //     if (status === "success") {
          //       $("#comment-list").html(data);
          //     } else {
          //       alert("Error!");
          //     }
          //   }
          // );

          // $.get(
          //   "app/controller/PostController.php?action=getPost",
          //   function (data, status) {
          //     if (status === "success") {
          //       $(".post-container").html(data);
          //     } else {
          //       alert("Error!");
          //     }
          //   }
          // );
        } else {
          alert("Error! Try again");
        }
      }
    );
  });

  // Send NOtif comment
  $("#add-comment-btn").click(function () {
    var postID = $(".comment-post-id").val();
    var targetID = $(".comment-target-id").val();

    $.post(
      "app/controller/NotificationController.php",
      {
        action: "commentNotif",
        postID: postID,
        targetID: targetID,
      },
      function (data, status) {
        if (status === "success") {
          // alert(data);
          render_comment(postID);
        } else {
          alert("Error occurred! Try later again later");
        }
      }
    );
  });

  // Delete Comment
  $(".comment-modal").on(
    "click",
    ".comment-card .comment-menu-delete",
    function () {
      var commentID = $(this)
        .closest(".comment-card")
        .find(".comment-id")
        .val();
      var postID = $(this)
        .closest(".comment-card")
        .find(".comment-post-id")
        .val();

      $.post(
        "app/controller/CommentController.php",
        {
          action: "deleteComment",
          commentID: commentID,
        },
        function (data, status) {
          if (status === "success") {
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

            $.get(
              "app/controller/PostController.php?action=getPost",
              function (data, status) {
                $(".post-container").html(data);
              }
            );
          } else {
            alert("Error!");
          }
        }
      );
    }
  );

  // Render Comment contents

  // $(".post-container").on("click", ".post .comment-btn", function () {
  //   var postID = $(this).closest(".post").find(".post_id").val();
  //   var username = $(this).closest(".post").find(".username").text();

  //   $(".comment-post-id").val(postID);
  //   $(".comment-title").text(username + "'s post");
  //   $(".comment-modal").slideDown();
  // });

  // Hide comment
  $(".comment-modal").on("click", ".comment-card .hide-comment", function () {
    $(this).closest(".comment-card").slideUp();
  });
});
