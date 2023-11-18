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

            // Initial load
            loadPageFromHash();

            // Function to load a page based on the hash
            function loadPageFromHash() {
                var hash = window.location.hash.substring(1);
                var hashParts = hash.split("#");

                var route = hashParts[0];

                if (route === "group") {
                    var id = hashParts[1];
                    render_community(id);
                }
            }

            // Listen for URL changes
            $(window).on("hashchange", function() {
                loadPageFromHash();
            });

            function render_community(communityID) {
                // Getting user info
                $.get("app/controller/CommunityController.php", {
                    action: "showCommunity",
                    communityID: communityID
                }, function(data, status) {
                    if (status === "success") {
                        $("#community-container").html(data);
                    }
                });
            }
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="card">

            <!-- Post Info like user -->
            <div class="card-header p-3" id="card-header">
                <div class="row">

                    <!-- Profile -->
                    <div class="col-1 text-center">
                        <a href="#profile#">
                            <img src="public/images/you.png" alt="" style="width:45px;" class="rounded-pill">
                        </a>
                    </div>

                    <!-- Username and Community Name -->
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">Honkai Star Rail</div>
                        </div>
                        <div class="row">
                            <div class="col-5 username">
                                Himeko
                            </div>
                            <div class="col-6 date">1d</div>
                        </div>
                    </div>

                    <!-- Del and Update Dropdown -->
                    <div class="col-2 option-col text-end">

                        <button data-bs-toggle="dropdown" class="option-btn">
                            <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                        </button>
                        <ul class="dropdown-menu post-menu">
                            <li><button class="btn post-menu-delete">Delete Post</button></li>
                            <li><button class="btn post-menu-update">Update Post</button></li>
                        </ul>
                        <button type="button" class="p-0 hide-post" data-bs-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>

            <!-- Post Content -->
            <div class="card-body p-0" id="card-body">
                <div class="row content">
                    <div class="col-12 pb-2 post-content">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam, earum.
                    </div>

                </div>
                <input name="post_id" value="<?= $post_id ?>" class="post_id" hidden></input>
                <input name="user_id" value="<?= $_SESSION["user"] ?>" class="user_id" hidden></input>
                <input name="user_id" value="" class="creator_id" hidden></input>
            </div>

            <!-- Like and stuffs -->
            <div class="card-footer" id="card-footer">
                <div class="row">
                    <div class="col-6 text-center">
                        <button class="w-100 meta-btn btn like-btn">
                            <ion-icon name="thumbs-up"></ion-icon> like (4)
                        </button>

                    </div>
                    <div class="col-6 text-center">
                        <button type="button" class="w-100 meta-btn btn comment-btn">
                            <ion-icon name="chatbox-ellipses"></ion-icon> Comment (3)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>