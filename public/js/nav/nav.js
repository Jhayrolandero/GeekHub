$(document).ready(function () {
  /*
  ===================
  Notification
  ===================
  */
  $.get(
    "app/controller/NotificationController.php?action=getNotif",
    function (data, status) {
      if (status === "success") {
        $(".notif-container").html(data);
      }
    }
  );

  // Listen for input changes in the search bar
  $("#searchInput").on("input", function () {
    var query = $(this).val().trim();

    // console.log(query);
    // Send an AJAX request to the server for search results
    $.get(
      "app/controller/SeachbarController.php",
      {
        action: "searchUser",
        username: query,
      },
      function (data) {
        displayResults(data);
      }
    );
  });

  // Function to display search results
  function displayResults(results) {
    var resultsContainer = $("#searchResults");
    resultsContainer.empty();

    if (results.length === 0) {
      resultsContainer.append("<p>No results found</p>");
    } else {
      resultsContainer.append("<p>" + results + "</p>");
    }
  }
});
