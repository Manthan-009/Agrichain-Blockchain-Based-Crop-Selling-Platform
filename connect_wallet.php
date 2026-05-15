<?php 
include './db_connectivity/db.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en" class="connect_wallet_html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect Wallet - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>
<body class="connect_wallet_body">
    <?php include 'nav.php'; ?>

    <?php
    if (isset($_POST['del_btn'])) {
        $id = base64_decode($_GET['uid'] ?? '');
        $sql = mysqli_query($con, "DELETE FROM `wallet_addresses` WHERE u_id = $id");
        if ($sql) {
            $encoded_id = $_GET['uid'];
            echo "<script>window.location.href = 'http://localhost/Mini_Project/index.php?uid=$encoded_id&w=false';</script>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Wallet Address deletion failed.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }

    // Error messages
    if (isset($_GET['wt']) && $_GET['wt'] == 'false') {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Failed to add wallet address. Please try again.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } elseif (isset($_GET['wa']) && $_GET['wa'] == 'false') {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            MetaMask didn't provide wallet address. Please try again.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    ?>

    <div class="connect_wallet_agroField">
        <?php
        if (isset($_SESSION['logedin'])) {
            $uid = $_GET['uid'] ?? '';
            if (($_GET['w'] ?? 'false') === "false") {
                echo "<div class='connect_wallet_harvestBox'>
                    <h1 class='connect_wallet_cropTitle'>Connect Your Ethereum Wallet</h1>
                    <button id='connectWallet' class='connect_wallet_farmButton'>Connect Wallet</button>
                    <p class='connect_wallet_soilInfo' id='status'>Wallet: Not connected</p>
                </div>";
            } elseif (($_GET['w'] ?? '') === "true") {
                $id = base64_decode($uid);
                $stmt = mysqli_query($con, "SELECT * FROM `wallet_addresses` WHERE u_id = $id");
                $num = mysqli_num_rows($stmt);
                $wallet = mysqli_fetch_assoc($stmt) ?? [];
                
                echo "<div class='connect_wallet_harvestBox'>
                    <h1 class='connect_wallet_cropTitle'>Wallet Information</h1>
                    <p class='connect_wallet_soilInfo'>Wallet Address: " . htmlspecialchars($wallet['wallet_address']) . "</p>
                    <form method='POST'>
                        <button name='del_btn' class='connect_wallet_farmButton'>Remove Wallet</button>
                    </form>
                </div>";
            }
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php $uid = $_GET['uid'] ?? ''; ?>
        const connectButton = document.getElementById('connectWallet');
        if (connectButton) {
            connectButton.addEventListener('click', async () => { // async return promises (return fulfil, reject)
                if (typeof window.ethereum !== 'undefined') { // Checks if the browser has MetaMask (a wallet extension) installed by looking for "window.ethereum".If it's not available then it return undefined
                    try {
                        const accounts = await ethereum.request({ method: 'eth_requestAccounts' });// Asks MetaMask to connect and provide the user’s wallet accounts, waiting for approval.
                        const walletAddress = accounts[0]; // first wallet address fetch
                        const status = document.getElementById('status');
                        status.textContent = 'Connecting...';

                        const response = await fetch('connect.php?uid=<?php echo $uid; ?>', { // Sends a request to a server file "connect.php" with a user ID (from PHP) and waits for the response.
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },// Tells the server that the data being sent is in JSON format.
                            body: JSON.stringify({ walletAddress })// converts the wallet address into a JSON string
                        });

                        if (response.ok) {
                            const data = await response.text(); // Gets the text data sent back from the server and wait
                            document.open();
                            document.write(data);
                            document.close();
                        } else {
                            status.textContent = 'Wallet: Connection failed';
                        }
                    } catch (error) {
                        console.error('Error connecting wallet:', error);
                        document.getElementById('status').textContent = 'Wallet: Connection failed';
                    }
                } else {
                    alert('Please install MetaMask to connect your wallet.');
                }
            });
        }
    </script>
</body>
</html>