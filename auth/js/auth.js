// AJAX requests

$(document).ready(function () {
  $("#login").click(function (event) {
    event.preventDefault(); // Prevent the default form submission

    var email = $("#email").val();
    var password = $("#password").val();
    $.post(
      "/socmed/app/controller/AuthController.php",
      {
        request: "login",
        email: email,
        password: password,
      },
      function (data, status) {
        if (status === "success") {
          try {
            var response = JSON.parse(data);

            if (response && response.url === "empty") {
              alert("Empty Fields!");
            } else if (response && response.url === "notFound") {
              alert("User doesn't exist!");
            } else if (response && response.url) {
              window.location.href = response.url; // Redirect to the register page
            } else {
              alert("Error occurred: Invalid response from the server.");
            }
          } catch (error) {
            alert("Error occurred: " + error);
          }
        } else {
          alert("Error occurred: Unable to fetch data from the server.");
        }
      }
    );
  });

  $("#register").click(function (event) {
    event.preventDefault(); // Prevent the default form submission

    var username = $("#username").val();
    var email = $("#r-email").val();
    var password = $("#r-password").val();

    $.post(
      "/socmed/app/controller/AuthController.php",
      {
        request: "register",
        username: username,
        email: email,
        password: password,
      },
      function (data, status) {
        if (status === "success") {
          alert(data);
        } else {
          alert("Error occurred: Unable to fetch data from the server.");
        }
      }
    );
  });
});

// Scroll Nav
function scrollToSection(sectionId) {
  const section = document.getElementById(sectionId);
  section.scrollIntoView({
    behavior: "smooth",
  });
}
