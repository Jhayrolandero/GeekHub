<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/kute.js@2.2.4/dist/kute.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #141414;
            color: #fff;
        }

        .profile-header {
            background-color: #282828;
            height: fit-content;
            border-radius: 10px;
        }

        .bg-img img {
            width: 100%;
            background-size: cover;
            background-position: center;
            height: 400px;
            border-radius: 10px;
        }

        .profile-info {
            position: relative;
        }

        .profile-info .profile-img {
            width: 150px;
            height: 150px;
            display: inline-block;
            position: absolute;
            left: 10%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
        }
    </style>

</head>

<body>

    <header class="container profile-header pb-5">
        <div class="row">
            <div class="bg-img">
                <img src="public\images\pngtree-abstract-bg-image_914283.jpg" alt="background-image">
            </div>
        </div>
        <div class="profile-info">
            <div class="row">
                <div class="col-2">
                    <div class="row">
                        <img src="public\images\zed.jpg" class="profile-img" alt="">
                    </div>
                </div>
                <div class="col-7 profile-info-val">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="profile-name">Cjay</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>