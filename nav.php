<?php include './db_connectivity/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Agrichain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7e6 0%, #e6f0fa 100%);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        #templatemo_nav_top {
            padding: 0.5% 0;
            background: linear-gradient(90deg, rgba(16, 61, 16, 1), rgba(16, 61, 16, 1));
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .heading_uname {
            margin: 0 auto;
            font-size: 1rem;
            font-weight: 600;
            color: #ecf0f1;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }
        .main-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .navbar {
            padding: 0.75rem 0;
            background: linear-gradient(45deg, #f7f9fb, #ffffff);
        }
        .containersts { max-width: 1400px; }
        .logo {
            width: 70%;
            max-width: 110px;
            transition: transform 0.3s ease;
        }
        .logo:hover { transform: rotate(10deg) scale(1.1); }
        .navbar-brand.logoimg {
            display: flex;
            align-items: center;
        }
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }
        .navbar-toggler:hover {
            transform: rotate(90deg);
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
        }
        .navbar-nav.mahakal {
            width: 40vw;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            gap: 20px;
        }
        .nav-link.all_nav_btn.raja {
            font-weight: 700;
            font-size: 1.1rem;
            color: #2d552d;
            padding: 10px 15px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .nav-link.all_nav_btn.raja:hover {
            color: #4CAF50;
            transform: scale(1.1);
            background: rgba(76, 175, 80, 0.1);
            border-radius: 5px;
        }
        .dropdown { position: relative; }
        .dropdown-menu {
            display: none;
            position: absolute;
            background: linear-gradient(145deg, #2ecc71, #27ae60);
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            min-width: 220px;
            top: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
        }
        .dropdown-menu li {
            list-style: none;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dropdown-menu li:last-child { border-bottom: none; }
        .dropdown-menu a {
            display: block;
            padding: 12px 20px;
            color: black;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            background: linear-gradient(to right, transparent, transparent);
        }
        .dropdown-menu a:hover {
            color: #fff;
            width: 100%;
            background: linear-gradient(to right, rgba(9, 96, 8, 0.2), transparent);
            scale: 1.05;
        }
        .main_icos_data {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        .main_icos_data iconify-icon {
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        .main_icos_data iconify-icon:hover {
            color: #4CAF50;
            transform: scale(1.2) rotate(15deg);
        }
        .raja { width: max-content; }
        @media (max-width: 1299px) and (min-width: 991px) {
            .navbar-nav.mahakal { width: 50vw; }
            .containersts { width: 80%; }
            .logo {
                width: 18%;
                max-width: 50%;
            }
        }
        @media (max-width: 991px) {
            .navbar-collapse {
                padding: 15px;
                text-align: center;
            }
            .navbar-nav.mahakal {
                width: 100%;
                flex-direction: column;
                gap: 15px;
                justify-content: center;
                align-items: center;
            }
            .nav-item {
                width: 100%;
                display: flex;
                justify-content: center;
            }
            .dropdown-menu {
                position: static;
                width: 80%;
                margin: 10px auto;
                transform: none;
                background: linear-gradient(145deg, #2ecc71, #27ae60);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }
            .dropdown:hover .dropdown-menu { position: static; }
            .main_icos_data {
                flex-direction: row;
                gap: 20px;
                justify-content: center;
                margin-top: 15px;
            }
            .logo {
                width: 15%;
                max-width: 40%;
            }
            .nav-link.all_nav_btn.raja {
                font-size: 1rem;
                padding: 8px 0;
            }
        }
        @media (max-width: 767px) {
            #templatemo_nav_top { padding: 0.5% 0; }
            .heading_uname { font-size: 1rem; }
            .logo { width: 12%; }
            .containersts .navbar-brand {
                width: 82%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .navbar-nav.mahakal { padding: 10px 0; }
            .main_icos_data { gap: 15px; }
        }
        @media (max-width: 449px) {
            .logo {
                width: 50%;
                max-width: 60px;
                margin: 2%;
            }
            .containersts .navbar-brand {
                width: 70%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .heading_uname { font-size: 0.9rem; }
            .navbar-nav.mahakal { gap: 10px; }
            .dropdown-menu { width: 90%; }
            .dropdown {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
            }
            .dropdown-menu a {
                padding: 8px;
                font-size: 0.9rem;
            }
            .main_icos_data iconify-icon { font-size: 1.3rem; }
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['w'])) {
        echo "";
    } else {
        session_destroy();
        if (!isset($_GET['reloaded'])) {
            $currentUrl = $_SERVER['PHP_SELF']; // Capture base url of the current page like index.php/nav.php
            $queryString = $_SERVER['QUERY_STRING'];// preserve the parameter of existing query like uid
            echo "<script>window.location.href = '$currentUrl?$queryString&reloaded=true';</script>";
            exit();
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg bg-dark navbar-light new_data" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div class="heading_uname">
                    <?php echo isset($_SESSION['username']) ? "Welcome!, " . $_SESSION['username'] : "Please Login First"; ?>
                </div>
            </div>
        </div>
    </nav>

    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container containersts">
                <?php
                if (isset($_SESSION['logedin'])) {
                    $id = $_GET['uid'];
                    $idea = base64_decode($id);
                    $sql = "SELECT * FROM `user` WHERE `u_id` = $idea";
                    $run = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($run);
                    if (isset($_GET['w'])) {
                        if ($_GET['w'] == "true") {
                            echo "<a class='navbar-brand logoimg' href='index.php?uid=$id&w=true'><img src='./Images/images/logo.png' class='logo' alt=''></a>";
                        } else {
                            echo "<a class='navbar-brand logoimg' href='index.php?uid=$id&w=false'><img src='./Images/images/logo.png' class='logo' alt=''></a>";
                        }
                    } else {
                        echo "<a class='navbar-brand logoimg' href='index.php?uid=$id'><img src='./Images/images/logo.png' class='logo' alt=''></a>";
                    }
                } else {
                    echo "<a class='navbar-brand logoimg' href='index.php'><img src='./Images/images/logo.png' class='logo' alt=''></a>";
                }
                ?>

                <button class="navbar-toggler navrang" type="button" style="margin: 0px;" data-bs-toggle="collapse"
                    data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="navbar-nav ms-auto mahakal">
                        <?php
                        $loggedIn = isset($_SESSION['logedin']);
                        $userId = $loggedIn ? $_GET['uid'] : null;
                        $decodedId = $loggedIn ? base64_decode($userId) : null;
                        $walletStatus = isset($_GET['w']) ? $_GET['w'] : 'false';

                        if ($loggedIn) {
                            $userQuery = "SELECT * FROM `user` WHERE u_id = $decodedId";
                            $userResult = mysqli_query($con, $userQuery);
                            $userData = mysqli_fetch_assoc($userResult);
                            $userRole = $userData['user_role'];
                        }

                        $pages = ["Home" => "index.php", "About" => "about.php", "Contact Us" => "contact-us.php"];
                        foreach ($pages as $name => $link) {
                            echo "<li class='nav-item'><a class='nav-link all_nav_btn raja' href='{$link}?uid=$userId&w=$walletStatus'>$name</a></li>";
                        }

                        if ($loggedIn) {
                            echo "<li class='nav-item dropdown'>
                                    <a class='nav-link dropdown-toggle all_nav_btn raja' href='#' id='chatDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                        Chat
                                    </a>
                                    <ul class='dropdown-menu' aria-labelledby='chatDropdown'>
                                        <li><a class='dropdown-item all_nav_btn raja' href='./common_chat.php?uid=$userId&w=$walletStatus'>Common Forum</a></li>";

                            if ($userRole === 'Farmer') {
                                echo "<li><a class='dropdown-item all_nav_btn raja' href='./chat_farmer_buyer.php?uid=$userId&w=$walletStatus'>Farmer Chat</a></li>";
                            } else {
                                echo "<li><a class='dropdown-item all_nav_btn raja' href='./chat_farmer_buyer.php?uid=$userId&w=$walletStatus'>Buyer Chat</a></li>";
                            }

                            echo "</ul></li>";
                        }

                        if ($loggedIn) {
                            $walletQuery = "SELECT * FROM `wallet_addresses` WHERE `u_id` = $decodedId";
                            $walletResult = mysqli_query($con, $walletQuery);
                            $hasWallet = mysqli_num_rows($walletResult) > 0;

                            if ($hasWallet) {
                                $walletData = mysqli_fetch_assoc($walletResult);
                                $walletAddress = $walletData['wallet_address'];
                                $shortAddress = substr($walletAddress, 0, 4) . '...' . substr($walletAddress, -4);
                                echo "<li class='nav-item'><a class='nav-link all_nav_btn raja' href='connect_wallet.php?uid=$userId&w=$walletStatus'>$shortAddress</a></li>";
                            } else {
                                echo "<li class='nav-item'><a class='nav-link all_nav_btn raja' href='connect_wallet.php?uid=$userId&w=$walletStatus'>Connect Wallet</a></li>";
                            }

                            echo "<div class='main_icos_data'>";
                            if ($userRole === 'Buyer') {
                                echo "<li class='nav-item'><a href='./cart.php?uid=$userId&w=$walletStatus'><iconify-icon icon='mynaui:cart-solid' class='raja'></iconify-icon></a></li>";
                            }

                            echo "<li class='nav-item'><a class='nav-link' href='./User_Profile/logout.php'><iconify-icon icon='majesticons:logout' class='raja'></iconify-icon></a></li>";
                        } else {
                            echo "<li class='nav-item'><a class='nav-link' href='./User_Profile/login.php'><iconify-icon icon='si:user-fill' class='raja'></iconify-icon></a></li>";
                        }
                        echo "</div>";
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"> </script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>