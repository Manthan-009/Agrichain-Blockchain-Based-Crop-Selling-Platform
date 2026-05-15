<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order Status - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #e9ecef);
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <?php include './nav.php'; ?>

    <div class="container new_update_status_containers8">
        <h2 class="new_update_status_title_update_order">Update Order Status</h2>
        <?php include './User_Profile/otp_send.php';
        $uid = base64_decode($_GET['uid'] ?? '');
        $oid = base64_decode($_GET['oid'] ?? '');
        
        if (isset($_POST['btn'])) {
            $status = $_POST['status'];
            $update = mysqli_query($con, "UPDATE order_history SET `status` = '$status' WHERE order_id = $oid");

            if ($update) {
                $email_send_data_fetch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM order_history WHERE order_id = $oid"));
                $quantity_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM order_history WHERE order_id = $oid"));
                $quantity = $quantity_query['quantity'];

                $cropname_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM crop_data WHERE crop_id = $email_send_data_fetch[crop_id]"));
                $crop_name = $cropname_query['c_type'];

                if ($email_send_data_fetch['status'] == 'Delivered') {
                    $buyer_id = $email_send_data_fetch['u_id'];
                    $fetch_email_query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE u_id = $buyer_id"));

                    $address = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM buyer_address WHERE u_id = $buyer_id"));
                    $subject = "🎉 Your Order [#$oid] Has Been Delivered! 🚚";
                    $message = "Dear " .$fetch_email_query['u_name']. ",<br/><br/> Great news! Your order #" .$oid. " has been successfully delivered to your address. We hope you're as excited as we are! 😊<br/><br/>Order Summary:<br/><strong>Order Number:</strong> #$oid<br/><strong>Delivered On:</strong> " .date('Y-m-d H:i:s'). "<br/><strong>Shipping Address:</strong> " .$address['address']. "<br/><strong>Items Delivered:</strong> $crop_name - $quantity KG <br/><br/>We had love to hear your feedback! Your thoughts help us improve and serve you better. 🌟<br/>Thank you for choosing us! We look forward to serving you again soon. 🙌<br/><br/>Warm regards,<br/>Agrichain<br/>agrichain.yourtraders@gmail.com";
                    $reciever_email = $fetch_email_query['u_mail'];
                    OTP($reciever_email, $subject, $message);
                }
                $encode_id = base64_encode($uid);
                echo "<script>window.location.href = 'http://localhost/Mini_Project/update_status.php?uid=$encode_id&w=true';</script>";
            }
        }
        
        $stmt = mysqli_query($con, "SELECT * FROM order_history WHERE order_id = $oid");
        $fetch_row = mysqli_fetch_assoc($stmt) ?? [];
        ?>

        <table class="new_update_status_table_main">
            <thead>
                <tr class="new_update_status_table_tr">
                    <th class="new_update_status_table_th">Order ID</th>
                    <th class="new_update_status_table_th">Buyer ID</th>
                    <th class="new_update_status_table_th">Farmer ID</th>
                    <th class="new_update_status_table_th">Crop ID</th>
                    <th class="new_update_status_table_th">Total Amount</th>
                    <th class="new_update_status_table_th">Quantity</th>
                    <th class="new_update_status_table_th">Current Status</th>
                    <th class="new_update_status_table_th">Update Status</th>
                    <th class="new_update_status_table_th">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="new_update_status_table_tr">
                    <td class="new_update_status_table_td"><?= htmlspecialchars($oid) ?></td>
                    <td class="new_update_status_table_td"><?= htmlspecialchars($fetch_row['u_id'] ?? '') ?></td>
                    <td class="new_update_status_table_td"><?= htmlspecialchars($fetch_row['farmer_id'] ?? '') ?></td>
                    <td class="new_update_status_table_td"><?= htmlspecialchars($fetch_row['crop_id'] ?? '') ?></td>
                    <td class="new_update_status_table_td"><?= number_format($fetch_row['total_price'] ?? 0, 2) ?> ICE</td> <!-- set number into number format like 1,500 -->
                    <td class="new_update_status_table_td"><?= htmlspecialchars($fetch_row['quantity'] ?? '') ?> KG</td>
                    <td class="new_update_status_table_td"><?= htmlspecialchars($fetch_row['status'] ?? '') ?></td>
                    <td class="new_update_status_table_td">
                        <form method="POST">
                            <select name="status" class="new_update_status_select_status">
                                <option value="In Progress" <?= ($fetch_row['status'] ?? '') === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                                <option value="Shipped" <?= ($fetch_row['status'] ?? '') === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                <option value="Out of Delivery" <?= ($fetch_row['status'] ?? '') === 'Out of Delivery' ? 'selected' : '' ?>>Out of Delivery</option>
                                <option value="Delivered" <?= ($fetch_row['status'] ?? '') === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                            </select>
                    </td>

                    <td class="new_update_status_table_td">
                            <button class="new_update_status_update_btn" name="btn">Update</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="new_update_status_accordion">
            <div class="new_update_status_accordion-item">
                <div class="new_update_status_accordion-header">
                    Order ID <?= htmlspecialchars($oid) ?> - <?= htmlspecialchars($fetch_row['status'] ?? '') ?>
                </div>
                <div class="new_update_status_accordion-content">
                    <div><span class="new_update_status_label">Order ID:</span> <?= htmlspecialchars($oid) ?></div>
                    <div><span class="new_update_status_label">Buyer ID:</span> <?= htmlspecialchars($fetch_row['u_id'] ?? '') ?></div>
                    <div><span class="new_update_status_label">Farmer ID:</span> <?= htmlspecialchars($fetch_row['farmer_id'] ?? '') ?></div>
                    <div><span class="new_update_status_label">Crop ID:</span> <?= htmlspecialchars($fetch_row['crop_id'] ?? '') ?></div>
                    <div><span class="new_update_status_label">Total Amount:</span> <?= number_format($fetch_row['total_price'] ?? 0, 2) ?> ICE</div>
                    <div><span class="new_update_status_label">Quantity:</span> <?= htmlspecialchars($fetch_row['quantity'] ?? '') ?> KG</div>
                    <div><span class="new_update_status_label">Status:</span> <?= htmlspecialchars($fetch_row['status'] ?? '') ?></div>
                    <div>
                        <form method="POST">
                            <div class='new_update_status_select_option'><span class="new_update_status_label">Update Status:</span>
                                <select name="status" class="new_update_status_select_status2">
                                    <option value="In Progress" <?= ($fetch_row['status'] ?? '') === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                                    <option value="Shipped" <?= ($fetch_row['status'] ?? '') === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                    <option value="Out of Delivery" <?= ($fetch_row['status'] ?? '') === 'Out of Delivery' ? 'selected' : '' ?>>Out of Delivery</option>
                                    <option value="Delivered" <?= ($fetch_row['status'] ?? '') === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                </select>
                            </div>
                            <button class="new_update_status_update_btn new_update_status_accordian_btn" name="btn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include './footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.new_update_status_accordion-header').forEach(header => { // selects all class list which is coming under new_update_status_accordion-header class
            header.addEventListener('click', () => {
                const content = header.nextElementSibling; //A DOM property that returns the next sibling element in the HTML
                content.classList.toggle('active'); // active and disables accordian menu
            });
        });
    </script>
</body>
</html>