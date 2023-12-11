// AJAX requests

$(document).ready(function () {
  // Logging in
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

  // Creating new Account
  $(".register-form").on("click", ".enable-register-btn", function (event) {
    event.preventDefault(); // Prevent the default form submission

    var username = $("#username").val();
    var email = $("#r-email").val();
    var password = $("#r-password").val();
    var givenOTP = $("#given-otp").val();
    var OTP = $("#r-otp").val();

    $.post(
      "/socmed/app/controller/AuthController.php",
      {
        request: "register",
        username: username,
        email: email,
        password: password,
        otp: OTP,
        givenOTP: givenOTP,
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

  $("#toggle-register").click(function () {
    $(".register-modal").toggle();
  });

  $(".register-form").on("keyup", function () {
    // if ($("#username").val().length && $("#r-email").val().length && $('#r-password').val().length) {
    //   alert("Inputted")

    let usernameLen = $("#username").val().length;
    let rEmail = $("#r-email").val();
    let rPassword = $("#r-password").val().length;

    let userError = true;
    let emailError = true;
    let pwError = true;

    if (usernameLen <= 0) {
      $(".username-error").html("<p>Empty Username!</p>");
    } else {
      $(".username-error").empty();
      userError = false;
    }
    if (rEmail.length <= 0) {
      $(".email-error").html("<p>Empty email!</p>");
    } else if (!isValidEmail(rEmail)) {
      $(".email-error").html("<p>Not valid email!</p>");
    } else {
      $(".email-error").empty();
      emailError = false;
    }
    if (rPassword <= 0) {
      $(".password-error").html("<p>Empty password!</p>");
    } else if (passwordLength(rPassword)) {
      $(".password-error").html("<p>Must be 8 characters!</p>");
    } else {
      $(".password-error").empty();
      pwError = false;
    }
    console.log("Username len: " + usernameLen);
    console.log("rEmail len: " + rEmail);
    console.log("rPassword len: " + rPassword);

    if (!userError && !emailError && !pwError) {
      $(".disable-register-btn")
        .removeClass("disable-register-btn")
        .addClass("enable-register-btn");
    } else {
      $(".enable-register-btn")
        .removeClass("enable-register-btn")
        .addClass("disable-register-btn");
    }
  });

  $(".register-form").on("click", ".otp-btn", function () {
    $.post(
      "/socmed/app/controller/AuthController.php",
      {
        request: "otp",
        email: "xjaylandero",
      },
      function (data, status) {
        if (status === "success") {
          $("#given-otp").val(data);
        } else {
          alert("Error occurred: Unable to fetch data from the server.");
        }
      }
    );
  });
});

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function passwordLength(password) {
  return password < 8;
}
