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
        .create_acc { margin-bottom: 5%; }
        .main{ margin:4% auto; }
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
        .alert{ margin:0.5%; }
    </style>
</head>

<body>

    <?php include '../db_connectivity/db.php';
        if (isset($_POST['btnsubmit'])) {
            $mail = base64_decode($_GET['mail']);
            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];
            $error = array();

            if (!preg_match_all("/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/", $pass)) {
                $error[] = "Password must contain at least one uppercase letter, one number and one special character.";
            }

            if (count($error) == 0) {
                if ($pass == $cpass) {
                    $upass = base64_encode($pass);
                    $ucpass = base64_encode($cpass);
                    $update_que = mysqli_query($con, "UPDATE `user` SET `u_password` = '$upass', `u_confirm_pass` = '$ucpass' WHERE `u_mail` = '$mail'");
                    if ($update_que) {
                        header("Location: ./login.php?update=true");
                    }else{
                        header("Location: ./login.php?update=false");
                    }
                }else{
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error!</strong> Both password must be same.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            }else{
                foreach($error as $err){
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error!</strong> $err
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
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
                        <h3 class="form-title">Create new password</h3>
                        <p class="create_acc">We'll ask for this password whenever you sign in.</p>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_pass"><iconify-icon icon="material-symbols:lock" style="color: black"></iconify-icon></label>
                                <input type="password" name="pass" id="your_pass" placeholder="New Password" />
                            </div>
                            <div class="form-group">
                                <label for="your_pass2"><iconify-icon icon="material-symbols:lock" style="color: black"></iconify-icon></label>
                                <input type="password" name="cpass" id="your_pass2" placeholder="Confirm Password" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="btnsubmit" id="signin" class="form-submit" value="Save changes"/>
                                <input type="submit" name="login" id="signin" class="form-submit" value="Back to Login"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@2.1.0/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>