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
    <div class="container bg-container">

        <!-- Login -->
        <section class="row" id="login-section">
            <div class="col-sm-12 col-lg-6 col-xxl-6 title-container">
                <div class="title-card">
                    <p class="">Welcome to the world of</p>
                    <h1 id="geekhub-title" class="">GeekHub</h1>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-xxl-6 login-container">
                <section class="text-center login-form-container">
                    <div class="row forms-field">
                        <form action="">
                            <div class="col-12 mb-5">
                                <h1>Welcome Back!</h1>
                            </div>
                            <div class="col-12">
                                <input type="text" class="auth-form" autocomplete="off" placeholder="Email" id="email">
                            </div>

                            <div class="col-12 mt-4">
                                <input type="password" class="auth-form" autocomplete="off" placeholder="password" id="password">
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn login-btn" type="submit" id="login">Login</button>
                            </div>
                            <span>
                                or
                            </span>
                            <div class="col-12">

                                <button type="button" class="btn register-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Sign Up
                                </button>
                                <p><span class="terms">By signing up, you agree to the <span>Terms of Service</span> and <span>Privacy Policy</span>, including <span>Cookie Use.</span></span></p>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>

        <div class="modal register-modal" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content register-form">
                    <div class="modal-header">
                        <h4 class="modal-title">Sign Up</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="col-12 form-floating sign-up-form">
                                <input type="text" class="form-control register-form" autocomplete="off" id="username" placeholder="name@example.com">
                                <label class="register-label">Username</label>
                            </div>
                            <div class="username-error error"></div>
                            <div class="col-12 form-floating sign-up-form">
                                <input type="email" class="form-control register-form email-form" autocomplete="off" id="r-email" placeholder="password">
                                <label class="register-label">Email</label>
                            </div>
                            <div class="email-error error"></div>
                            <div class="col-12 form-floating sign-up-form">
                                <input type="password" class="form-control register-form" autocomplete="off" id="r-password" placeholder="email">
                                <label class="register-label">Password</label>
                            </div>
                            <div class="password-error error"></div>

                            <div class="col-12 row sign-up-form mx-auto disable m-0 p-0" id="otp">
                                <label for="" class="form-label">OTP</label>
                                <div class="col-9 p-0">
                                    <input type="text" id="given-otp" value=null hidden>
                                    <input type="text" class="register-form" autocomplete="off" placeholder="OTP" id="r-otp">
                                </div>
                                <div class="col-3 p-0">
                                    <button class="otp-btn" class="btn" type="button">Send me OTP</button>
                                    <div class="loading text-center" style="display: none;">
                                        <span class="spinner-border text-info spinner-border-sm"></span>
                                        <span>Sending...</span>
                                    </div>
                                </div>
                                <p class="otp-p p-0"><span>Check your email, enter the given OTP to verify your account</span></p>
                            </div>
                            <div class="otp-error error disable"></div>


                            <div class="col-12 sign-up-form">
                                <button class="btn disable-register-btn" type="button" id="register">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</body>

</html>