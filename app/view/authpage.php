<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeekHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/socmed/auth/js/auth.js"></script>
    <link rel="stylesheet" href="/socmed/public/css/auth/auth.css">
</head>

<body>
    <div class="container-fluid bg-container">
        <!-- Nav -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="nav-container">
                <div class="logo-container">GeekHub</div>
                <div class="nav-item">
                    <button onclick="scrollToSection('login-section')">Login</button>
                    <button onclick="scrollToSection('register-section')">Register</button>
                </div>
            </div>
        </nav>

        <!-- Login -->
        <section class="row" id="login-section">
            <div class="col-sm-12 col-md-7 title-container">
                <div class="title-card">
                    <p class="">Welcome to the world of</p>
                    <h1 id="geekhub-title" class="">GeekHub</h1>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 login-container">
                <section class="text-center login-form-container">
                    <div class="row forms-field">
                        <form action="">
                            <div class="col-12">
                                <h1>Welcome Back!</h1>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Email" id="email">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="password" class="form-control" placeholder="password" id="password">
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-light" type="submit" id="login">Login</button>
                            </div>
                        </form>
                    </div>

                    <svg class="blobs" width="650" height="650" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill-opacity=".6" class="blob" fill="#FF0066" d="M49.4,-52.9C57.5,-41.2,53.3,-20.6,52.8,-0.6C52.2,19.5,55.3,38.9,47.1,52.3C38.9,65.7,19.5,73,-0.2,73.2C-19.8,73.4,-39.7,66.5,-52.7,53.1C-65.8,39.7,-72,19.8,-72.5,-0.5C-73,-20.8,-67.7,-41.6,-54.7,-53.3C-41.6,-65.1,-20.8,-67.7,-0.1,-67.6C20.6,-67.5,41.2,-64.6,49.4,-52.9Z" transform="translate(100 100)" />
                        <path fill-opacity=".8" class="blob" fill="#FCAF3C" d="M769 615q-39 115-154 249.5t-286 56Q158 842 135.5 671t2-340Q162 162 331 130.5T651.5 148q151.5 49 154 200.5T769 615Z" transform="translate(100 100)" />
                    </svg>
                </section>
            </div>
        </section>

        <!-- Register -->
        <section class="row" id="register-section">
            <div class="col-sm-12 col-md-7 title-container">
                <div class="title-card">
                    <p class="">Join the virtual world of</p>
                    <h1 id="geekhub-title" class="">GeekHub</h1>
                </div>
            </div>
            <div class="col-sm-12 col-md-5 login-container">
                <section class="text-center login-form-container">
                    <div class="row forms-field">
                        <form action="">
                            <div class="col-12">
                                <h1>Join Us!</h1>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Username" id="username">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="email" class="form-control" placeholder="Email" id="r-email">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="password" class="form-control" placeholder="Password" id="r-password">
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn" type="submit" id="register">Register</button>
                            </div>
                        </form>
                    </div>

                    <svg class="blobs" width="650" height="650" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill-opacity=".6" class="blob" fill="#FF0066" d="M49.4,-52.9C57.5,-41.2,53.3,-20.6,52.8,-0.6C52.2,19.5,55.3,38.9,47.1,52.3C38.9,65.7,19.5,73,-0.2,73.2C-19.8,73.4,-39.7,66.5,-52.7,53.1C-65.8,39.7,-72,19.8,-72.5,-0.5C-73,-20.8,-67.7,-41.6,-54.7,-53.3C-41.6,-65.1,-20.8,-67.7,-0.1,-67.6C20.6,-67.5,41.2,-64.6,49.4,-52.9Z" transform="translate(100 100)" />
                        <path fill-opacity=".8" class="blob" fill="#FCAF3C" d="M769 615q-39 115-154 249.5t-286 56Q158 842 135.5 671t2-340Q162 162 331 130.5T651.5 148q151.5 49 154 200.5T769 615Z" transform="translate(100 100)" />
                    </svg>
                </section>
            </div>
        </section>
        <div id="waves">
            <svg id="visual" viewBox="0 0 900 450">
                <path class="wave" fill-opacity=".7" d="M0 421L16.7 418.5C33.3 416 66.7 411 100 407.3C133.3 403.7 166.7 401.3 200 396.8C233.3 392.3 266.7 385.7 300 389C333.3 392.3 366.7 405.7 400 414.7C433.3 423.7 466.7 428.3 500 424.2C533.3 420 566.7 407 600 400C633.3 393 666.7 392 700 396.3C733.3 400.7 766.7 410.3 800 412.5C833.3 414.7 866.7 409.3 883.3 406.7L900 404L900 451L883.3 451C866.7 451 833.3 451 800 451C766.7 451 733.3 451 700 451C666.7 451 633.3 451 600 451C566.7 451 533.3 451 500 451C466.7 451 433.3 451 400 451C366.7 451 333.3 451 300 451C266.7 451 233.3 451 200 451C166.7 451 133.3 451 100 451C66.7 451 33.3 451 16.7 451L0 451Z" fill="#FCAF3C"></path>
                <path class="wave" fill-opacity=".5" d="M0 396L16.7 398.8C33.3 401.7 66.7 407.3 100 408.2C133.3 409 166.7 405 200 405.7C233.3 406.3 266.7 411.7 300 413.7C333.3 415.7 366.7 414.3 400 411.7C433.3 409 466.7 405 500 408.5C533.3 412 566.7 423 600 429C633.3 435 666.7 436 700 429C733.3 422 766.7 407 800 402C833.3 397 866.7 402 883.3 404.5L900 407L900 451L883.3 451C866.7 451 833.3 451 800 451C766.7 451 733.3 451 700 451C666.7 451 633.3 451 600 451C566.7 451 533.3 451 500 451C466.7 451 433.3 451 400 451C366.7 451 333.3 451 300 451C266.7 451 233.3 451 200 451C166.7 451 133.3 451 100 451C66.7 451 33.3 451 16.7 451L0 451Z" fill="#ff5d48"></path>
                <path class="wave" fill-opacity=".4" d="M0 409L16.7 412.8C33.3 416.7 66.7 424.3 100 423C133.3 421.7 166.7 411.3 200 407.3C233.3 403.3 266.7 405.7 300 408C333.3 410.3 366.7 412.7 400 413C433.3 413.3 466.7 411.7 500 409.3C533.3 407 566.7 404 600 405C633.3 406 666.7 411 700 414C733.3 417 766.7 418 800 418C833.3 418 866.7 417 883.3 416.5L900 416L900 451L883.3 451C866.7 451 833.3 451 800 451C766.7 451 733.3 451 700 451C666.7 451 633.3 451 600 451C566.7 451 533.3 451 500 451C466.7 451 433.3 451 400 451C366.7 451 333.3 451 300 451C266.7 451 233.3 451 200 451C166.7 451 133.3 451 100 451C66.7 451 33.3 451 16.7 451L0 451Z" fill="#ff4951"></path>
                <path class="wave" fill-opacity=".2" d="M0 368L16.7 363.3C33.3 358.7 66.7 349.3 100 352.2C133.3 355 166.7 370 200 377C233.3 384 266.7 383 300 377.8C333.3 372.7 366.7 363.3 400 359.5C433.3 355.7 466.7 357.3 500 361.3C533.3 365.3 566.7 371.7 600 375.8C633.3 380 666.7 382 700 383.8C733.3 385.7 766.7 387.3 800 381.5C833.3 375.7 866.7 362.3 883.3 355.7L900 349L900 451L883.3 451C866.7 451 833.3 451 800 451C766.7 451 733.3 451 700 451C666.7 451 633.3 451 600 451C566.7 451 533.3 451 500 451C466.7 451 433.3 451 400 451C366.7 451 333.3 451 300 451C266.7 451 233.3 451 200 451C166.7 451 133.3 451 100 451C66.7 451 33.3 451 16.7 451L0 451Z" fill="#ff0066"></path>
            </svg>
        </div>

        <!-- </div> -->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>
</body>

</html>