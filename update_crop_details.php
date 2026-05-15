<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Crop Quantity - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }
    </style>

</head>
<body>

    <?php include './nav.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity'])) {
        $crop_id = intval($_POST['crop_id']);
        $quantity = intval($_POST['quantity']);
        
        $sql = mysqli_query($con, "UPDATE crop_data SET c_quantity = $quantity WHERE crop_id = $crop_id");

        if ($sql) {
            echo "<div class='alert update_crop_details_alert_error update_crop_details_alert-success alert-dismissible fade show update_crop_details_alert_msg' role='alert'>
                <strong>Quantity</strong> updated successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        } else {
            echo "<div class='alert update_crop_details_alert_error update_crop_details_alert-danger alert-dismissible fade show update_crop_details_alert_msg' role='alert'>
                <strong>Error!</strong> Quantity is not updated.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        }
    }
    
    $id = base64_decode($_GET['uid']);
    $sql = "SELECT * FROM crop_data WHERE u_id = $id";
    $stmt = mysqli_query($con, $sql);
    $num_row = mysqli_num_rows($stmt);
    ?>

    <div class="container update_crop_details_container-2">
        <h2 class="update_crop_details_heading2">Update Crop Quantities</h2>
        <?php if ($num_row == 0) : ?>
            <div class='update_crop_details_no_data_found'>No Crop Found at this Time.</div>
        <?php else : ?>
            <ul class="update_crop_details_crop-list">
                <?php while ($crop = mysqli_fetch_assoc($stmt)): ?>
                <li class="update_crop_details_crop-item">
                    <img src="./crop_image/<?php echo htmlspecialchars($crop['c_img']); ?>" class="update_crop_details_crop-image" alt="Crop Image">
                    <div class="update_crop_details_crop-details">
                        <p><span class="update_crop_details_span">Crop ID:</span> <?php echo htmlspecialchars($crop['crop_id']); ?></p>
                        <p><span class="update_crop_details_span">Type:</span> <?php echo htmlspecialchars($crop['c_type']); ?></p>
                        <p><span class="update_crop_details_span">Category:</span> <?php echo htmlspecialchars($crop['category']); ?></p>
                        <p><span class="update_crop_details_span">Current Quantity:</span> <?php echo htmlspecialchars($crop['c_quantity']); ?> KG</p>
                        <p><span class="update_crop_details_span">Price:</span> <?php echo htmlspecialchars($crop['c_price']); ?> ICE</p>
                    </div>
                    <form method="POST" class="update_crop_details_form_update_crop" style="display: flex; align-items: center; gap: 10px;">
                        <input type="hidden" name="crop_id" value="<?php echo htmlspecialchars($crop['crop_id']); ?>">
                        <input type="number" name="quantity" class="update_crop_details_quantity-input" min="0" placeholder="<?php echo htmlspecialchars($crop['c_quantity']); ?>">
                        <button type="submit" name="update_quantity" class="update_crop_details_update-btn">Update</button>
                    </form>
                </li>
                <hr class="update_crop_details_hr_update_crop">
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>

    <?php include './footer.php' ?>
</body>
</html>