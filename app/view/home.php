<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/home/home.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="public/js/home/home.js"></script>
    <script src="public/js/post/post.js"></script>
    <link rel="stylesheet" href="public/css/postCard/postCard.css">

</head>
<body>
<div class="container-fluid">
        <div class="row">

            <!-- Sidebar Navigation-->
            <nav id="sidebar">
               
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Friends
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Timeline
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Flag
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Community
                        </a>
                    </li>
                    <!-- Add more sidebar links as needed -->
                </ul>
                -----------------------------------
                <br>
                Shortcuts
                <p>Your groups here</p>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-8 main-content mx-auto" id="main-content">
                <!-- For posting -->
                <div class="row p-3" id="post-bar">
                    <div class="col-1">
                        <img src="public/images/you.png" alt="" style="width: 40px;">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#myModal">
                            What's on your mind?
                        </button>
                    </div>
                </div>
                 
                <!-- Main Post diplay -->
                <div class="post-container row" id="post-container">
                </div>
            </main>

            <!-- FriendBar navigation -->
            <nav id="friendbar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            Friends
                        </a>
                    </li>
                    show friendlist
                    <br>
                    <!-- Add more sidebar links as needed -->
                    -----------------------------------
                    <br>
                    chats probably
                </ul>
            </nav>
        
        </div>
        
        <!-- Include the modal for posting -->
        <?php include "modalPost.php"?>
</div>
</body>
</html>