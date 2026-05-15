<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Email Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            background-color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .email-wrapper {
            display: flex;
            flex-wrap: wrap;
        }
        .email-preview {
            flex: 1;
            padding: 30px;
            background-color: #f9f9f9;
            border-right: 1px solid #e0e0e0;
        }
        .email-preview h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }
        .email-header p {
            font-size: 14px;
            margin-bottom: 8px;
            color: #555;
        }
        .email-header p strong { color: #333;}
        .reply-form {
            flex: 1;
            padding: 30px;
            background-color: #fff;
        }
        .reply-form h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }
        .form-group input,.form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        .form-group textarea { resize: vertical; }
        .form-group input[readonly] {
            background-color: #f0f0f0;
            cursor: not-allowed;
        }
        .form-actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-send {
            background-color: #007bff;
            color: #fff;
        }
        .btn-send:hover { background-color: #0056b3; }
        .btn-draft {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-draft:hover { background-color: #5a6268; }
        @media (max-width: 768px) {
            .email-wrapper { flex-direction: column; }
            .email-preview {
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }
        }
    </style>
</head>

<body>
    <?php include '../User_Profile/otp_send.php';
    include '../db_connectivity/db.php';
    $cid = base64_decode($_GET['cid']);
    $sql = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM contact_us WHERE c_id = '$cid'"));

    $date = date_create($sql['time']);
    $formatted_date = date_format($date, 'd/m/Y');
    $subject = $sql['u_subject'];
    if(isset($_POST['dashboard'])) {
        header('Location: ./dashboard.php?admin=true&table=contact_us&reply=false');
    }
    if (isset($_POST['reply'])) {
        $msg = $_POST['message'];
        $to = $_POST['to'];
        $subject = $_POST['subject'];
        $name = $sql['u_name'];
        $fully_msg = "Dear $name, <br/><br/>$msg<br/><br/> Regards, <br/> Agrichain Team";
        $new_sub = "Reply to: $subject";
        if (OTP($to, $new_sub, $fully_msg)) {
            echo "<script>alert('Reply sent successfully!');</script>";
            header('Location: ./dashboard.php?admin=true&table=contact_us&reply=true');
        } else {
            echo "<script>alert('Failed to send reply!');</script>";
        }
    }
?>
    <div class="container">
        <div class="email-wrapper">
            <div class="email-preview">
                <h2>User's Question</h2>
                <div class="email-header">
                    <p><strong>From:</strong> agrichain.yourtraders@gmail.com</p>
                    <p><strong>To:</strong> <?php echo htmlspecialchars($sql['u_mail']); ?></p>
                    <p><strong>Subject:</strong> <?php echo htmlspecialchars($subject); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($formatted_date); ?></p>
                </div>
            </div>

            
            <div class="reply-form">
                <h2>Compose Reply</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="to">To:</label>
                        <input type="email" id="to" name="to" value="<?php echo $sql['u_mail']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="cc">CC:</label>
                        <input type="email" id="cc" name="cc" placeholder="Optional">
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($subject); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="10" placeholder="Type your reply here..."></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name='reply' class="btn btn-send">Send Reply</button>
                        <button type="submit" name='dashboard' class="btn btn-draft">Back to the Dashboard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>