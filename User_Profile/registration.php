<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up - Agrichain</title>
    <link rel="shortcut icon" href="../Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./both_css/main.css">
    <style>
        .form-group:last-child {
            margin-bottom: 0%;
        }
        .create_acc {
            margin-left: 1%;
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
        select {
            width: 100%;
            text-align: center;
            margin-bottom: 3%;
            border: 0.4px solid gray;
            border-radius: 7px;
            background: #C0CCEAFF;
        }
        .alert{margin: 0.5%;}
        .signup {
            margin: 4% auto;
        }
    </style>
</head>

<body>

    <?php include '../db_connectivity/db.php';
    include './otp_send.php';
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $cpass = $_POST['re_pass'];
        $role = $_POST['role'];
        $error = array();

        if (!preg_match_all("/^[A-Za-z ]+$/", $name)) {
            $error[] = "Name is Invalid (Must only contain letters and whitespace).";
        }
        if (!preg_match_all("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,3}$/", $email)) {
            $error[] = "Email is Invalid (Must contain a valid email address (with @ and .)).";
        }
        if (!preg_match_all("/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/", $pass)) {
            $error[] = "Password is Invalid (Must contain At least 8 characters long, At least one uppercase letter, At least one lowercase letter, At least one digit, At least one special character).";
        }
        if ($role === "select") {
            $error[] = "Must be Select User Role";
        }

        if (count($error) == 0) {
            $mail_check = "SELECT `u_mail` FROM `user` where `u_mail` = '$email'";
            $fire = mysqli_query($con, $mail_check);
            $num = mysqli_num_rows($fire);
            if ($num == 0) {
                if ($pass == $cpass) {
                    $npass = base64_encode($pass);
                    $ncpass = base64_encode($cpass);

                    $otp = rand(100000, 999999);
                    $sub = "One-Time Password (OTP) for Agrichain User Registration";
                    $msg = "Your One-Time Password (OTP) for Registration is:<br/> 🔑  [ $otp ]  🔑 <br/><br/>If you did not request this OTP, please ignore this email or contact our support team immediately.<br/> <br/><br/><br/><br/> Best regards,<br/> Agrichain";
                    if (!OTP($email,$sub,$msg,$otp)) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>OTP!</strong> is not Sent.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    } else {
                        session_start();
                        $_SESSION['otp'] = $otp;
                        $_SESSION['pass'] = $npass;
                        $_SESSION['cpass'] = $ncpass;
                        $_SESSION['name'] = $name;
                        $_SESSION['mail'] = $email;
                        $_SESSION['role'] = $role;
                        header("Location: otp_ckeck.php");
                    }
                } else {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Both Password should not matched. <strong>Please</strong> enter same Password.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        User already Exist.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        } else {
            foreach ($error as $i) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$i
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
    }

    ?>

    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><iconify-icon icon="wpf:name"></iconify-icon></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" />
                            </div>
                            <div class="form-group">
                                <label for="email"><iconify-icon icon="ic:round-email" style="color: black"></iconify-icon></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" />
                            </div>
                            <div>
                                <select style="padding: 10px;  border:none;" name="role">
                                    <option value="select"> -- Select Your Role -- </option>
                                    <option value="Farmer">Farmer</option>
                                    <option value="Buyer">Buyer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pass"><iconify-icon icon="material-symbols:lock" style="color: black"></iconify-icon></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><iconify-icon icon="material-symbols:lock-outline" style="color: black"></iconify-icon></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" style="width: 100%;" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="./Images/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="./login.php" class="signup-image-link"><iconify-icon icon="uil:signin" style="color: black"></iconify-icon><span class="create_acc">I am already member</span></a>
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