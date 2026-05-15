<?php include './db_connectivity/db.php';

$cid = base64_decode($_GET['cid']);
$uid = base64_decode($_GET['uid']);
$ndata = base64_decode($_GET['nodata']);
$sql = "INSERT INTO `cart_item`(`crop_id`,`u_id`) VALUES($cid,$uid)";
$result = mysqli_query($con,$sql);

if ($result) {
    echo '<script>
            function Ram(){
                window.open("all_crop.php?uid=' .$_GET['uid']. '&w=true&ac=true","_self");
            }
            Ram();
    </script>';
}else{
    echo '<script>
            function Ram(){
                window.open("all_crop.php?uid=' .$_GET['uid']. '&w=true&ac=false","_self");
            }
            Ram();
    </script>';
}

?>