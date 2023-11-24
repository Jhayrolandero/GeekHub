<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/discover/discover.css">
    <script src="public/js/discover/discover.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
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
            <main class="col-md-6 col-lg-4 main-content mx-auto" id="discover-post">
            </main>

            <nav id="rightbar">

                <nav id="communitybar">
                    <div class="row">
                        <div class="col-6">
                            <p id="community-bar-title">Recommended</p>
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
    </div>

    <!-- Modal Comment -->
    <?php include "community/communityCommentModal.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>