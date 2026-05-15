<?php include './db_connectivity/db.php';

$data = json_decode(file_get_contents('php://input'), true); // Reads the JSON data sent to the PHP script and converts it into a PHP array.
$walletAddress = $data['walletAddress'] ?? null; // Extracts the wallet address from the JSON data.If it's present then take it otherwise store null value

if ($walletAddress) {
    if (isset($_GET['uid'])) {
        $id = base64_decode($_GET['uid']);
        $sql = "INSERT INTO `wallet_addresses`(`u_id`,`wallet_address`) VALUES ($id,'$walletAddress')";
        $res = mysqli_query($con, $sql);
        if ($res) {
            $id = $_GET['uid'];
            echo "<script type='text/javascript'>
            window.location.href = 'http://localhost/Mini_Project/index.php?w=true&uid=$id';
            </script>";
        } else {
            echo "<script type='text/javascript'>
            window.location.href = 'http://localhost/Mini_Project/connect_wallet.php?wt=false&uid=$id';
            </script>";
        }
    }
} else {
    $id = $_GET['uid'];
    echo "<script type='text/javascript'>
                window.location.href = 'http://localhost/Mini_Project/connect_wallet.php?wa=false&uid=$id';
        </script>";
}
