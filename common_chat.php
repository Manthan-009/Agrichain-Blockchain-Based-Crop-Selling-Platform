<?php include './db_connectivity/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Forum - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="common_chat_body">
    <?php
        if(isset($_POST['btn_post'])){
            $uid = base64_decode($_GET['uid']);
            $name = $_POST['username'];
            $msg = strval($_POST['message']);
            $error = array();
            if (empty($name)) {
                $error[0] = "User Name should be required.";
            }
            
            if (empty($msg)) {
                if (count($error) == 0) {
                    $error[0] = "Message should be required.";
                } else {
                    $error[1] = "Message should be required.";
                }
            }

            if (count($error) == 0) {
                $role_fet = "SELECT * FROM `user` WHERE u_id = $uid";
                $fr = mysqli_query($con, $role_fet);
                $role = mysqli_fetch_assoc($fr);
                $fr = $role['user_role'];

                $sql2 = "INSERT INTO `common_chat`(`u_id`,`u_name`,`u_role`,`message`) VALUES('$uid','$name','$fr','$msg')";
                $result = mysqli_query($con, $sql2);
                if (!$result) {
                    echo "<div class='alert common_chat_alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Server Error,</strong> Try again.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                }
            } else {
                for ($i = 0; $i < count($error); $i++) {
                    echo "<div class='alert common_chat_alert alert-danger alert-dismissible fade show' role='alert'>$error[$i]
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                }
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

    <div class="common_chat_containers3">
        <h1 class="common_chat_heading_chat_1">Community Chat</h1>
        <form method="post" class="common_chat_form">
            <input type="text" name="username" placeholder="Enter your name" class="common_chat_input-text">
            <textarea name="message" placeholder="Write your message..." rows="5" class="common_chat_textarea"></textarea>
            <input type="submit" name="btn_post" value="Post" class="common_chat_input-submit">
            <button name="btn_home" class="common_chat_button">Home</button>
        </form>
        
        <?php
            $sql_sele = "SELECT * FROM `common_chat`";
            $run = mysqli_query($con, $sql_sele);
            $num = mysqli_num_rows($run);
            if ($num != 0) {
                while ($result = mysqli_fetch_assoc($run)) {
                    echo "<div class='common_chat_post'>
                        <span>" . $result['u_role'] . " - " . $result['u_name'] . "</span>
                        <p>" . $result['message'] . "</p>
                        <div class='common_chat_timestamp'>" . date('F j, Y, g:i a', strtotime($result['created_at'])) . " </div>
                    </div>";
                }
            } else {
                echo "<p class='common_chat_no-posts'>No posts yet. Be the first to post!</p>";
            }
        ?>
    </div>

    <!-- Bootstrap JS for alert dismiss functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>