<?php include './db_connectivity/db.php';
include './User_Profile/otp_send.php';

define("currentDateTimes", date('Y-m-d H:i:s'));
$currentDateTime = currentDateTimes;

$buyer_id = base64_decode($_GET['bid']);
$farmer_id = base64_decode($_GET['fid']) ?? null;
$cart_item_id = base64_decode($_GET['cid']) ?? null;
$amount = base64_decode($_GET['amount']) ?? null;
$blockchain_hash = $_GET['hash'] ?? null;

$crpds = base64_decode($_GET['fid_crop']);
$stmt = "INSERT INTO `transactions` (`buyer_id`, `farmer_id`, `crop_id`,`cart_item_id`, `amount`, `blockchain_hash`,`transaction_date`) VALUES ('$buyer_id', '$farmer_id',$crpds, '$cart_item_id', '$amount', '$blockchain_hash','$currentDateTime')";
$que = mysqli_query($con , $stmt);
$sts = 'Processing';
$qty = base64_decode($_GET['quantity']);

if ($que) {
    $order_que = "INSERT INTO `order_history` (`u_id`,`crop_id`,`farmer_id`,`cart_item_id`, `total_price`,`quantity`, `status`,`order_date`) VALUES ('$buyer_id',$crpds,'$farmer_id','$cart_item_id','$amount',$qty,'$sts','$currentDateTime')";
    $run_ins = mysqli_query($con, $order_que);
    
    $trans_id = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `order_history` WHERE `order_date` = '$currentDateTime'"));
    $trans = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `transactions` WHERE `transaction_date` = '$currentDateTime'"));

    $del_ques = "DELETE FROM order_history WHERE u_id = 0";
    $rams = mysqli_query($con, $del_ques);
    
    $del_n = "DELETE FROM transactions WHERE buyer_id = 0 AND amount = 0";
    $npd = mysqli_query($con,$del_n);

    $del_cart = "DELETE FROM `cart_data` WHERE `cart_item_id` = '$cart_item_id'";
    $run_cart = mysqli_query($con, $del_cart);

    $tid = $trans_id['order_id'];
    $user_que = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `user` WHERE `u_id` = $buyer_id"));
    $name = $user_que['u_name'];
    $user_que_farmer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `user` WHERE `u_id` = $farmer_id"));
    $fname = $user_que_farmer['u_name'];
    $quantity = $trans_id['quantity'];

    $crop_detail = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `crop_data` WHERE `crop_id` = $crpds"));
    $crop_name = $crop_detail['c_type'];

    $address_of_buyer = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `buyer_address` WHERE `u_id` = $buyer_id"));
    $address = $address_of_buyer['address'];

    $subject = "Your Order Has Been Successfully Placed! [Order #$tid]";
    $msg = "Dear [$name],<br/><br/>Congratulations! Your order has been successfully placed on our Agrichain. We're thrilled to connect you directly with farmers for fresh, authentic produce. Below are the details of your transaction:<br/><br/>Order Details:<br/>Order Number: #$tid<br/>Order Date: $currentDateTime<br/>Farmer/Seller: $fname<br/>Crop Purchased: $crop_name<br/>Quantity: $quantity KG<br/>Price: $amount ICE<br/>Transaction ID: ".$trans['transaction_id']."<br/>Transaction Hash: $blockchain_hash<br/>Buyer Address: $address<br/><br/><br/><br/>Thank you for supporting farmers and choosing a decentralized way to buy crops. We hope you enjoy your purchase!<br/>Best regards,<br/>Agrichain Team<br/>Email: agrichain.yourtraders@gmail.com<br/>Website: http://localhost/Mini_Project/index.php";
    $msg2 = "Dear [$fname],<br/><br/>Congratulations! One order found successfully placed on our Agrichain. We're thrilled to connect you directly with farmers for fresh, authentic produce. Below are the details of your transaction:<br/><br/>Order Details:<br/>Order Number: #$tid<br/>Order Date: $currentDateTime<br/>Farmer/Seller: $fname<br/>Crop Purchased: $crop_name<br/>Quantity: $quantity KG<br/>Price: $amount ICE<br/>Transaction ID: ".$trans['transaction_id']."<br/>Transaction Hash: $blockchain_hash<br/>Buyer Address: $address<br/><br/><br/><br/>Thank you for supporting farmers and choosing a decentralized way to buy crops. We hope you enjoy your purchase!<br/>Best regards,<br/>Agrichain Team<br/>Email: agrichain.yourtraders@gmail.com<br/>Website: http://localhost/Mini_Project/index.php";

    OTP($user_que_farmer['u_mail'], $subject, $msg2);
    OTP($user_que['u_mail'], $subject, $msg);

    $buids = base64_encode($buyer_id);
    echo "<script type='text/javascript'>
        function Ram(){
            window.location.href = 'http://localhost/Mini_Project/order_history.php?w=true&uid=$buids';
        }
        Ram();
        </script>";
} else {
    header("Location: ./cart.php?uid=$bcd&w=true&skp=true");
}
?>
