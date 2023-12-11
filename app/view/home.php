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
    <script src="public/js/home/home.js"></script>
    <script src="public/js/post/post.js"></script>
    <script src="public/js/comment/comment.js"></script>
    <link rel="stylesheet" href="public/css/home/home.css">
    <link rel="stylesheet" href="public/css/postCard/postCard.css">

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
                        <!-- For posting -->
                        <div class="row " id="post-bar">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#myModal" id="add-post-btn">
                                What's on your mind?
                            </button>
                        </div>

                        <!-- Main Post diplay -->
                        <div class="post-container row" id="post-container">
                        </div>
                    </div>

                    <div class="col-lg-5 col-6 ps-3">
                        <div class="position-sticky top-0 start-0">
                            <?php require '../components/rightNav.php' ?>
                        </div>
                    </div>
                </div>
            </div>
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