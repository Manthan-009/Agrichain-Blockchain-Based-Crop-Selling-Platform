<?php include './db_connectivity/db.php'; ?>
<!DOCTYPE html>
<html lang="en" class="specific_chat_html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Forum - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="specific_chat_body">
    <?php
        $uid = base64_decode($_GET['uid']);
        $rf = "SELECT * FROM `user` WHERE `u_id` = $uid";
        $que_res = mysqli_query($con, $rf);
        $fed = mysqli_fetch_assoc($que_res);
        
        $far_id = 0;
        $buy_id = 0;
        $oid = base64_decode($_GET['oid']);
        
        if ($fed['user_role'] == "Buyer") {
            $far_id = $oid;
            $buy_id = $uid;
        } else {
            $far_id = $uid;
            $buy_id = $oid;
        }

        $tid = base64_decode($_GET['tid']);
        if(isset($_POST['btn_post'])){
            $msg = $_POST['message'];
            $error = "";
            
            if (empty($msg)) {
                $error = "Message should be required.";
            }

            if (empty($error)) {
                $rf = "SELECT * FROM `user` WHERE `u_id` = $uid";
                $que_res = mysqli_query($con, $rf);
                $fed = mysqli_fetch_assoc($que_res);
                $uname = $fed['u_name'];
                $sql2 = "INSERT INTO `fb_chat`(`f_id`,`b_id`,`t_id`,`u_name`,`message`) VALUES('$far_id','$buy_id','$tid','$uname','$msg')";
                $result = mysqli_query($con, $sql2);
                if (!$result) {
                    echo "<div class='alert alert-danger alert-dismissible fade show specific_chat_alert' role='alert'>
                                <strong>Server Error,</strong> Try again.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                }   
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show specific_chat_alert' role='alert'>$error
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
        if (isset($_POST['btn_home'])) {
            $id = $_GET['uid'];
            if ($_GET['w'] == 'true') {
                echo "<script type='text/javascript'>
                    window.location.href = 'http://localhost/Mini_Project/index.php?uid=$id&w=true';
                </script>";
            } else {
                echo "<script type='text/javascript'>
                    window.location.href = 'http://localhost/Mini_Project/index.php?uid=$id&w=false';
                </script>";
            }
        }
    ?>

    <div class="specific_chat_container">
        <?php
        $rols = ($fed['user_role'] == "Buyer" ? "Farmer" : "Buyer");
            echo "<h1 class='specific_chat_title'>Chat with $rols</h1>";
        ?>
        <form method="post" class="specific_chat_form">
            <textarea name="message" placeholder="Write your message..." rows="5" class="specific_chat_textarea"></textarea>
            <input type="submit" name="btn_post" value="Post" class="specific_chat_input-submit">
            <button name="btn_home" class="specific_chat_button">Home</button>
        </form>
        
        <div class="specific_chat_chat-container">
        <?php 
            $sql_sele = "SELECT * FROM `fb_chat` WHERE `f_id` = $far_id AND `b_id` = $buy_id AND `t_id` = $tid";
            $run = mysqli_query($con, $sql_sele);
            $num = mysqli_num_rows($run);
            if ($num != 0) {
                echo "<h1 class='specific_chat_chat_h1'>Chats</h1>";
                while ($result = mysqli_fetch_assoc($run)) {
                    $role_class = ($result['u_name'] == $fed['u_name']) ? "specific_chat_buyer" : "specific_chat_farmer";
                    echo "<div class='specific_chat_message $role_class'>
                            <p>" . $result['message'] . "</p>
                            <div class='specific_chat_timestamp'>" . date('F j, Y, g:i a', strtotime($result['date_time'])) . " </div>
                        </div>";
                }
            } else {
                echo "<p class='specific_chat_no-posts'>No posts yet. Be the first to post!</p>";
            }
        ?>
        </div>
    </div>

    <!-- Bootstrap JS for alert dismiss functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>