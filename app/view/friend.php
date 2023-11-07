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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation-->
            <nav id="sidebar">
                <div>Buddy</div>
                <ul class="nav flex-column">
                    <button data-action="suggestion" class="btn nav-btn">Suggestion</button>
                    <button data-action="pending" class="btn nav-btn">Pending</button>
                    <button data-action="list" class="btn nav-btn">Buddies</button>
                    <!-- Add more sidebar links as needed -->
                </ul>
                -----------------------------------
                <br>
                Shortcuts
                <p>Your groups here</p>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-8 main-content mx-auto" id="main-content">
                <div class="row" id="friend-content"></div>
            </main>
        </div>
    </div>
</body>
</html>