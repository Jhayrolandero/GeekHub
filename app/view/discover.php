<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/discover/discover.css">
    <link rel="stylesheet" href="public/css/postCard/postCard.css">
    <link rel="stylesheet" href="public\css\community\community.css">

    <script src="public/js/discover/discover.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-2 position-relative">
                <div class="position-sticky top-0 end-0">
                    <?php require '../components/sideNav.php' ?>
                </div>
            </div>
            <div class="col-xxl-9 col-10 ">
                <div class="row ">
                    <div class="col-lg-7 col-6 ">
                        <!-- Main Post diplay -->
                        <div class="main-content row" id="discover-post">
                        </div>
                    </div>

                    <div class="col-lg-5 col-6 ps-3 position-relative">
                        <div class="position-sticky top-0 searchbar z-1 w-100">
                            <?php require '../components/searchBar.php' ?>
                        </div>
                        <div>
                            <?php require '../components/discover/rightNav.php' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Comment -->
    <?php include "community/communityCommentModal.php" ?>


    <?php include "community/updateCommunitypostModal.php" ?>

    <!-- For creating Community -->
    <?php include "home/communityModal.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>