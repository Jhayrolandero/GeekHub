<?php
session_start();
if (empty($_SESSION["user"])) {
    echo '<script>window.location.href = "app/view/authpage.php";</script>';
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeekHub</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <script src="public/js/home/home.js"></script>
    <script src="public/js/post/post.js"></script> -->
    <!-- <script src="public/js/post/friend.js"></script> -->

    <script src="index.js"></script>
    <link rel="stylesheet" href="public/css/home/home.css">
    <link rel="stylesheet" href="public/css/postCard/postCard.css">
    <link rel="stylesheet" href="public/css/comment/comment.css">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/crown.css' rel='stylesheet'>


</head>

<body>
    <header>
        <?php include("app/view/nav/navbar.php"); ?>
    </header>
    <!-- Where contents are rendered -->
    <div id="content"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>