<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 7% auto;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease;
        }
        .container:hover { transform: translateY(-5px); }
        .form-wrapper { padding: 40px; }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
            position: relative;
        }
        h2::after {
            content: '';
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #ff6b6b, #feca57);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        input:focus, textarea:focus {
            border-color: #ff6b6b;
            outline: none;
            box-shadow: 0 0 8px rgba(255, 107, 107, 0.2);
        }
        textarea { resize: none; }
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #ff6b6b, #feca57);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-submit:hover {
            background: linear-gradient(90deg, #feca57, #ff6b6b);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        .btn-submit:hover::before { left: 100%; }
        .btn-submit2{ margin-bottom: 1.5%; }
        @media (max-width: 768px) {
            .container { max-width: 90%; }
            .form-wrapper { padding: 30px; }
            h2 { font-size: 24px; }
            input, textarea { padding: 10px; }
            .btn-submit {
                padding: 12px;
                font-size: 14px;
            }
        }
        @media (max-width: 480px) {
            .form-wrapper { padding: 20px; }
            h2 { font-size: 20px; }
            label { font-size: 12px; }
            input, textarea {
                padding: 8px;
                font-size: 12px;
            }
            .btn-submit {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <?php include '../db_connectivity/db.php';
        include '../User_Profile/otp_send.php';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $subject = trim($_POST['subject']);
            $message = trim($_POST['message']);
            $error = "";
            $num = 0;

            if (empty($subject) || empty($message)) {
                $error = "All fields are required.";
            }

            if (!empty($error)) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    $error
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }else{
                $fetch_mail = mysqli_query($con, "SELECT * FROM `user`");
                while ($row = mysqli_fetch_assoc($fetch_mail)) {
                    $email = $row['u_mail'];
                    $num = $num + 1;
                    OTP($email, $subject, $message);
                }
                if ($num > 0) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Total $num Email Sent Successfully.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            }
        }

        if (isset($_POST['home'])) {
            echo "<script>location.href='./dashboard.php?admin=true&table=user'</script>";
        }
    ?>

    <div class="container">
        <div class="form-wrapper">
            <h2>Emergancy Alerts</h2>
            <?php if (isset($status)): ?>
            <div class="alert alert-<?php echo $status; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
            <?php endif; ?>
            <form id="contactForm" method="POST">
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5"></textarea>
                </div>
                <button type="submit" class="btn-submit btn-submit2" name='send'>Send Message</button>

                <button type="submit" class="btn-submit" name='home'>Home</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>