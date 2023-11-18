// Just a router nothing special

$(document).ready(function () {
  function loadPage(pageName) {
    var url = "app/view/";
    $("#content").load(url + pageName + ".php");
  }

  get_page_to_load();

  // Listen for changes in the URL hash
  $(window).on("hashchange", function () {
    get_page_to_load();
  });

  //   Load the page needed
  function get_page_to_load() {
    var route = window.location.hash.substring(1) || "home";
    var hashParts = route.split("#");

    var profilePage = hashParts[0];

    if (profilePage === "profile") {
      loadPage(profilePage);
    } else if (profilePage === "group") {
      loadPage(profilePage);
    } else {
      loadPage(route);
    }
  }
});
