<div class="searchbar-container col-8 w-75">
    <div class="searchbar-wrapper">
        <input type="text" placeholder="Search...." class="searchbar-input mb-2 w-100 p-2" id="searchInput" autocomplete="off">
        <button id="clearSearch" class="btn">X</button>
    </div>
    <div class="searchbar-content">
        <ul id="searchResults" class="nav"></ul>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#searchInput").on("input", function() {
            var query = $(this).val().trim();

            $.get(
                "app/controller/SeachbarController.php", {
                    action: "searchUser",
                    username: query,
                },
                function(data) {
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

        $("#clearSearch").click(function() {
            $("#searchInput").val("");
            $("#searchResults").empty();
        });
    });
</script>

<style>
    :root {
        --black-bg: #090909;
        --blue-color: #0ba4eb;
        --blue-border: var(--blue-color) solid 1px;
    }

    /* Style for the searchbar container */
    .searchbar-container {
        position: relative;
        display: inline-block;
    }

    .searchbar-container input {
        background: transparent;
        border: white solid 1px;
        color: white;
        border-radius: 20px;
        border: var(--blue-border);
    }

    .searchbar-container input::placeholder {
        color: white;
    }


    /* Style for the searchbar content */
    .searchbar-content {
        display: none;
        background-color: var(--black-bg);
        color: white;
        width: 100%;
        border: var(--blue-border);
        /* box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); */
        z-index: 1;
        border-radius: 20px;
    }

    .searchbar-content ul {
        list-style: none;
        padding: 0.5em;
    }

    .searchbar-content ul li {
        width: 100%;
        padding: 0.5em;
        cursor: pointer;
    }

    .searchbar-content ul li:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }

    /* Style for the searchbar items */
    .searchbar-item {
        display: block;
    }

    /* Show the searchbar content when the input is focused */
    .searchbar-container:focus-within .searchbar-content {
        display: block;
    }


    /* Define the scrollbar track */
    .searchbar-content::-webkit-scrollbar-track {
        background-color: #282828;
    }

    /* Define the scrollbar handle */
    .searchbar-content::-webkit-scrollbar-track {
        background-color: #888;
        border-radius: 3px;
    }

    /* Define the scrollbar handle on hover */
    .searchbar-content::-webkit-scrollbar-track {
        background-color: #555;
    }

    .searchbar-content {
        max-height: 40rem;
        overflow-y: auto;
    }

    .result-name {
        text-decoration: none;
        color: var(--text-color);
        list-style: none;
    }

    .nav-item a {
        text-decoration: none;
    }

    .searchbar-wrapper {
        position: relative;
    }

    #clearSearch {
        position: absolute;
        top: 40%;
        right: 10px;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: var(--blue-color);
    }

    .searchbar-input {
        padding-right: 30px;
        /* adjust this value based on the size of your button */
    }
</style>