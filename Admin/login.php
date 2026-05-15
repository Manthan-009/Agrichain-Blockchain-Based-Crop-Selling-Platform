<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
    <title>Login - Admin</title>
	<link rel="icon" type="image/png" href="../Images/images/logo.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/378f2c93a4.js" crossorigin="anonymous"></script>
    <style>
        .login100-pic img {
            transition: transform 0.3s ease-in-out;
        }
        .login100-pic img:hover {
            transform: scale(1.1); 
            cursor: pointer;
        }
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
        body {
            background: url('../Images/images/blog-img.jpg') no-repeat center center fixed;
            font-family: Poppins-Regular, sans-serif;
            background-size: cover;
            height: 100vh;
            backdrop-filter: blur(8px);
        }
        input {
            border: none;
            outline: none;
        }
        input:focus {
            border-color: transparent !important;
        }
        button {
            outline: none !important;
            border: none;
            background: transparent;
        }
        button:hover {
            cursor: pointer;
        }
        .limiter {
            width: 100%;
            margin: 0 auto;
        }
        .container-login100 {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }
        .container-login100-form-btn {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 20px;
        }
        .wrap-login100 {
            width: 960px;
            background: #fff;
            border-radius: 10px;
            box-shadow:0px 9px 10px 4px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            border: 1px solid lightgray;
            padding: 7%;
        }
        .login100-pic {
            width: 316px;
        }
        .login100-pic img {
            max-width: 100%;
        }
        .login100-form {
            width: 290px;
        }
        .login100-form-title {
            font-family: Poppins-Bold;
            font-size: 24px;
            color: #333333;
            line-height: 1.2;
            text-align: center;
            width: 100%;
            display: block;
            padding-bottom: 54px;
        }
        .login100-form-btn {
            font-family: Montserrat-Bold;
            font-size: 15px;
            line-height: 1.5;
            color: #fff;
            text-transform: uppercase;
            width: 100%;
            height: 50px;
            border-radius: 25px;
            background: #57b846;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 25px;
            transition: all 0.4s;
        }
        .login100-form-btn:hover {
            background: #333333;
        }
        .wrap-input100 {
            position: relative;
            width: 100%;
            z-index: 1;
            margin-bottom: 10px;
        }
        .validate-input {
            position: relative;
        }
        .input100 {
            font-family: Poppins-Medium;
            font-size: 15px;
            line-height: 1.5;
            color: #666666;
            display: block;
            width: 100%;
            background: #e6e6e6;
            height: 50px;
            border-radius: 25px;
            padding: 0 30px 0 68px;
        }
        .focus-input100 {
            display: block;
            position: absolute;
            border-radius: 25px;
            bottom: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            box-shadow: 0px 0px 0px 0px;
            color: rgba(87, 184, 70, 0.8);
        }
        .input100:focus+.focus-input100 {
            animation: anim-shadow 0.5s ease-in-out forwards;
        }
        .symbol-input100 {
            font-size: 15px;
            display: flex;
            align-items: center;
            position: absolute;
            border-radius: 25px;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding-left: 35px;
            pointer-events: none;
            color: #666666;
            transition: all 0.4s;
        }
        .input100:focus+.focus-input100+.symbol-input100 {
            color: #57b846;
            padding-left: 28px;
        }
        @media (max-width: 992px) {
            .login100-pic {width: 35%;}
            .wrap-login100 {padding: 177px 90px 33px 85px;}
            .login100-form {width: 50%;}
        }
        @media (max-width: 768px) {
            .wrap-login100 {padding: 100px 80px 33px 80px;}
            .login100-pic {display: none;}
            .login100-form {width: 100%;}
        }
        @media (max-width: 576px) {
            .wrap-login100 {padding: 100px 15px 33px 15px;}
        }
    </style>
</head>
<body>
    
    <?php 
        if(isset($_POST['btn'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            if($email == 'admin123@gmail.com' && $pass == 'admin123') {
                echo "<script type='text/javascript'>
                    window.location.href = 'http://localhost/Mini_Project/Admin/dashboard.php?admin=true&table=user';
                </script>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Error! </strong> Invalid login Credential.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    ?>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../Images/images/admin_login.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title">Admin Login</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name='btn'>Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>