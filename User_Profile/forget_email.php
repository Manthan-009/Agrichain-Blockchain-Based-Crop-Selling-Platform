<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password - Agrichain</title>
    <link rel="shortcut icon" href="../Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./both_css/main.css">
    <style>
        .form-group:last-child {
            margin-bottom: 26%;
        }
        .create_acc {
            margin-left: 1%;
            margin-bottom: 5%;
        }
        .alert{margin: 0.5%;}
        .main{ margin:4% auto; }
    </style>
</head>

<body>

    <?php include '../db_connectivity/db.php';
        include './otp_send.php';
        if (isset($_POST['continue'])) {
            $mail = $_POST['mail'];
            $error = array();
            if (!preg_match_all("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,3}$/", $mail)) {
                $error[] = "Email is Invalid (Must contain a valid email address (with @ and .)).";
            }
            if (count($error) != 0) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error[0]
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }else{
                $sql = mysqli_query($con, "SELECT * FROM user WHERE u_mail = '$mail'");
                $row = mysqli_num_rows($sql);
                $fetch = mysqli_fetch_assoc($sql);
                if ($sql == 0) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>User</strong> is not Exist. Please First Registration.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }else{
                    $otp = rand(100000, 999999);
                    $sub = "Your Password Reset OTP";
                    $msg = "Dear " .$fetch['u_name']. ",<br/>We received a request to reset the password for your Agrichain account associated with this email address (" .$fetch['u_mail']. "). To proceed, please use the One-Time Password (OTP) provided below:<br/><br/>Your OTP: [ $otp ] <br/><br/>If you didn't request this password reset, please ignore this email or contact our support team at agrichain.yourtraders@gmail.com immediately. For security reasons, do not share this OTP with anyone.<br/><br/><br/><br/>Thank you,<br/>Best regards,<br/> Agrichain";
                    OTP($mail, $sub, $msg);
                    header("Location: ./otp_verify.php?mail=" .base64_encode($mail). "&otp=" .base64_encode($otp). "");
                }
            }
        }  

        if (isset($_POST['login'])) {
            header("Location: login.php");
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
                        <h3 class="form-title">Password assistance</h3>
                        <p class="create_acc">Enter the email address associated with your Agrichain account.</p>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><iconify-icon icon="ic:round-email" style="color: black"></iconify-icon></label>
                                <input type="text" name="mail" id="your_name" placeholder="Your Email" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="continue" id="signin" class="form-submit" value="Continue" style="width: 100%;"/>
                                <input type="submit" name="login" id="signin" class="form-submit" value="Back to Login" style="width: 100%;"/>
                            </div>
                        </form>
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