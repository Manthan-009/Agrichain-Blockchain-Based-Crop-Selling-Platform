<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Agrichain</title>
    <link rel="shortcut icon" href="../Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./both_css/main.css">
    <style>
        .form-group:last-child { margin-bottom: 26%; }
        .alert{ margin:0.5%; }
        .create_acc { margin-left: 1%; }
        .container{ margin:4% auto; }
        .forget_pass_a:hover { text-decoration: underline; }
        .signup-image-link {
            font-size: 14px;
            color: #222;
            margin:auto;
            width: 100%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .forget_pass_a {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            text-decoration: none;
        }
        .form-submit{width:100%;}
        .form_btn_2{
            margin-top: -27%;
            margin-bottom: 5%;
        }
        button{
            border:none;
        }
    </style>
</head>

<body>

    <?php
        if (isset($_GET['user'])) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Incorrect Email or Password.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        } else if (isset($_GET['user_c'])) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>User</strong> is not Exist. Please First Registration.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        
        if (isset($_GET['update'])) {
            if ($_GET['update'] == 'true') {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Your password is updated successfully. You're good to go—log in with your new password whenever you're ready!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Error!</strong> We couldn't update your password. Double-check your entries and give it another shot.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    ?>

    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="./Images/images/signin-image.jpg" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" action="handle_login.php" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><iconify-icon icon="ic:round-email" style="color: black"></iconify-icon></label>
                                <input type="text" name="mail" id="your_name" placeholder="Your Email" />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><iconify-icon icon="material-symbols:lock" style="color: black"></iconify-icon></label>
                                <input type="password" name="pass" id="your_pass" placeholder="Password" />
                            </div>
                            <a href="./forget_email.php" class="forget_pass_a signup-image-link" style="text-align: right;"><span class="forget_pass">Forgot Password?</span></a>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <form class='form_btn_2' action='../index.php'>
                            <button id="signin" class="form-submit">Back to Home</button>
                        </form>
                        <div class="social-login">
                            <a href="./registration.php" class="signup-image-link "><iconify-icon icon="mingcute:user-add-fill" class="iconify" style="color: black;font-size:1.2em;"></iconify-icon><span class="create_acc">Create an account</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@2.1.0/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>