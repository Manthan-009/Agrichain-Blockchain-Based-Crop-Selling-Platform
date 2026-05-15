<?php session_start();?>
<!DOCTYPE html>
<html lang="en" class="give_feedback_html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating & Feedback - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
</head>

<body class="give_feedback_body">
    <?php include './nav.php'; ?>

    <div class="give_feedback_body">
        <div class="container give_feedback_containers6">
            <h1 class="give_feedback_h1_heading">Rating & Feedback Form</h1>
            <p class="give_feedback_p_heading">How would you rate your experience for Order ID <?php 
                $oid = base64_decode($_GET['order_id']);
                $uid = base64_decode($_GET['uid']);
                $query = "SELECT * FROM order_history WHERE order_id = '$oid'";
                $stmt = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($stmt);
                echo $row['order_id'];
            ?>?</p>

            <form action="" method="post">
                <div class="give_feedback_star-rating">
                    <input type="radio" id="5-stars" name="rating" value="5" />
                    <label for="5-stars">★</label>
                    <input type="radio" id="4-stars" name="rating" value="4" />
                    <label for="4-stars">★</label>
                    <input type="radio" id="3-stars" name="rating" value="3" />
                    <label for="3-stars">★</label>
                    <input type="radio" id="2-stars" name="rating" value="2" />
                    <label for="2-stars">★</label>
                    <input type="radio" id="1-stars" name="rating" value="1" />
                    <label for="1-stars">★</label>
                </div>

                <textarea name="feedback" class="give_feedback_text_area_data" placeholder="Leave your feedback here..."></textarea>

                <input type="submit" class="give_feedback_submit-btn" name="submit" value="Submit Feedback">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $rating = $_POST['rating'];
                $feedback = $_POST['feedback'];
                $error = array();

                if (!$rating) {
                    $error[] = "Please provide a rating.";
                }
                if (!$feedback) {
                    $error[] = "Please provide a feedback.";
                }

                if (empty($error)) {
                    $query = "UPDATE order_history SET rating = '$rating', feedback = '$feedback' WHERE order_id = '$oid'";
                    $stmt = mysqli_query($con, $query);

                    if ($stmt) {
                        echo "<script type='text/javascript'>
                        window.location.href = 'http://localhost/Mini_Project/order_history.php?uid=".base64_encode($uid)."&w=true&rating=true';
                        </script>";
                    } else {
                        echo "<p>Failed to submit feedback. Please try again.</p>";
                    }
                } else {
                    foreach ($error as $err) {
                        echo "<p class='give_feedback_feedback-message'>$err</p>";
                    }
                }
            }
            ?>
        </div>
    </div>

    <?php include './footer.php'; ?>
</body>
</html>