<?php include './db_connectivity/db.php'; ?>
<!DOCTYPE html>
<html lang="en" class="chat_common_html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Forum - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="buyer_chat_body">
    <?php
        $uid = base64_decode($_GET['uid']);
        $rf = "SELECT * FROM `user` WHERE `u_id` = $uid";
        $que_res = mysqli_query($con, $rf);
        $fed = mysqli_fetch_assoc($que_res);
        $chat_type = $fed['user_role'];

        if (isset($_POST['btn_post'])) {
            $name = $_POST['username'];
            $msg = $_POST['message'];
            $error = array();
            if (empty($name)) { $error[] = "User Name should be required."; }
            if (empty($msg)) { $error[] = "Message should be required."; }

            if (count($error) == 0) {
                $sql2 = "INSERT INTO `specific_chat`(`u_id`,`u_name`,`u_role`,`message`) VALUES('$uid','$name','$chat_type','$msg')";
                $result = mysqli_query($con, $sql2);
                if (!$result) {
                    echo "<div class='alert alert-danger alert-dismissible fade show buyer_chat_alert_chat' role='alert'>
                                <strong>Server Error,</strong> Try again.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                }
            } else {
                for ($i = 0; $i < count($error); $i++) {
                    echo "<div class='alert alert-danger alert-dismissible fade show buyer_chat_alert_chat' role='alert'>$error[$i]
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                }
            }
        }

        if (isset($_POST['btn_home'])) {
            $id = $_GET['uid'];
            $w = $_GET['w'] === 'true' ? 'true' : 'false';
            echo "<script type='text/javascript'>window.location.href = 'http://localhost/Mini_Project/index.php?uid=$id&w=$w';</script>";
        }
    ?>

    <div class="buyer_chat_containers3">
        <h1 class="buyer_chat_heading_chat_1"><?php echo $chat_type === 'Farmer' ? 'Farmer Chat' : 'Buyer Chat'; ?></h1>
        <form method="post" class="buyer_chat_form">
            <input type="text" name="username" placeholder="Enter your name" class="buyer_chat_input-text">
            <textarea name="message" placeholder="Write your message..." rows="5" class="buyer_chat_textarea"></textarea>
            <input type="submit" name="btn_post" value="Post" class="buyer_chat_input-submit">
            <button name="btn_home" class="buyer_chat_button">Home</button>
        </form>
        
        <?php 
            $sql_sele = "SELECT * FROM `specific_chat` WHERE `u_role` = '$chat_type'";
            $run = mysqli_query($con, $sql_sele);
            $num = mysqli_num_rows($run);
            if ($num != 0) {
                while ($result = mysqli_fetch_assoc($run)) {
                    echo "<div class='buyer_chat_post'>
                        <h4 class='buyer_chat_post-title'>" . $result['u_name'] . "</h4>
                        <p class='buyer_chat_post-content'>" . $result['message'] . "</p>
                        <div class='buyer_chat_timestamp'>" . date('F j, Y, g:i a', strtotime($result['created_at'])) . " </div>
                    </div>";
                }
            } else {
                echo "<p class='buyer_chat_no-posts'>No posts yet. Be the first to post!</p>";
            }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>