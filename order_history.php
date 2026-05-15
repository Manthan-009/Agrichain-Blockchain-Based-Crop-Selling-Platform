<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <title>Your Orders - Agrichain</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #e9ecef);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php include './nav.php'; ?>

    <?php
    if (isset($_GET['rating']) && isset($_GET['feedback'])) {
        if ($_GET['rating'] == 'true' && $_GET['feedback'] == 'true') {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Rating & Feedback!</strong> Thanks for giving Rating & Feedback.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }

    $user_id = base64_decode($_GET['uid']);
    $que = mysqli_query($con, "SELECT * FROM user WHERE u_id = '$user_id'");
    $que_run = mysqli_fetch_assoc($que);
    $user_type = $que_run['user_role'];
    $query = "SELECT * FROM order_history WHERE u_id = '$user_id'";
    $stmt = mysqli_query($con, $query);
    $num_row = mysqli_num_rows($stmt);
    ?>

    <div class="container order_history_containers9">
        <h2 class="order_history_h2_order">Your Orders</h2>
        <?php if ($num_row == 0) : ?>
        <div class='order_history_no_data_found'>No Order Found at this Time.</div>
        <?php else : ?>
        <table class="order_history_table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Cart Item ID</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Give Rating</th>
                    <th>Give Feedback</th>
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
                    <td><?= number_format($row['total_price'], 2); ?> ICE</td>
                    <td><?= number_format($row['quantity']); ?></td>
                    <td><?= ucfirst(htmlspecialchars($row['status'])); ?></td>
                    <td><?= date("d-M-Y", strtotime($row['order_date'])); ?></td>
                    <?php if ($row['status'] == "Delivered"): ?>
                    <td>
                        <?php if ($row['rating'] == '0.00'): ?>
                        <a href="give_feedback.php?order_id=<?= base64_encode($row['order_id']); ?>&uid=<?= base64_encode($user_id); ?>&w=true" class="order_history_btn-primary btn-sm">Give Rating</a>
                        <?php else: ?>
                        <span><?= $row['rating'] ?> Star</span>
                        <?php endif; ?>
                    </td>
                    <?php else: ?>
                    <td>Rating gives after Crop delivered</td>
                    <?php endif; ?>
                    <?php if ($row['status'] == "Delivered"): ?>
                    <td>
                        <?php if (empty($row['feedback'])): ?>
                        <a href="give_feedback.php?order_id=<?= base64_encode($row['order_id']); ?>&uid=<?= base64_encode($user_id); ?>&w=true" class="order_history_btn-primary btn-sm">Give Feedback</a>
                        <?php else: ?>
                        <span><?= $row['feedback'] ?></span>
                        <?php endif; ?>
                    </td>
                    <?php else: ?>
                    <td>Feedback gives after Crop delivered</td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Accordion Layout for Mobile -->
        <div class="order_history_accordion">
            <?php foreach ($orders as $index => $row) : ?>
            <div class="order_history_accordion-item">
                <div class="order_history_accordion-header" onclick="toggleAccordion(<?= $index ?>)">
                    Order ID <?= htmlspecialchars($row['order_id']) ?> -
                    <?= ucfirst(htmlspecialchars($row['status'])) ?>
                </div>
                <div class="order_history_accordion-content" id="accordion-<?= $index ?>">
                    <div><span class="order_history_label">Order ID:</span> <?= htmlspecialchars($row['order_id']); ?></div>
                    <div><span class="order_history_label">Cart Item ID:</span> <?= htmlspecialchars($row['cart_item_id']); ?></div>
                    <div><span class="order_history_label">Total Price:</span> <?= number_format($row['total_price'], 2); ?> ICE</div>
                    <div><span class="order_history_label">Quantity:</span> <?= number_format($row['quantity']); ?></div>
                    <div><span class="order_history_label">Status:</span> <?= ucfirst(htmlspecialchars($row['status'])); ?></div>
                    <div><span class="order_history_label">Order Date:</span> <?= date("d-M-Y", strtotime($row['order_date'])); ?>
                    </div>
                    <div class='btn_feedback_rating'><span class="order_history_label order_history_label_rat_feed">Rating:</span>
                        <?php if ($row['status'] == "Delivered"): ?>
                        <?php if ($row['rating'] == '0.00'): ?>
                        <a href="give_feedback.php?order_id=<?= base64_encode($row['order_id']); ?>&uid=<?= base64_encode($user_id); ?>&w=true" class="order_history_btn-primary btn-sm">Give Rating</a>
                        <?php else: ?>
                        <?= $row['rating'] ?> Star
                        <?php endif; ?>
                        <?php else: ?>
                        Rating gives after Crop delivered
                        <?php endif; ?>
                    </div>
                    <div class='btn_feedback_rating'><span class="order_history_label order_history_label_rat_feed">Feedback:</span>
                        <?php if ($row['status'] == "Delivered"): ?>
                        <?php if (empty($row['feedback'])): ?>
                        <a href="give_feedback.php?order_id=<?= base64_encode($row['order_id']); ?>&uid=<?= base64_encode($user_id); ?>&w=true" class="order_history_btn-primary btn-sm">Give Feedback</a>
                        <?php else: ?>
                        <?= $row['feedback'] ?>
                        <?php endif; ?>
                        <?php else: ?>
                        Feedback gives after Crop delivered
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <?php include './footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
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