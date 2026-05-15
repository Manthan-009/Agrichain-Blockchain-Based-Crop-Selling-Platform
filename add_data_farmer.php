<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" class="add_data_farmer_html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Crop Data - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <style>
        .price-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .price-container input {
            width: 50%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.95rem;
            background: #f9f9f9;
            box-sizing: border-box;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        }
        .add_data_farmer_input-disabled {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
    </style>
</head>

<body class="add_data_farmer_body">
    <?php include './nav.php' ?>

    <?php 
    include './User_Profile/otp_send.php';
    $id = base64_decode($_GET['uid']); // based on MIEM
    if (isset($_POST['btn'])) {
        $ci = $_FILES['file']['name'];
        $ci_tmp = $_FILES['file']['tmp_name'];
        $ctype = $_POST['type'];
        $cquantity = $_POST['quantity'];
        $cprice = $_POST['price'];
        $cdescription = $_POST['description'];
        $error = array();
        $dir = 'crop_image/';
        $fi = $dir . $ci;

        if (empty($ctype)) {$error[] = "Please enter Crop Type.";}
        if (empty($cquantity)) {$error[] = "Please enter Crop Quantity.";}
        if (empty($cprice)) {$error[] = "Please enter Crop Price.";}
        if (empty($cdescription)) {$error[] = "Please enter Crop Description.";}
        if ($ci == "") {$error[] = "Please Select Crop Image.";}
        if (!move_uploaded_file($ci_tmp, $fi)) {$error[] = "Crop Image is not Moved.";}
        if (isset($_POST['crop_category'])) {
            $category = $_POST['crop_category'];
            if ($category == "select_category") {
                $error[] = "Please Select Crop Category.";
            }
        } else {
            $error[] = "Please Select Crop Category.";
        }

        if (count($error) == 0) {
            $sql = "INSERT INTO `crop_data`(`u_id`, `c_img`, `c_type`,`category`, `c_quantity`, `c_price`,`c_description`) VALUES ($id, '$ci','$ctype','$category','$cquantity','$cprice','$cdescription')";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $que_email = "SELECT * FROM `user` WHERE `u_id` = $id";
                $run_email = mysqli_query($con, $que_email);
                $fetch = mysqli_fetch_assoc($run_email);
                $subjects = "Your Crop Listing Has Been Successfully Published! 🌱";
                $msg = 'Dear ' .$fetch['u_name']. ',<br><br>Thanks for Listing,<br><h3>Listing Details:</h3><br><ul><li><strong>Crop Name:</strong> ' .$ctype. '</li><li><strong>Quantity:</strong> ' .$cquantity. '</li><li><strong>Price:</strong> ' .$cprice. ' ICE</li><li><strong>Description:</strong> ' .$cdescription. ' </li></ul><br><br>For any questions or assistance, to contact our support team at agrichain.yourtraders@gmail.com.<br><br>Best regards,<br>Agrichain!';
                OTP($fetch['u_mail'],$subjects,$msg);
                echo "<div class='alert alert-success add_data_farmer_alert add_data_farmer_alert-success alert-dismissible fade show m-2' role='alert'>
                        <strong>Crop </strong> added Successfully.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            } else {
                echo "<div class='alert alert-danger add_data_farmer_alert add_data_farmer_alert-danger alert-dismissible fade show m-2' role='alert'>
                        Something went Wrong.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        } else {
            foreach ($error as $i) {
                echo "<div class='alert alert-danger add_data_farmer_alert add_data_farmer_alert-danger alert-dismissible fade show m-2 add_data_farmer_error_msg' role='alert'>$i
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
    }

    // Fetch ICE price from CoinGecko API
    $apiUrl = "https://min-api.cryptocompare.com/data/price?fsym=ICE&tsyms=USD&api_key=b54bcf4d1bca4e8e9a2422ff2c3d462c";
    $response = file_get_contents($apiUrl);// fetch all content from url
    $data = json_decode($response, true); // convert json int oarray
    $icePrice = isset($data['USD']) ? $data['USD'] : 0.005;
    ?>

    <div class="add_data_farmer_containeres2">
        <h1 class="add_data_farmer_h1">List Crop</h1>
        <form method="POST" enctype="multipart/form-data" class="add_data_farmer_form">
            <input type="file" id="user_id" name="file" value="Crop Image" placeholder="Crop Image" class="add_data_farmer_input-file"><br><br>
            <label for="type" class="add_data_farmer_label">Crop Name:</label>
            <input type="text" id="type" name="type" class="add_data_farmer_input-text"><br><br>
            <label for="crop_category" class="add_data_farmer_label">Crop Categories:</label>
            <select name="crop_category" id="crop_category" class="add_data_farmer_select">
                <option value="select_category" disabled selected>Select Category</option>
                <option value="Vegetables">Vegetables</option>
                <option value="Fruits">Fruits</option>
                <option value="Grains">Grains (Cereals & Pulses)</option>
                <option value="Oilseeds">Oilseeds</option>
                <option value="Spices & Herbs">Spices & Herbs</option>
                <option value="Beverage">Beverage Crops</option>
            </select><br><br>
            <label for="quantity" class="add_data_farmer_label">Quantity (KG):</label>
            <input type="number" id="quantity" name="quantity" class="add_data_farmer_input-number"><br><br>
            <label for="price" class="add_data_farmer_label">Price (ICE):</label>
            <div class="price-container">
                <input type="number" id="price" name="price" class="add_data_farmer_input-text" step="0.1" min="0">
                <input type="text" id="price-usd" class="add_data_farmer_input-disabled" disabled placeholder="USD Value">
            </div><br><br>
            <label for="description" class="add_data_farmer_label">Description:</label>
            <textarea id="description" name="description" class="add_data_farmer_textarea"></textarea><br><br>
            <?php if(isset($_GET['w'])) { ?>
                <?php if($_GET['w'] == "true") { ?>
                    <input type="submit" value="Add Crop" name="btn" class="add_data_farmer_input-submit">
                <?php } else { ?>
                    <p class="crop_details_warning_msg">Oops! You cannot list your crop yet, your wallet address is missing! Please add it to proceed.</p>
                <?php } ?>
            <?php } else { ?>
                <p class="crop_details_warning_msg">Oops! You cannot list your crop yet, your wallet address is missing! Please add it to proceed.</p>
            <?php } ?>
        </form>
    </div>

    <?php include './footer.php' ?>

    <script>
        // Pass the PHP-fetched ICE price to JavaScript
        const ICE_TO_USD_RATE = <?php echo $icePrice; ?>;

        const priceInput = document.getElementById('price');
        const usdOutput = document.getElementById('price-usd');

        priceInput.addEventListener('input', function() {
            const iceValue = parseFloat(this.value) || 0;
            const usdValue = (iceValue * ICE_TO_USD_RATE).toFixed(6); // to_fixed means how many digits cover after point
            usdOutput.value = `$${usdValue} USD`;
        });
    </script>
</body>
</html>