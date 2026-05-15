<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytical Data - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e3f2fd);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include './nav.php'; ?>
    <?php
        $total_farmers = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM user WHERE user_role='farmer'"))['total'];
        $total_buyers = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM user WHERE user_role='buyer'"))['total'];
        $most_listed_crops = mysqli_query($con, "SELECT c_type, COUNT(*) as count FROM crop_data GROUP BY c_type ORDER BY count DESC LIMIT 3");
        $most_sold_crops = mysqli_query($con, "SELECT crop_data.c_type, COUNT(transactions.transaction_id) as count FROM transactions JOIN crop_data ON transactions.crop_id = crop_data.crop_id GROUP BY crop_data.c_type ORDER BY count DESC LIMIT 3");
        $average_price = mysqli_fetch_assoc(mysqli_query($con, "SELECT AVG(c_price) as avg_price FROM crop_data"))['avg_price'];
        $total_transactions = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM transactions"))['total'];
        $total_revenue = mysqli_fetch_assoc(mysqli_query($con, "SELECT SUM(amount) as revenue FROM transactions"))['revenue'];
        $active_users = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) as total FROM user WHERE date_time >= NOW() - INTERVAL 30 DAY"))['total'];
        $price_analysis = mysqli_query($con, "SELECT c_type, AVG(c_price) as avg_price FROM crop_data GROUP BY c_type ORDER BY avg_price DESC LIMIT 3");
    ?>

    <div class="container analitical_data_containers2">
        <h2 class='analitical_data_heading_new'>Platform Analytics</h2>
        <div class="analitical_data_both_data">
            <div class="analitical_data_stats">
                <h3>General Stats</h3>
                <p><strong>Total Farmers:</strong> <?php echo $total_farmers; ?></p>
                <p><strong>Total Buyers:</strong> <?php echo $total_buyers; ?></p>
                <p><strong>Average Crop Price:</strong> <?php echo round($average_price, 2); ?></p>
                <p><strong>Total Transactions:</strong> <?php echo $total_transactions; ?></p>
                <p><strong>Total Revenue:</strong> <?php echo $total_revenue; ?></p>
                <p><strong>Active Users (Last 30 Days):</strong> <?php echo $active_users; ?></p>
            </div>
            
            <div class="analitical_data_chart-container">
                <div class='analitical_data_analysis'>
                    <h3>Most Sold Crops</h3>
                    <canvas id="salesChart"></canvas>
                </div>
                <div class='analitical_data_analysis'>
                    <h3>Price Analysis</h3>
                    <canvas id="priceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <?php include './footer.php'; ?>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let salesData = [];
        let salesLabels = [];
        <?php while ($row = mysqli_fetch_assoc($most_sold_crops)) { ?>
        salesLabels.push("<?php echo $row['c_type']; ?>");
        salesData.push(<?php echo $row['count']; ?>);
        <?php } ?>

        let priceData = [];
        let priceLabels = [];
        <?php while ($row = mysqli_fetch_assoc($price_analysis)) { ?>
        priceLabels.push("<?php echo $row['c_type']; ?>");
        priceData.push(<?php echo round($row['avg_price'], 2); ?>);
        <?php } ?>

        new Chart(document.getElementById("salesChart"), {
            type: 'pie',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Most Sold Crops',
                    data: salesData,
                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 159, 64, 0.6)'
                    ]
                }]
            }
        });

        new Chart(document.getElementById("priceChart"), {
            type: 'pie',
            data: {
                labels: priceLabels,
                datasets: [{
                    label: 'Price Analysis',
                    data: priceData,
                    backgroundColor: ['rgba(255, 205, 86, 0.6)', 'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)'
                    ]
                }]
            }
        });
    });
    </script>

    <!-- <script src="./js/script.js"></script> -->
</body>

</html>