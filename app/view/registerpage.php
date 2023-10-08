<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GeekHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="/socmed/auth/js/register.js"></script>
    <link rel="stylesheet" href="/socmed/public/css/auth/register.css">
</head>
<body>
    <div class="container-fluid bg-container">
        <div class="row">
            <div class="col-md-4 col-7 center-column text-center p-3">
                <div class="col user-container">
                    <img src="/socmed/public/images/user_icon.png" alt="">
                    <h4>Join Us!</h4>
                </div>
                <form action="">
                    <div class="input-group p-3 border-bottom border-light">
                        <ion-icon 
                        class="input-group-text icon-label"
                        name="person-circle-outline"
                        size="large"></ion-icon>
                        <input 
                        type="text" 
                        class="form-control custom-input text-white"
                        placeholder="Username"
                        id="username">
                    </div>
                    <div class="input-group p-3 border-bottom border-light">
                        <ion-icon 
                        class="input-group-text icon-label"
                        name="mail-outline"
                        size="large"></ion-icon>
                        <input 
                        type="text" 
                        class="form-control custom-input text-white"
                        placeholder="Email"
                        id="email">
                    </div>
                    <div class="input-group mt-3 p-3 border-bottom border-light">
                        <ion-icon 
                        class="input-group-text icon-label" 
                        name="lock-closed-outline"
                        size="large"></ion-icon>
                        <input 
                        type="password" 
                        placeholder="Password" 
                        class="form-control custom-input"
                        id="password">
                    </div>
                    <div class="input-group mt-3 d-flex align-items-center justify-content-center ">
                        <button 
                        type="submit" 
                        class="btn btn-light text-black w-25 rounded-4"
                        id="register">
                        Register
                        </button>
                    </div>
                </form>
                <div class="horizontal-line">
                    <div class="line"></div>
                    <div class="text">or</div>
                    <div class="line"></div>
                </div>            
                <a class="login" href="" class="p-3">Login Instead</a>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script></body>
</body>
</html>
