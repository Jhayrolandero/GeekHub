$(document).ready(function(){
    // $(".login").click(function(){
    //     $.get("/socmed/app/controller/AuthController.php?action=login", function(data, status){
    //         if (status === "success") {
    //             try {
    //                 var response = JSON.parse(data);

    //                 if (response && response.url) {
    //                     window.location.href = response.url; // Redirect to the register page
    //                 } else {
    //                     alert("Error occurred: Invalid response from the server.");
    //                 }
    //             } catch (error) {
    //                 alert("Error occurred: " + error);
    //             }
    //         } else {
    //             alert("Error occurred: Unable to fetch data from the server.");
    //         }
    //     });
    // });


    $("#register").click(function(event){
        event.preventDefault(); // Prevent the default form submission
        
        var username = $("#username").val()
        var email = $("#r-email").val();
        var password = $("#r-password").val();
        $.post("/socmed/app/controller/AuthController.php",
        {
            request: "register",
            username: username,
            email: email,
            password: password
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    });
});

