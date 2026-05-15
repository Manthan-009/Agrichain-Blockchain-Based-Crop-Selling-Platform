<?php include './db_connectivity/db.php'; ?>
<!DOCTYPE html>
<html lang="en" class="footer_html">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Footer - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>

<body class="footer_body">
    <footer>
        <div class="footer_main">
            <div class="container footer_containers5">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer_section footer_top-box">
                            <h3 class="footer_section-h3">Social Media</h3>
                            <p class="footer_section-p">Connect with us on social media to stay updated on the latest in agriculture and supply chain solutions.</p>
                            <ul class="footer_top-box-ul">
                                <li class="footer_section-ul-li"><a class="footer_top-box-ul-li-a" href="https://www.facebook“Have you tried turning it off and on again?” Try refreshing or checking back later.com/AgriChainAU"><iconify-icon class="footer_top-box-ul-li-a-iconify-icon" icon="devicon:facebook" width="1.9rem" height="2rem"></iconify-icon></a></li>
                                <li class="footer_section-ul-li"><a class="footer_top-box-ul-li-a" href="https://x.com/agrichaintech"><iconify-icon class="footer_top-box-ul-li-a-iconify-icon" icon="skill-icons:twitter" width="1.9rem" height="2rem"></iconify-icon></a></li>
                                <li class="footer_section-ul-li"><a class="footer_top-box-ul-li-a" href="https://www.linkedin.com/feed/?trk=guest_homepage-basic_google-one-tap-submit"><iconify-icon class="footer_top-box-ul-li-a-iconify-icon" icon="devicon:linkedin" width="1.9rem" height="2rem"></iconify-icon></a></li>
                                <li class="footer_section-ul-li"><a class="footer_top-box-ul-li-a" href="https://wa.me/+919638063997?text=Hi%2C+I%27m+interested+in+learning+more"><iconify-icon class="footer_top-box-ul-li-a-iconify-icon" icon="uil:whatsapp-alt" width="1.9rem" height="2rem" style="color: #4FCE5D"></iconify-icon></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer_section footer_link">
                            <h4 class="footer_section-h4">Information</h4>
                            <ul class="footer_section-ul">
                                <?php
                                if (isset($_SESSION['logedin'])) {
                                    $id = $_GET['uid'];
                                    $idea = base64_decode($id);
                                    $sql = "SELECT * FROM `user` WHERE u_id = $idea";
                                    $run = mysqli_query($con, $sql);
                                    $row = mysqli_fetch_assoc($run);
                                    if (isset($_GET['w'])) {
                                        $wallet_add = $_GET['w'];
                                            echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./index.php?uid=$id&w=$wallet_add'>Home</a></li>
                                            <li class='nav-item footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./about.php?uid=$id&w=$wallet_add'>About</a></li>
                                            <li class='nav-item footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./contact-us.php?uid=$id&w=$wallet_add'>Contact Us</a></li>";
                                            if ($row['user_role'] == 'Farmer') {
                                                echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./add_data_farmer.php?uid=$id&w=$wallet_add'>Add Crop</a></li>";
                                                echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./update_crop_details.php?uid=$id&w=$wallet_add'>Update Crop</a></li>";
                                                echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./update_status.php?uid=$id&w=$wallet_add'>Update Status</a></li>";
                                            } else {
                                                echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./order_history.php?uid=$id&w=$wallet_add'>Your Orders</a></li>";
                                            }
                                            echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./transaction_history.php?uid=$id&w=$wallet_add'>Transaction History</a></li>";
                                            echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./education.php?uid=$id&w=$wallet_add'>Education Content</a></li>";
                                            echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./analitical_data.php?uid=$id&w=$wallet_add'>Analytical Data</a></li>";
                                    } else {
                                        echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./index.php?uid=$id'>Home</a></li>
                                        <li class='nav-item footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./about.php?uid=$id'>About</a></li>
                                        <li class='nav-item footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./contact-us.php?uid=$id'>Contact Us</a></li>";
                                        if ($row['user_role'] == 'Farmer') {
                                            echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./add_data_farmer.php?uid=$id'>Add Crop</a></li>";
                                            echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./update_crop_details.php?uid=$id'>Update Crop</a></li>";
                                            echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./update_status.php?uid=$id'>Update Status</a></li>";
                                        } else {
                                            echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./order_history.php?uid=$id'>Your Orders</a></li>";
                                        }
                                        echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./transaction_history.php?uid=$id'>Transaction History</a></li>";
                                        echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./education.php?uid=$id'>Education Content</a></li>";
                                        echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./analitical_data.php?uid=$id'>Analytical Data</a></li>";
                                    }
                                } else {
                                    echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./index.php'>Home</a></li>
                                    <li class='nav-item footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./about.php'>About</a></li>
                                    <li class='nav-item footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./contact-us.php'>Contact Us</a></li>";
                                    echo "<li class='nav-item active footer_section-ul-li'><a class='nav-link footer_section-ul-li-a' href='./education.php'>Education Content</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12" style="margin: 0 auto;">
                        <div class="footer_section footer_link-contact">
                            <h4 class="footer_section-h4">Contact Us</h4>
                            <ul class="footer_link-contact-ul">
                                <li class="footer_link-contact-ul-li">
                                    <p class="footer_link-contact-ul-li-p"><iconify-icon icon="fxemoji:envelope" height="1.5em" width="1.5em"></iconify-icon>Email: <a class="footer_link-contact-ul-li-p-a" href="mailto:darshilpatel@gmail.com">manthanbeladiya2468@gmail.com</a></p>
                                </li>
                                <li class="footer_link-contact-ul-li">
                                    <p class="footer_link-contact-ul-li-p"><iconify-icon icon="ph:phone-duotone" height="1.5em" width="1.5em"></iconify-icon>Phone: <a class="footer_link-contact-ul-li-p-a" href="tel:+919638063997">+917990146809</a></p>
                                </li>
                                <li class="footer_link-contact-ul-li">
                                    <p class="footer_link-contact-ul-li-p footer_link-contact-ul-li-address_part"><iconify-icon icon="tabler:address-book" height="1.5em" width="1.5em"></iconify-icon>Address: GLS University, GLS Campus, Opp. Law Garden, Ellisbridge, Ahmedabad, 380006 </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_copyright">
            <p class="footer_copyright-p">All Rights Reserved. © 2024 Agrichain Design By : Mahadev Developers</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@2.1.0/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>