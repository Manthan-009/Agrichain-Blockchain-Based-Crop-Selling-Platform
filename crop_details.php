<?php 
include './db_connectivity/db.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crop - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Verdana', sans-serif;
            background: #FFFDE7;
            color: #4A2C0F; 
            line-height: 1.6;
        }
        .unavilable{
            color:rgb(255, 0, 0);
        }
    </style>
</head>

<body>
    <?php include './nav.php'; ?>

    <!-- Start All Title Box -->
    <div class="crop_details_all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Crop Detail</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    
    <!-- Start Shop Detail -->
    <?php
        $usid = base64_decode($_GET['uid']);
        $sql2 = "SELECT * FROM `user` WHERE u_id = $usid";
        $query2 = mysqli_query($con, $sql2);
        $sname2 = mysqli_fetch_assoc($query2);

        $is_avil_wallet = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `wallet_addresses` WHERE `u_id` = $usid"));
        
        if (isset($_POST['btn'])) {
            $cid = base64_decode($_GET['cid']);
            $quantity = 0;
            if (!isset($_POST['quantity']) || empty($_POST['quantity'])) {
                $quantity = 10;
            } else {
                $quantity = $_POST['quantity'];
            }
            $sel_id = $sname2['u_id'];

            $c_que = "SELECT * FROM `crop_data` WHERE crop_id = $cid";
            $c_fire = mysqli_query($con, $c_que);
            $fd = mysqli_fetch_assoc($c_fire);
            $price = $fd['c_price'];

            $total = $price * $quantity;

            $sql = "INSERT INTO `cart_data`(`u_id`,`crop_id`,`quantity`,`price`,`c_total`) VALUES('$usid','$cid','$quantity','$price',$total)";
            $res = mysqli_query($con, $sql);

            if ($res) {
                $update = "UPDATE `crop_data` SET `c_quantity` = `c_quantity` - $quantity WHERE `crop_id` = $cid";
                $update_result = mysqli_query($con, $update);
            }
                
            if ($res) {
                echo "<div class='alert alert-success crop_details_alert_crop_detail crop_details_alert-success crop_details_alert-dismissible crop_details_fade crop_details_show' role='alert'>
                        <p class='crop_details_alert_msg_p'><strong>Cart</strong> added successful into Cart.</p>
                        <button type='button' class='crop_details_btn-close btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            } else {
                echo "<div class='alert alert-danger crop_details_alert_crop_detail crop_details_alert-danger crop_details_alert-dismissible crop_details_fade crop_details_show' role='alert'>
                        <p class='crop_details_alert_msg_p'><strong>Cart</strong> does not added into Cart.</p>
                        <button type='button' class='crop_details_btn-close btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
    ?>
    <div class="crop_details_note crop_details_info">If you don't enter the quantity then by default take 10KG Crop.🌾</div>

    <div class="crop_details_shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="crop_details_single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <?php
                                    $cid = base64_decode($_GET['cid']);
                                    $sql = "SELECT * FROM `crop_data` WHERE crop_id = $cid";
                                    $res = mysqli_query($con, $sql);
                                    $fetch = mysqli_fetch_assoc($res);
                                    echo "<img class='d-block w-100 crop_details_crop_img' src='./crop_image/" . $fetch['c_img'] . "' alt='Crop Image'>";?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="crop_details_single-product-details">
                        <?php echo "<h2>" . $fetch['c_type'] . "</h2>
                                <h5>" . $fetch['c_price'] . " ICE per KG</h5>
                                <p class='crop_details_available-stock'><span></span><p>
                                <h4>About the Crop:</h4>
                                <p>" . $fetch['c_description'] . "</p>";
                                if ($fetch['c_quantity'] > 0) {
                                    echo "<h5><span style='color:#4A2C0F;'>Available Quantity:</span> " . $fetch['c_quantity'] . " KG</h5>";
                                }else{
                                    echo "<h5><span style='color:#4A2C0F;'>Available Quantity:</span><span class='unavilable'>Currently not Available.</span></h5>";
                                }
                                echo "<h5><span style='color:#4A2C0F;'>Farmer Name:</span> " . $sname2['u_name'] . "</h5>";?>
                        <ul>
                            <li>
                                <div class="crop_details_quantity-box">
                                    <form method="POST">
                                        <div class="crop_details_form_input">
                                            <label class="crop_details_control-label">Quantity:- </label>
                                            <input class="crop_details_form_field2" placeholder="0 KG" name="quantity" type="number" min="1">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <p class="crop_details_warning_msg">
                                <strong>Note:</strong> Shipping charges of 20% ICE per KG will be added at checkout based on your order weight.If your Order is more than 200KG then shipping charges will be 10% ICE per KG.
                            </p>
                            <div class="crop_details_price-box-bar">
                                <div class="crop_details_cart-and-bay-btn">
                                    <?php if (!isset($_GET['r'])) { ?>
                                        <?php if ($is_avil_wallet != 0 && $fetch['c_quantity'] != 0) { ?>
                                            <button name="btn" class="crop_details_btn_cart">
                                                <span>Add to Cart</span>
                                            </button>
                                        <?php } else if ($fetch['c_quantity'] == 0) { ?>
                                            <p class="crop_details_warning_msg"><strong>Sorry!</strong>, You cannot buy crop because it is out of stock.</p>
                                        <?php } else { ?>
                                            <p class="crop_details_warning_msg"><strong>Sorry!</strong>, You cannot buy crop without wallet address, so please add wallet address.</p>
                                        <?php } ?>
                                    <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

    <?php include './footer.php'; ?>
</body>
</html>