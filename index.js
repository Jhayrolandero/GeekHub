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

});

