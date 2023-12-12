<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/friend/friend.css">
    <script src="public/js/friend/friend.js"></script>
</head>

<body>
    <div class="container-fluid position-relative">
        <div class="row">
            <!-- Sidebar Navigation-->
            <div class="col-xxl-2 col-lg-12" id="friend-sidebar">
                <div>
                    <h4>Buddy</h4>
                </div>
                <ul class="nav flex-column ">
                    <div class="row mx-auto">

                        <button data-action="suggestion" class="btn nav-btn friend-btn mt-3">Suggestion</button>
                        <button data-action="pending" class="btn nav-btn friend-btn mt-3">Pending</button>
                        <button data-action="list" class="btn nav-btn friend-btn mt-3">Buddies</button>

                    </div>
                    <!-- Add more sidebar links as needed -->
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-xxl-9 col-md-12 col-lg-8 main-content mx-auto" id="main-content">
                <div class="row" id="friend-content"></div>
            </div>

        </div>
        <div class="position-fixed bottom-0 end-0 me-3 mb-3">
            <?php require "../components/backToHome.php" ?>
        </div>
    </div>
</body>

</html>