<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP Verify - Agrichain</title>
    <link rel="shortcut icon" href="../Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./both_css/main.css">
    <style>
        .form-group:last-child { margin-bottom: 0%; }
        .create_acc {
            margin-left: 1%;
            margin-bottom: 5%;
        }
        .signup-image-link {
            font-size: 14px;
            color: #222;
            margin: auto;
            width: 100%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-submit{width:100%;}
    </style>
</head>

<body>
    <?php include '../db_connectivity/db.php';
        $mail = base64_decode($_GET['mail']);
        $otp = base64_decode($_GET['otp']);
        $fetch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE u_mail = '$mail'"));
        
        if (isset($_POST['submit_otp'])) {
            if ($otp == (int)$_POST['otp']) {
                header("Location: update_password.php?mail=" .base64_encode($mail). "");
            }else{
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>OTP!</strong> is Wrong.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }

        if (isset($_POST['login'])) {
            header("Location: login.php");
        }
    ?>
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h3 class="form-title">Enter verification code</h3>
                        <p class="create_acc">For your security, we have sent the code to your email <?php echo $fetch['u_mail']; ?>.</p>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><iconify-icon icon="teenyicons:otp-solid" style="color: black"></iconify-icon></label>
                                <input type="text" name="otp" id="name" placeholder="OTP" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit_otp" id="signup" class="form-submit" value="Submit code" />
                                <input type="submit" name="login" id="signin" class="form-submit" value="Back to Login" style="width: 100%;"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="./Images/images/signup-image.jpg" alt="sing up image"></figure>
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