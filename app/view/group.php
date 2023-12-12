<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public\css\community\community.css">
    <script src="public\js\community\community.js"></script>
    <link rel="stylesheet" href="public/css/postCard/postCard.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>

<body>
    <div id="community-container">
    </div>

    <!-- Modal Post -->
    <?php include "community/communityModalPost.php" ?>

    <!-- Modal Comment -->
    <?php include "community/communityCommentModal.php" ?>

    <!-- Update Community Modal -->
    <?php include "community/updateCommunityModal.php" ?>

    <!-- Update Community Post Modal -->
    <?php include "community/updateCommunitypostModal.php" ?>
</body>

</html>