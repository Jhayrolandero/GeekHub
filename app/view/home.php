<?php
session_start();
?>

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
    <script src="public/js/comment/comment.js"></script>
    <link rel="stylesheet" href="public/css/postCard/postCard.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar Navigation-->
            <nav id="sidebar">
                <section class="shortcut-nav">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#home" id="you">
                                <ion-icon name="home-sharp"></ion-icon> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profile#<?= $_SESSION["user"] ?>" id="you">
                                <ion-icon name="person-sharp"></ion-icon> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#friend">
                                <ion-icon name="people-sharp"></ion-icon> Buddies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#discover">
                                <ion-icon name="compass-sharp"></ion-icon> Discover
                            </a>
                        </li>
                        <li class="nav-item disable">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" id="nav-drop-btn">
                                    <ion-icon name="notifications"></ion-icon> Notifications</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Link 1</a></li>
                                    <li><a class="dropdown-item" href="#">Link 2</a></li>
                                    <li><a class="dropdown-item" href="#">Link 3</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <ion-icon name="menu-sharp"></ion-icon> Menu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#logout">
                                <ion-icon name="log-out"></ion-icon> Logout
                            </a>
                        </li>

                    </ul>
                </section>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-8 main-content mx-auto" id="main-content">
                <!-- For posting -->
                <div class="row p-3" id="post-bar">
                    <div class="col-12 p-0">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#myModal" id="add-post-btn">
                            What's on your mind?
                        </button>
                    </div>
                </div>

                <!-- Main Post diplay -->
                <div class="post-container row" id="post-container">
                </div>
            </main>

            <!-- FriendBar navigation -->
            <nav id="rightbar">
                <nav id="friendbar">
                    <p id="friend-bar-title">Buddies</p>
                    <!-- Render friend side nav -->
                    <ul class="nav flex-column" id="friend-side-nav">

                    </ul>
                </nav>
                <nav id="communitybar">
                    <div class="row">
                        <div class="col-6">
                            <p id="community-bar-title">Communities</p>
                        </div>
                        <div class="col-6">
                            <button id="community-btn">Create +</button>
                        </div>
                    </div>
                    <!-- For communities -->
                    <ul class="nav flex-column" id="community-side-nav">

                    </ul>
                </nav>
            </nav>

        </div>

        <!-- Include the modal for posting -->
        <?php include "home/modalPost.php" ?>

        <!-- For image previewing -->
        <?php include "home/imageModal.php" ?>

        <!-- For comment to show -->
        <?php include "home/commentModal.php" ?>

        <!-- For updating Post -->
        <?php include "home/updateModalPost.php" ?>

        <!-- For creating Community -->
        <?php include "home/communityModal.php" ?>
    </div>
</body>

</html>