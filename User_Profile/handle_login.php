<?php include '../db_connectivity/db.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `user` WHERE u_mail = '$mail'";
    $fire = mysqli_query($con, $sql);
    $n = mysqli_num_rows($fire);

    if ($n == 1) {
        $fetch = mysqli_fetch_assoc($fire);
        if (base64_decode($fetch['u_password']) == $pass) {
			$id = $fetch['u_id'];
            $sql = "SELECT * FROM `wallet_addresses` WHERE u_id = $id";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            $ids = base64_encode($id);
            session_start();
			$_SESSION['logedin'] = true;
			$_SESSION['username'] = $fetch['u_name'];
            if ($num == 1) { // if w == true then user added wallet address already
                header("Location: ../index.php?uid=$ids&w=true");
            }else{
                header("Location: ../index.php?uid=$ids&w=false");
            }
        } else {
            header("Location: login.php?user=false");
        }
    } else {
        header("Location: login.php?user_c=false");
    }
}
?>