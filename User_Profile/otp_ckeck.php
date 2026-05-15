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
        .create_acc { margin-left: 1%; }
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
        .main{ margin:4% auto; }
    </style>
</head>

<body>
    <?php include '../db_connectivity/db.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $otp = $_SESSION['otp'];
        $name = $_SESSION['name'];
        $email = $_SESSION['mail'];
        $pass = $_SESSION['pass'];
        $cpass = $_SESSION['cpass'];
        $role = $_SESSION['role'];
        if ($otp == (int)$_POST['otp']) {
            $ins = "INSERT INTO `user`(`u_name`,`u_mail`,`user_role`,`u_password`,`u_confirm_pass`) VALUES ('$name','$email','$role','$pass','$cpass')";
            $fire_ins = mysqli_query($con, $ins);
            if ($fire_ins) {
                unset($_SESSION['otp']);
                unset($_SESSION['name']);
                unset($_SESSION['pass']);
                unset($_SESSION['cpass']);
                unset($_SESSION['mail']);
                unset($_SESSION['role']);
                header("Location: login.php");
            } else {
                header("Location: registration.php");
            }
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>OTP!</strong> Incorrect.
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
                        <h2 class="form-title">OTP Check</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><iconify-icon icon="teenyicons:otp-solid" style="color: black"></iconify-icon></label>
                                <input type="text" name="otp" id="name" placeholder="OTP" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                                <input type="submit" name="login" id="signin" class="form-submit" value="Back to Login"/>
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