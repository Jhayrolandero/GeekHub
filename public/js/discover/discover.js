$(document).ready(function () {
  $.get(
    "app/controller/CommunityController.php",
    {
      action: "getCommunityPost",
      groupID: null,
    },
    function (data, status) {
      if (status === "success") {
        $(".discover-post").html(data);
      }
    }
  );
});
