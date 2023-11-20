<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.2.4/dist/kute.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Style for the searchbar container */
        .searchbar-container {
            position: relative;
            display: inline-block;
        }

        /* Style for the searchbar content */
        .searchbar-content {
            display: none;
            position: absolute;
            background-color: #282828;
            color: white;
            width: 100%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;

        }

        .searchbar-content ul {
            list-style: none;
            padding: 1em;
        }

        .searchbar-content ul li {
            width: 100%;
            padding: .5em;
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

        .username {
            white-space: nowrap;
            /* Prevent text from wrapping */
            overflow: hidden;
            /* Hide the overflowing content */
            text-overflow: ellipsis;
            /* Display an ellipsis (...) for overflow */
        }
    </style>
    <script>
        $(document).ready(function() {

            $.get("app/controller/CommunityController.php", {
                action: "showCommunityComment",
                groupPostID: 15
            }, function(data, status) {
                if (status === "success") {
                    $(".container").html(data);
                }
            });
        });
    </script>
</head>

<body>

    <div class="container"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>