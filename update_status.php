<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <title>Orders - Agrichain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(145deg, #e6f0fa 0%, #f0f7e6 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }
    
        .update_status_no_data_found {
            text-align: center;
            font-size: clamp(1rem, 2.5vw + 0.5rem, 1.8rem);
            font-weight: 700;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: #fff;
            border: 2px solid #c0392b;
            border-radius: 12px;
            padding: clamp(10px, 2vw + 5px, 20px);
            margin: 0 auto;
            max-width: clamp(300px, 80vw, 600px);
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.5s ease-in-out;
            width: 100%;
        }
    
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
        
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <?php include './nav.php'; ?>

    <?php
    if (!isset($con)) {
        $con = mysqli_connect("localhost", "username", "password", "database_name");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    $user_id = base64_decode($_GET['uid']);
    $query = "SELECT * FROM order_history WHERE `farmer_id` = '$user_id'";
    $stmt = mysqli_query($con, $query);
    $num_row = mysqli_num_rows($stmt);
    ?>

    <div class="container update_status_containers11">
        <h2 class="update_status_heading_orders">Orders</h2>
        <?php if ($num_row == 0) : ?>
        <div class='update_status_no_data_found'>No Order Found at this Time.</div>
        <?php else : ?>
        <table class="update_status_table_update_status table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Cart Item ID</th>
                    <th>Buyer ID</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Your Rating</th>
                    <th>Your Feedback</th>
                    <th>Update Data</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $orders = [];
                    while ($row = mysqli_fetch_assoc($stmt)) : 
                        $orders[] = $row;
                    ?>
                <tr>
                    <td><?= htmlspecialchars($row['order_id']); ?></td>
                    <td><?= htmlspecialchars($row['cart_item_id']); ?></td>
                    <td><?= htmlspecialchars($row['u_id']); ?></td>
                    <td style="width:9%;"><?= number_format($row['total_price'], 2); ?> ICE</td>
                    <td style="width:1%;"><?= number_format($row['quantity']); ?></td>
                    <td><?= ucfirst(htmlspecialchars($row['status'])); ?></td>
                    <td><?= date("d-M-Y", strtotime($row['order_date'])); ?></td>
                    <?php if ($row['status'] == "Delivered"): ?>
                    <td style="width:15%;">
                        <?= !empty($row['rating']) && $row['rating'] != '0.00' ? htmlspecialchars($row['rating']) . " Star" : 'No rating Yet'; ?>
                    </td>
                    <?php else: ?>
                    <td>Rating shows after Crop delivered</td>
                    <?php endif; ?>
                    <?php if ($row['status'] == "Delivered"): ?>
                    <td style="width:15%;">
                        <?= !empty($row['feedback']) ? htmlspecialchars($row['feedback']) : 'No feedback Yet'; ?>
                    </td>
                    <?php else: ?>
                    <td>Feedback shows after Crop delivered</td>
                    <?php endif; ?>
                    <?php if ($row['status'] == "Delivered"): ?>
                    <td>You don't need to Update.</td>
                    <?php else: ?>
                    <td><a class="btn update_status_btn_success_update update_status_btns_update n_btn"
                            href="./new_update_status.php?uid=<?= base64_encode($user_id) ?>&oid=<?= base64_encode($row['order_id']) ?>&w=true">Update</a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Accordion Layout for Mobile -->
        <div class="update_status_accordion">
            <?php foreach ($orders as $index => $row) : ?>
            <div class="update_status_accordion-item">
                <div class="update_status_accordion-header" onclick="toggleAccordion(<?= $index ?>)">
                    Order ID <?= htmlspecialchars($row['order_id']) ?> -
                    <?= ucfirst(htmlspecialchars($row['status'])) ?>
                </div>
                <div class="update_status_accordion-content" id="accordion-<?= $index ?>">
                    <div><span class="update_status_label">Order ID:</span> <?= htmlspecialchars($row['order_id']); ?>
                    </div>
                    <div><span class="update_status_label">Cart Item ID:</span>
                        <?= htmlspecialchars($row['cart_item_id']); ?></div>
                    <div><span class="update_status_label">Buyer ID:</span> <?= htmlspecialchars($row['u_id']); ?></div>
                    <div><span class="update_status_label">Total Price:</span>
                        <?= number_format($row['total_price'], 2); ?> ICE</div>
                    <div><span class="update_status_label">Quantity:</span> <?= number_format($row['quantity']); ?>
                    </div>
                    <div><span class="update_status_label">Status:</span>
                        <?= ucfirst(htmlspecialchars($row['status'])); ?></div>
                    <div><span class="update_status_label">Order Date:</span>
                        <?= date("d-M-Y", strtotime($row['order_date'])); ?></div>
                    <div><span class="update_status_label">Rating:</span>
                        <?php if ($row['status'] == "Delivered"): ?>
                        <?= !empty($row['rating']) && $row['rating'] != '0.00' ? htmlspecialchars($row['rating']) . " Star" : 'No rating Yet'; ?>
                        <?php else: ?>
                        Rating shows after Crop delivered
                        <?php endif; ?>
                    </div>
                    <div><span class="update_status_label update_status_feedback">Feedback:</span>
                        <?php if ($row['status'] == "Delivered"): ?>
                        <?= !empty($row['feedback']) ? htmlspecialchars($row['feedback']) : 'No feedback Yet'; ?>
                        <?php else: ?>
                        Feedback shows after Crop delivered
                        <?php endif; ?>
                    </div>
                    <div><span class="update_status_label">Update:</span>
                        <?php if ($row['status'] == "Delivered"): ?>
                        You don't need to Update.
                        <?php else: ?>
                        <a class="btn update_status_btn_success_update update_status_btns_update"
                            href="./new_update_status.php?uid=<?= base64_encode($user_id) ?>&oid=<?= base64_encode($row['order_id']) ?>&w=true">Update</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <?php include './footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function toggleAccordion(index) {
        const content = document.getElementById(`accordion-${index}`);
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    }
    </script>
</body>

</html>