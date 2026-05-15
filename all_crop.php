<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop List - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php 
    include './nav.php';

    $searchQuery = isset($_POST['search']) ? $_POST['search'] : ''; 
    $categoryFilter = isset($_POST['category']) ? $_POST['category'] : '';
    $sortFilter = isset($_POST['sort']) ? $_POST['sort'] : '';

    $sql = "SELECT * FROM `crop_data` WHERE c_type LIKE '%$searchQuery%' ORDER BY `c_quantity` DESC";
    if (!empty($categoryFilter)) {
        $sql .= " AND category = '$categoryFilter'";
    }
    if (!empty($sortFilter)) {
        switch ($sortFilter) {
            case 'lth':
                $sql .= " ORDER BY c_price ASC";
                break;
            case 'htl':
                $sql .= " ORDER BY c_price DESC";
                break;
            case 'new':
                $sql .= " ORDER BY created_time DESC";
                break;
            case 'old':
                $sql .= " ORDER BY c_type ASC";
                break;
        }
    }
    
    $query = mysqli_query($con, $sql);
    $num = mysqli_num_rows($query);
    $usid = base64_decode($_GET['uid']);
    $sql2 = "SELECT * FROM `user` WHERE u_id = $usid";
    $query2 = mysqli_query($con, $sql2);
    $sname2 = mysqli_fetch_assoc($query2);
    ?>

    <div class="container all_crop_containers">
        <div class="all_crop_search-container">
            <form method="POST" class='all_crop_form_1'>
                <input type="text" name="search" class="all_crop_search-bar" placeholder="Search crops..."
                    value="<?php echo htmlspecialchars($searchQuery); ?>">
                <select name="category" class="all_crop_filter-select">
                    <option value="" <?php echo empty($categoryFilter) ? 'selected' : ''; ?>>All Categories</option>
                    <option value="Vegetables" <?php echo $categoryFilter == 'Vegetables' ? 'selected' : ''; ?>>
                        Vegetables</option>
                    <option value="Fruits" <?php echo $categoryFilter == 'Fruits' ? 'selected' : ''; ?>>Fruits</option>
                    <option value="Grains" <?php echo $categoryFilter == 'Grains' ? 'selected' : ''; ?>>Grains (Cereals
                        & Pulses)</option>
                    <option value="Oilseeds" <?php echo $categoryFilter == 'Oilseeds' ? 'selected' : ''; ?>>Oilseeds
                    </option>
                    <option value="Spices & Herbs" <?php echo $categoryFilter == 'Spices & Herbs' ? 'selected' : ''; ?>>
                        Spices & Herbs</option>
                    <option value="Beverage" <?php echo $categoryFilter == 'Beverage' ? 'selected' : ''; ?>>Beverage
                        Crops</option>
                </select>
                <button type="submit" class='all_crop_rama'>Apply</button>
            </form>
            <form method="POST" class='all_crop_form_2'>
                <select name="sort" class="all_crop_filter-select">
                    <option value="" <?php echo empty($sortFilter) ? 'selected' : ''; ?>>Sort Options</option>
                    <option value="lth" <?php echo $sortFilter == 'lth' ? 'selected' : ''; ?>>Price: Low to High
                    </option>
                    <option value="htl" <?php echo $sortFilter == 'htl' ? 'selected' : ''; ?>>Price: High to Low
                    </option>
                    <option value="new" <?php echo $sortFilter == 'new' ? 'selected' : ''; ?>>Newest</option>
                    <option value="old" <?php echo $sortFilter == 'old' ? 'selected' : ''; ?>>Sort by Alphabetically
                    </option>
                </select>
                <button type="submit" class='all_crop_rama'>Apply</button>
            </form>
        </div>

        <?php if ($num > 0): ?>
        <div class='all_crop_main_cart'>
            <h1 class="all_crop_heading">Crops</h1>
            <?php endif; ?>

            <div class="all_crop_containers all_crop_product-container">
            <?php
            $id = $_GET['uid'] ?? '';
            if ($num > 0) {
                while ($fetch = mysqli_fetch_assoc($query)) {
                    $crid = base64_encode($fetch['crop_id']);
                    $usid = $fetch['u_id'];
                    $sname = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `user` WHERE u_id = $usid"));
                    
                    echo "<div class='all_crop_product-cart'>
                        <img src='./crop_image/" . htmlspecialchars($fetch['c_img']) . "' alt='Crop Image'>
                        <div class='all_crop_product-details'>
                            <h2>" . htmlspecialchars($fetch['c_type']) . "</h2>
                            <div class='all_crop_price'>" . htmlspecialchars($fetch['c_price']) . " ICE per KG</div>
                            <div class='all_crop_price2'>Category: " . htmlspecialchars($fetch['category']) . "</div>";
                            if ($fetch['c_quantity'] > 0) {
                                echo "<p class='all_crop_available_quantity'>Available Quantity: " . htmlspecialchars($fetch['c_quantity']) . " KG</p>";
                            } else {
                                echo "<p class='all_crop_not_available_quantity' style='color:red;'>Currently Unavailable</p>";
                            }
                            echo "<p class='all_crop_available_quantity'>Seller Name: " . htmlspecialchars($sname['u_name'] ?? 'Unknown') . " </p>";
                            if ($fetch['c_quantity'] > 0) {
                                $link = ($sname2['user_role'] ?? '') == 'Farmer' 
                                    ? "./crop_details.php?uid=$id&w=true&cid=$crid&r=farmer"
                                    : "./crop_details.php?uid=$id&w=true&cid=$crid";
                                echo "<a href='$link'><button class='all_crop_btn-success'>View Crop</button></a>";
                            }
                        echo "</div></div>";
                }
                echo "</div>";
            } else {
                echo "<div></div><div class='all_crop_no_data_found'>No Crops Found.</div>";
            }
            ?>
            </div>
        </div>
        <?php include './footer.php'; ?>
</body>

</html>