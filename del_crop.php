<?php include './db_connectivity/db.php';

$del_id = base64_decode($_GET['crd']);
$id = $_GET['uid'];

$update_quantity = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `cart_data` WHERE `cart_item_id` = $del_id"));
$crop_id = $update_quantity['crop_id'];
$quantity = $update_quantity['quantity'];
$update = mysqli_query($con, "UPDATE `crop_data` SET `c_quantity` = `c_quantity` + $quantity WHERE `crop_id` = $crop_id");

$del_que = "DELETE FROM `cart_data` WHERE `cart_item_id` = $del_id";
$del_run = mysqli_query($con, $del_que);

if ($del_run) {
    header("Location: ./cart.php?uid=$id&cdq=true&w=true");
}else{
    header("Location: ./cart.php?uid=$id&cdq=false&w=true");
}

?>