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
});
