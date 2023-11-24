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
        } else {
          alert("Error! try again");
        }
      }
    );
  }
});
