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
    <script src="public/js/profile/profile.js"></script>
    <link rel="stylesheet" href="public/css/profile/profile.css">
    <link rel="stylesheet" href="public/css/postCard/postCard.css">


</head>

<body>
    <div id="profile-container">

    </div>

    <?php include "home/modalPost.php" ?>

    <!-- For comment to show -->
    <?php include "home/commentModal.php" ?>

    <!-- Updating profile -->
    <?php include "profile/updateProfileModal.php" ?>

    <!-- Updating Post -->
    <?php include "home/updateModalPost.php" ?>
</body>

</html>