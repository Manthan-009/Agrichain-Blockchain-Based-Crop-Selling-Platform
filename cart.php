<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f0f8f4, #e5f2e9);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php include './nav.php' ?>
    <?php
        if (isset($_GET['cdq'])) {
            if ($_GET['cdq'] == 'true') {
                echo "<div class='alert alert-success cart_alert_cart cart_alert-success cart_alert-dismissible cart_fade cart_show' role='alert'>
                    <p class='crop_details_alert_msg_p'><strong>Crop</strong> deleted successfully from Cart.</p>
                    <button type='button' class='cart_btn-close btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            } else {
                echo "<div class='alert alert-danger cart_alert_cart cart_alert-danger cart_alert-dismissible cart_fade cart_show' role='alert'>
                    <p class='crop_details_alert_msg_p'><strong>Crop</strong> is not deleted from Cart.</p>
                    <button type='button' class='cart_btn-close btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }

        if (isset($_GET['skp'])) {
            if ($_GET['ft'] == 'true') {
                echo "<div class='alert alert-success cart_alert_cart cart_alert-success cart_alert-dismissible cart_fade cart_show' role='alert'>
                    <p class='crop_details_alert_msg_p'><strong>Error!</strong> Data Storage.</p>
                    <button type='button' class='cart_btn-close btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    ?>

    <div class="responciveness">
        <div class="container cart_containers">
            <table class="cart_tb" border="2px solid green">
                <?php
                $id = $_GET['uid'];
                $uid = base64_decode($_GET['uid']);
                $sql_query = "SELECT * FROM `cart_data` WHERE `u_id` = $uid";
                $ramsh = mysqli_query($con, $sql_query);
                $nums = mysqli_num_rows($ramsh);
                if ($nums != 0) {
                    echo "<h1 class='cart_heading'>Cart</h1>";
                    echo "<tr class='cart_f_row'>
                            <th id='header_tables' style='width:10%;'>Sr. No.</th>
                            <th id='header_tables' style='width:10%;'>Type</th>
                            <th id='header_tables' style='width:9rem;'>Image</th>
                            <th id='header_tables' style='width:10%;'>Quantity</th>
                            <th id='header_tables' style='width:10%;'>Price</th>
                            <th id='header_tables' style='width:10%;'>Total Price</th>
                            <th id='header_tables' style=''></th>
                        </tr>";
                    $k = 1;
                    while ($data = mysqli_fetch_assoc($ramsh)) {
                        $cropid = $data['crop_id'];
                        $sql_query2 = "SELECT * FROM `crop_data` WHERE `crop_id` = $cropid";
                        $ramsh2 = mysqli_query($con, $sql_query2);
                        $fa = mysqli_fetch_assoc($ramsh2);
                        $del_id = base64_encode($data['cart_item_id']);
                        $total = 0;
                        if ($data['quantity'] <= 200) {
                            $total_persantage_price = $data['price'] * 0.20;
                            $new_total = $data['quantity'] * $total_persantage_price;
                            $total = $data['c_total'] + $new_total;
                        }else{
                            $total_persantage_price = $data['price'] * 0.10;
                            $new_total = $data['quantity'] * $total_persantage_price;
                            $total = $data['c_total'] + $new_total;
                        }
                        $update_Total = mysqli_query($con, "UPDATE cart_data SET c_total = $total WHERE cart_item_id = $data[cart_item_id]");
                        echo '
                            <tr class="cart_f_row">
                                <td>' . $k . '</td>
                                <td>' . $fa['c_type'] . '</td>
                                <td style="width:0px;"><img src="./crop_image/' . $fa['c_img'] . '" style="padding:0.1rem;"></td>
                                <td>' . $data['quantity'] . '</td>
                                <td>' . $data['price'] . '</td>
                                <td>' .$total. '</td>
                                <td><div class="cart_all_btns2">';
                                    $sql_queryq = "SELECT * FROM `buyer_address` WHERE `u_id` = $uid";
                                    $ramshs = mysqli_query($con, $sql_queryq);
                                    $numss = mysqli_num_rows($ramshs);
                                    if ($numss == 1) {
                                        echo '<a href="./buy_now.php?uid=' . $id . '&crpd=' . $del_id . '&w=true"><button type="button" class="cart_btn-success">Buy Now</button></a>';
                                    } else {
                                        echo '<a href="./add_address.php?uid=' . $id . '&crpd=' . $del_id . '&w=true"><button type="button" class="cart_btn-success">Buy Now</button></a>';
                                    }
                                    echo '<a href="./del_crop.php?uid=' . $id . '&crd=' . $del_id . '&w=true"><button type="button" class="cart_btn-danger">Remove</button></a>
                                </div></td>
                            </tr>';
                        $k++;
                    }
                } else {
                    echo "<h1 class='cart_h1_ndf'>No Data Found at this Time</h1>";
                }
                ?>
            </table>
        </div>
    </div>

    <div class="cart_responsiveness_screen">
        <?php
        $id = $_GET['uid'];
        $uid = base64_decode($_GET['uid']);
        $sql_query = "SELECT * FROM `cart_data` WHERE `u_id` = $uid";
        $ramsh = mysqli_query($con, $sql_query);
        $nums = mysqli_num_rows($ramsh);
        if ($nums != 0) {
            echo "<h1 class='cart_heading'>Cart</h1>";
            echo "<div class='cart_set_css'>";
            while ($data = mysqli_fetch_assoc($ramsh)) {
                $cropid = $data['crop_id'];
                $sql_query2 = "SELECT * FROM `crop_data` WHERE `crop_id` = $cropid";
                $ramsh2 = mysqli_query($con, $sql_query2);
                $fa = mysqli_fetch_assoc($ramsh2);
                $del_id = base64_encode($data['cart_item_id']);
                echo '<div class="cart_cart-item">
                    <img src="./crop_image/' . $fa['c_img'] . '" alt="Product Image">
                    <div class="cart_item-details">
                        <div class="cart_item-title">Type :- ' . $fa['c_type'] . '</div>
                        <div class="cart_item-price">Price :- ' . $data['price'] . ' ICE per KG</div>
                        <div class="cart_item-price">Quantity :- ' . $data['quantity'] . ' KG</div>
                        <div class="cart_item-price">Total Price :- ' . $data['c_total'] . ' ICE</div>
                    </div>
                    <div class="cart_all_btns">';
                        $sql_queryq = "SELECT * FROM `buyer_address` WHERE `u_id` = $uid";
                        $ramshs = mysqli_query($con, $sql_queryq);
                        $numss = mysqli_num_rows($ramshs);
                        if ($numss == 1) {
                            echo '<a href="./buy_now.php?uid=' . $id . '&crpd=' . $del_id . '&w=true"><button type="button" class="cart_btn-success">Buy Now</button></a>';
                        } else {
                            echo '<a href="./add_address.php?uid=' . $id . '&crpd=' . $del_id . '&w=true"><button type="button" class="cart_btn-success">Buy Now</button></a>';
                        }
                        echo '<a href="./del_crop.php?uid=' . $id . '&crd=' . $del_id . '&w=true"><button type="button" class="cart_btn-danger">Remove</button></a>
                    </div>
                </div>';
            }
            echo "</div>";
        } else {
            echo "<h1 class='cart_h1_ndf'>No Data Found at this Time</h1>";
        }
        ?>
    </div>

    <p class="crop_details_warning_msg">
        <strong>Note:</strong> Total Price is included with Shipping Charges.
    </p>

    <?php include './footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>