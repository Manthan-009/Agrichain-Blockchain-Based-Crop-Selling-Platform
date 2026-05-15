<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Transaction History - Agrichain</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <style>
       body {
           font-family: 'Poppins', Arial, sans-serif;
           background: linear-gradient(135deg, #f0f7e6 0%, #e6f0fa 100%);
           margin: 0;
           padding: 0;
           min-height: 100vh;
           overflow-x: hidden;
       }
    
       .transaction_history_no_data_found {
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

    <div class="container transaction_history_containers10">
        <?php
            $id = base64_decode($_GET['uid']);
            $uid = $_GET['uid'];
            $fetch_far = mysqli_query($con, "SELECT * FROM `user` WHERE `u_id` = $id");
            $fetch_far_data = mysqli_fetch_assoc($fetch_far);
            
            $role = $fetch_far_data['user_role'];
            $column = ($role == "Buyer") ? "buyer_id" : "farmer_id";
            $fetch_order = mysqli_query($con, "SELECT * FROM `transactions` WHERE `$column` = $id");
            
            if (mysqli_num_rows($fetch_order) > 0) {
                echo "<h2 class='transaction_history_title_transaction'>Crop Transaction History</h2>
                <table class='transaction_history_table_transaction'>
                <tr class='transaction_history_tr_transaction'>
                    <th class='transaction_history_th_transaction'>Transaction ID</th>
                    <th class='transaction_history_th_transaction'>Crop Name</th>
                    <th class='transaction_history_th_transaction'>Quantity</th>
                    <th class='transaction_history_th_transaction'>Total Amount</th>
                    <th class='transaction_history_th_transaction'>" . ($role == "Buyer" ? "Farmer" : "Buyer") . "</th>
                    <th class='transaction_history_th_transaction'>Date</th>
                    <th class='transaction_history_th_transaction'>Status</th>
                    <th class='transaction_history_th_transaction'>Chat with " . ($role == "Buyer" ? "Farmer" : "Buyer") . "</th>
                </tr>";

                $transactions = [];
                while ($row = mysqli_fetch_assoc($fetch_order)) {
                    $sql1 = mysqli_query($con, "SELECT * FROM `crop_data` WHERE `crop_id` = " . $row['crop_id']. "");
                    $crop = mysqli_fetch_assoc($sql1);
                    $sql2 = mysqli_query($con, "SELECT quantity FROM `order_history` WHERE `cart_item_id` = " . $row['cart_item_id']. "");
                    $order = mysqli_fetch_assoc($sql2);
                    $sql3 = mysqli_query($con, "SELECT u_name FROM `user` WHERE `u_id` = " . $row[$role == "Buyer" ? 'farmer_id' : 'buyer_id']. "");
                    $user = mysqli_fetch_assoc($sql3);

                    $oth_id = ($role == "Buyer") ? base64_encode($row['farmer_id']) : base64_encode($row['buyer_id']);
                    $tid = base64_encode($row['transaction_id']);

                    echo "<tr class='transaction_history_tr_transaction'>
                        <th class='transaction_history_td_transaction'>" . $row['transaction_id'] . "</td>
                        <th class='transaction_history_td_transaction'>" . $crop['c_type'] . "</td>
                        <th class='transaction_history_td_transaction'>" . $order['quantity'] . "</td>
                        <th class='transaction_history_td_transaction'>" . $row['amount'] . " ICE</td>
                        <th class='transaction_history_td_transaction'>" . $user['u_name'] . "</td>
                        <th class='transaction_history_td_transaction'>" . date("d-M-Y H:i:s", strtotime($row['transaction_date'])) . "</td>
                        <td class='transaction_history_status-success'>Completed</td>
                        <th class='transaction_history_td_transaction'><a class='btn' href='./specific_chat.php?uid=$uid&oid=$oth_id&tid=$tid&w=true'><button class='transaction_history_chat_btn'>Chat</button></a></td>
                    </tr>";

                    $transactions[] = [
                        'id' => $row['transaction_id'],
                        'crop' => $crop['c_type'],
                        'quantity' => $order['quantity'],
                        'amount' => $row['amount'],
                        'user' => $user['u_name'],
                        'date' => date("d-M-Y H:i:s", strtotime($row['transaction_date'])),
                        'chat_url' => "./specific_chat.php?uid=$uid&oid=$oth_id&tid=$tid&w=true"
                    ];
                }
                echo "</table>";

                echo "<div class='transaction_history_accordion'>";
                foreach ($transactions as $index => $trans) {
                    echo "<div class='transaction_history_accordion-item'>
                        <div class='transaction_history_accordion-header' onclick='toggleAccordion($index)'>
                            Transaction ID {$trans['id']} - {$trans['crop']}
                        </div>
                        <div class='transaction_history_accordion-content' id='accordion-$index'>
                            <div><span class='transaction_history_label'>Transaction ID:</span> {$trans['id']}</div>
                            <div><span class='transaction_history_label'>Crop Name:</span> {$trans['crop']}</div>
                            <div><span class='transaction_history_label'>Quantity:</span> {$trans['quantity']}</div>
                            <div><span class='transaction_history_label'>Amount:</span> {$trans['amount']} ICE</div>
                            <div><span class='transaction_history_label'>" . ($role == "Buyer" ? "Farmer" : "Buyer") . ":</span> {$trans['user']}</div>
                            <div><span class='transaction_history_label'>Date:</span> {$trans['date']}</div>
                            <div><span class='transaction_history_label'>Status:</span> <span class='transaction_history_status-success'>Completed</span></div>
                            <div><a href='{$trans['chat_url']}'><button class='transaction_history_chat_btn'>Chat</button></a></div>
                        </div>
                    </div>";
                }
                echo "</div>";
            } else {
                echo "<div class='transaction_history_no_data_found'>No Transaction Found.</div>";
            }
        ?>
    </div>

    <?php include './footer.php'; ?>

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