$(document).ready(function(){
    $(".register").click(function(){
        $.get("/socmed/app/controller/AuthController.php?action=register", function(data, status){
            if (status === "success") {
                try {
                    var response = JSON.parse(data);

                    if (response && response.url) {
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
        });
    });

    $("#login").click(function(event){
        event.preventDefault(); // Prevent the default form submission
        
        var email = $("#email").val();
        var password = $("#password").val();
        $.post("/socmed/app/controller/AuthController.php",
        {
            request: "login",
            email: email,
            password: password

        },function(data, status){
            if (status === "success") {
                try {
                    var response = JSON.parse(data);

                    if (response && response.url) {
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
        });
    });
});

