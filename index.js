$(document).ready(function(){

 function loadPage(pageName) {
            var url = "app/view/"
                $('#content').load(url + pageName +  '.php');
            }
            // Initial route
            var initialRoute = window.location.hash.substring(1) || 'home';
            loadPage(initialRoute);

            // Listen for changes in the URL hash
            $(window).on('hashchange', function () {
                var route = window.location.hash.substring(1);
                loadPage(route);
            });











    // $.get("app/controller/AuthController.php?action=login", function(data, status){


    //     // if(data === "login"){
    //     //     alert("Successfully Login");
    //     //     return;
    //     // }

    //     if (status === "success") {
    //         try {
    //             var response = JSON.parse(data);

    //             if (response && response.url) {
    //                 window.location.href = response.url; // Redirect to the register page
    //             } else {
    //                 alert("Error occurred: Invalid response from the server.");
    //             }
    //         } catch (error) {
    //             alert("Error occurred: " + error);
    //         }
    //     } else {
    //         alert("Error occurred: Unable to fetch data from the server.");
    //     }
    // });
});

