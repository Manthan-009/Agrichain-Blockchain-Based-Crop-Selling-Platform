<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ethers/5.7.2/ethers.umd.min.js"></script>
    <link rel="stylesheet" href="./style.css">
    
    <style>
        .pay-now-header {
            background: #22c55e;
            color: white;
            border: none;
            padding: 18px 50px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            margin: 40px auto;
            display: block;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
            transition: all 0.3s ease;
        }
        
        .pay-now-header:hover {
            background: #16a34a;
            transform: translateY(-2px);
        }
        
        .pay-now-header:disabled {
            background: #666;
            cursor: not-allowed;
            transform: none;
        }
        
        .container.containers {
            text-align: center;
            padding: 60px 20px;
            min-height: 300px;
        }
    </style>
</head>
<body>
    <?php include './nav.php'; ?>

    <?php
        // Get parameters safely
        $cid = isset($_GET['crpd']) ? base64_decode($_GET['crpd']) : '';
        $bid = isset($_GET['uid']) ? base64_decode($_GET['uid']) : '';
       
        if (empty($cid) || empty($bid)) {
            echo "<h2 style='color:red;text-align:center;'>Invalid Payment Link</h2>";
            exit;
        }

        // Fetch cart data
        $que_fid = "SELECT * FROM `cart_data` WHERE `cart_item_id` = '" . mysqli_real_escape_string($con, $cid) . "'";
        $run_que_fid = mysqli_query($con, $que_fid);
        $fetch_fid = mysqli_fetch_assoc($run_que_fid);

        if (!$fetch_fid) {
            echo "<h2 style='color:red;text-align:center;'>Cart item not found</h2>";
            exit;
        }

        $fid_crop = $fetch_fid['crop_id'];
        $amount = $fetch_fid['c_total'];
        $quantity = $fetch_fid['quantity'];

        // Fetch crop owner (farmer)
        $fid_que = "SELECT * FROM `crop_data` WHERE `crop_id` = '" . mysqli_real_escape_string($con, $fid_crop) . "'";
        $run_fid_que = mysqli_query($con, $fid_que);
        $fetch_qfid = mysqli_fetch_assoc($run_fid_que);
        $fid = $fetch_qfid['u_id'] ?? '';

        // Get farmer's wallet address
        $rec_address = '';
        if ($fid) {
            $radd_que = "SELECT * FROM `wallet_addresses` WHERE `u_id` = '" . mysqli_real_escape_string($con, $fid) . "'";
            $run_radd_que = mysqli_query($con, $radd_que);
            $fetch_add = mysqli_fetch_assoc($run_radd_que);
            $rec_address = $fetch_add['wallet_address'] ?? '';
        }
    ?>

    <script>
        async function transferICE() {
            const payButton = document.getElementById('payButton');
            if (payButton) {
                payButton.disabled = true;
                payButton.innerHTML = 'Processing Transaction...';
            }

            try {
                if (typeof window.ethereum === "undefined") {
                    alert("MetaMask is not installed. Please install MetaMask to continue.");
                    return;
                }

                console.log("Connecting to MetaMask...");
                const provider = new ethers.providers.Web3Provider(window.ethereum);
                
                await provider.send("eth_requestAccounts", []);
                const signer = provider.getSigner();
                const senderAddress = await signer.getAddress();
                
                const network = await provider.getNetwork();
                if (network.chainId !== 56) {
                    alert("Please switch to BNB Smart Chain (Chain ID: 56) in MetaMask!");
                    return;
                }

                const ICE_TOKEN_CONTRACT = "0xc335Df7C25b72eEC661d5Aa32a7c2B7b2a1D1874";
                const recipient = "<?php echo addslashes($rec_address); ?>";
                const amount = <?php echo json_encode($amount); ?>;

                // Validation
                if (!recipient || !ethers.utils.isAddress(recipient)) {
                    alert("Invalid farmer wallet address. Please contact support.");
                    return;
                }

                if (!amount || parseFloat(amount) <= 0) {
                    alert("Invalid payment amount.");
                    return;
                }

                const abi = ["function transfer(address to, uint256 amount) public returns (bool)"];
                const contract = new ethers.Contract(ICE_TOKEN_CONTRACT, abi, signer);
                
                const amountInWei = ethers.utils.parseUnits(amount.toString(), 18);

                // Check balance
                try {
                    const balance = await contract.balanceOf(senderAddress);
                    if (balance.lt(amountInWei)) {
                        alert(`Insufficient ICE Balance!\n\nYour Balance: ${ethers.utils.formatUnits(balance, 18)} ICE\nRequired: ${amount} ICE`);
                        return;
                    }
                } catch (e) {
                    console.warn("Could not check balance:", e);
                }

                console.log(`Sending ${amount} ICE to ${recipient}`);

                // Transfer with manual gas limit to avoid estimation error
                const tx = await contract.transfer(recipient, amountInWei, {
                    gasLimit: 250000
                });

                alert(`Transaction submitted successfully!\n\nTx Hash: ${tx.hash}\n\nPlease wait for confirmation...`);

                // Save transaction
                saveTransaction(senderAddress, recipient, amount, tx.hash);

            } catch (error) {
                console.error("Transaction Error:", error);

                let errorMsg = "Transaction Failed.\n\n";

                if (error.message.includes("execution reverted") || error.code === "UNPREDICTABLE_GAS_LIMIT") {
                    errorMsg += "The transaction would fail on the blockchain.\n\nPossible reasons:\n";
                    errorMsg += "• You don't have enough ICE tokens in your wallet\n";
                    errorMsg += "• The amount is too high\n";
                    errorMsg += "• Farmer's wallet address is incorrect\n";
                    errorMsg += "• Token transfer is restricted";
                } else if (error.message.includes("user rejected")) {
                    errorMsg += "You rejected the transaction in MetaMask.";
                } else {
                    errorMsg += error.message || "Unknown error occurred.";
                }

                alert(errorMsg);
            } finally {
                if (payButton) {
                    payButton.disabled = false;
                    payButton.innerHTML = 'PAY NOW';
                }
            }
        }

        function saveTransaction(buyer, farmer, amount, hash) {
            const formData = new FormData();
            formData.append("amount", amount);
            formData.append("blockchain_hash", hash);

            fetch("save_transaction.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log("Transaction saved:", data);
                window.location.href = `http://localhost/Mini_Project/save_transaction.php?bid=<?php echo base64_encode($bid); ?>&fid=<?php echo base64_encode($fid); ?>&cid=<?php echo base64_encode($cid); ?>&quantity=<?php echo base64_encode($quantity); ?>&amount=<?php echo base64_encode($amount); ?>&fid_crop=<?php echo base64_encode($fid_crop); ?>&hash=${hash}`;
            })
            .catch((error) => {
                console.error("Save error:", error);
                alert("Transaction sent on blockchain but failed to save record. Contact support with Tx Hash.");
            });
        }
    </script>

    <!-- Main Payment Section -->
    <div class="container containers">
        <h2 style="margin-bottom: 20px;">Complete Your Payment</h2>
        <p style="margin-bottom: 30px; font-size: 18px;">
            Amount to Pay: <strong><?php echo number_format($amount, 2); ?> ICE</strong>
        </p>
        
        <button id="payButton" onclick="transferICE()" class="pay-now-header">
            PAY NOW
        </button>
        
        <p style="margin-top: 30px; color: #666; font-size: 14px;">
            You will be redirected after successful transaction
        </p>
    </div>

    <?php include './footer.php'; ?>
</body>
</html>