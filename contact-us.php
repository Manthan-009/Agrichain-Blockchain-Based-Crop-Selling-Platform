<?php include './db_connectivity/db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="./style.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        font-size: 16px;
        line-height: 1.6;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(160deg, #e8eaf6 0%, #fffde7 100%);
        overflow-x: hidden;
        color: #2d3e2f;
    }
    </style>
</head>

<body>
    <?php include './nav.php'; ?>

    <!-- Start Contact Title Section -->
    <div class="contact-us-title-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 mx-auto">
                    <h2 class="contact-us-heading">Contact Us</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Title Section -->

    <?php
    if (isset($_POST['btn_message'])) {
        $user_id = base64_decode($_GET['uid'] ?? '');
        $uname = trim($_POST['name'] ?? '');//remove white space using trim
        $usubject = trim($_POST['subject'] ?? '');
        $umsg = trim($_POST['message'] ?? '');

        $error = array();

        // Check if fields are empty
        if (empty($uname)) {
            $error[] = "Name is required.";
        } elseif (!preg_match_all("/^[A-Za-z ]+$/", $uname)) {
            $error[] = "Name must only contain letters and whitespace.";
        }

        if (empty($usubject)) {
            $error[] = "Subject is required.";
        } elseif (!(strlen($usubject) > 5 && strlen($usubject) < 100)) {
            $error[] = "Subject must be between 5 and 100 characters.";
        }

        if (empty($umsg)) {
            $error[] = "Message is required.";
        } elseif (!(strlen($umsg) > 20 && strlen($umsg) < 1000)) {
            $error[] = "Message must be between 20 and 1000 characters.";
        }

        if (empty($user_id)) {
            $error[] = "User ID is missing.";
        }

        if (count($error) == 0) {
            // fetch user role
            $fetch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `user` WHERE u_id = $user_id"));
            
            if ($fetch) {
                $umail = $fetch['u_mail'];
                $urole = $fetch['user_role'];

                $success = mysqli_query($con, "INSERT INTO `contact_us`(`u_id`, `u_name`, `u_mail`, `u_subject`, `u_message`, `u_role`) VALUES ('$user_id', '$uname', '$umail', '$usubject', '$umsg', '$urole')");
                
                if ($success) {
                    echo "<div class='alert contact-us-alert-success alert-dismissible fade show' role='alert'>
                            Message is Sent Successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } else {
                    $error[] = "Failed to send message. Please try again later.";
                }
            } else {
                $error[] = "Invalid user ID.";
            }
        }

        if (count($error) > 0) {
            foreach ($error as $err) {
                echo "<div class='alert contact-us-alert-danger alert-dismissible fade show' role='alert'>
                        $err <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
    }
    ?>

    <!-- Start Contact Us Section -->
    <div class="contact-us-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-us-form">
                        <h2>GET IN <span>TOUCH</span></h2>
                        <p>We'd love to hear from you! Whether you have questions, feedback, or need assistance, feel free to get in touch. Fill out the form below, and we'll get back to you as soon as possible.</p>
                        <form id="contactForm" method="POST">
                            <div class="contact-us-form-row d-flex flex-wrap gap-3">
                                <div class="col-md-12 contact-us-form-input">
                                    <div class="contact-us-form-group">
                                        <input type="text" class="contact-us-input" id="name" name="name" placeholder="Your Name" title="Name must only contain letters and whitespace">
                                        <div class="contact-us-help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 contact-us-form-input">
                                    <div class="contact-us-form-group">
                                        <input type="text" class="contact-us-input" id="subject" name="subject" placeholder="Subject" minlength="5" maxlength="100" title="Subject must be between 5 and 100 characters">
                                        <div class="contact-us-help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 contact-us-form-input">
                                    <div class="contact-us-form-group">
                                        <textarea class="contact-us-textarea" id="message" name="message" placeholder="Your Message" rows="4" minlength="20" maxlength="1000" title="Message must be between 20 and 1000 characters"></textarea>
                                        <div class="contact-us-help-block"></div>
                                    </div>
                                    <div class="contact-us-submit text-center contact-us-form-input">
                                        <button class="contact-us-submit-btn" id="submit" name="btn_message" type="submit">Send Message</button>
                                        <div id="msgSubmit" class="contact-us-message hidden"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="contact-us-info">
                        <h2>CONTACT <span>INFO</span></h2>
                        <p>We are here to assist you with any inquiries, collaborations, or feedback. Whether you're looking for more information about our services, need help with a project, or just want to connect, we'd love to hear from you.</p>
                        <ul class="list-unstyled">
                            <li class="contact-us-item-address">
                                <p class="contact-us-item-text">
                                    <iconify-icon icon="tabler:address-book" height="1.5em" width="1.5em">
                                    </iconify-icon>
                                    <strong>Address:</strong> GLS University, GLS Campus, Opp. Law Garden, Ellisbridge, Ahmedabad, 380006
                                </p>
                            </li>
                            <li class="contact-us-item-phone">
                                <p class="contact-us-item-text-phone">
                                    <iconify-icon icon="ph:phone-duotone" height="1.5em" width="1.5em"></iconify-icon>
                                    <strong>Phone:</strong> <a href="tel:+919638063997">+919638063997</a>
                                </p>
                            </li>
                            <li class="contact-us-item-email">
                                <p class="contact-us-item-text-email">
                                    <iconify-icon icon="fxemoji:envelope" height="1.5em" width="1.5em"></iconify-icon>
                                    <strong>Email:</strong> <a href="mailto:darshilpatel@gmail.com">darshilpatel@gmail.com</a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Us Section -->

    <?php include './footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>