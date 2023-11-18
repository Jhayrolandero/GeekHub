$(document).ready(function () {
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
        }
      }
    );
  }

  // Open COmmunity Post modal
  $("#community-container").on("click", "#create-community-post", function () {
    $(".create-community-post-modal").slideDown();
  });

  // Close community modal
  $("#close-create-community-post").click(function () {
    $(".create-community-post-modal").slideUp();
  });

  $("#post-btn").click(function (event) {
    event.preventDefault(); // Prevent the default form submission

    var content = $("#post-form").val();
    var communityID = $(".community-id").val();
    var userID = $(".user-id").val();

    alert(content);
    alert(communityID);
    alert(userID);

    $.post(
      "app/controller/CommunityController.php",
      {
        action: "createPostCommunity",
        content: content,
        communityID: communityID,
        userID: userID,
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
});
