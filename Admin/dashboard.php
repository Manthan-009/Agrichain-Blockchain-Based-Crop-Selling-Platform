<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            background-color: #f5f7ff;
        }
        .sidebar {
            width: 250px;
            height: 96vh;
            background: #2d2d2d;
            color: white;
            padding-top: 20px;
            margin-top: 3.8%;
            position: fixed;
            transition: width 0.3s ease-in-out;
            overflow-y: auto; /* Enable vertical scrolling */
            scrollbar-width: none; /* Hide scrollbar in Firefox */
        }
        .sidebar::-webkit-scrollbar {
            display: none; /* Hide scrollbar in Webkit browsers (Chrome, Safari) */
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0; /* Ensure no extra margin */
            height: calc(100% - 60px); /* Adjust height to account for logo or padding */
            overflow-y: auto; /* Enable scrolling within the ul */
            scrollbar-width: none; /* Hide scrollbar in Firefox */
        }
        .sidebar ul::-webkit-scrollbar {
            display: none; /* Hide scrollbar in Webkit browsers (Chrome, Safari) */
        }
        .sidebar ul li {
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar.collapsed ul li span {
            display: none;
        }
        .sidebar ul li i {
            margin-right: 10px;
        }
        .sidebar.collapsed ul li i {
            margin-right: 0;
        }
        .sidebar ul li:hover {
            background: #444;
        }
        /* Rest of your existing styles remain unchanged */
        .main-content {
            width: 100vw;
            transition: margin-left 0.3s ease-in-out;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            box-shadow: 0px 8px 8px rgba(5, 5, 5, 0.2);
            padding: 15px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: margin-left 0.3s ease-in-out;
        }
        .navbar .hamburger {
            font-size: 24px;
            cursor: pointer;
        }
        .navbar .profile {
            position: relative;
            cursor: pointer;
        }
        .navbar .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            color: black;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }
        .profile:hover .dropdown {
            display: block;
        }
        .dropdown a {
            text-decoration: none;
            color: black;
            display: block;
            padding: 8px;
        }
        .dropdown a:hover {
            background: #ddd;
        }
        .logo {
            width: 49%;
        }
        .logo_hamburger {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        .hamburger {
            width: 50%;
            margin-left: 50%;
        }
        .first_child {
            background-color: #444;
            color: white;
        }
        a {
            text-decoration: none;
            color: white;
        }
        .table-container {
            margin-top: 6%;
            margin-left: 18%;
            height: 94vh;
            width: 80vw;
            border: 2px solid lightgray;
            border-radius: 10px;
            padding: 20px;
            border-radius: 15px;
            background: #e0e5ec;
            box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.1), -8px -8px 15px rgba(255, 255, 255, 0.7);
            overflow-x: auto;
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }
        .table-container.collapsed {
            margin-left: 6%;
            width: 92vw;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }
        thead {
            background: #f0f5fa;
            box-shadow: inset 4px 4px 6px rgba(0, 0, 0, 0.1), inset -4px -4px 6px rgba(255, 255, 255, 0.6);
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            text-transform: uppercase;
            font-size: 14px;
            color: #333;
            background-color: #F8E7F6;
        }
        tbody tr {
            background: #e0e5ec;
            transition: all 0.3s ease-in-out;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1), -4px -4px 10px rgba(255, 255, 255, 0.6);
            border-radius: 10px;
        }
        tbody tr:hover {
            background: #f0f5fa;
            transform: scale(1.02);
        }
        .btn {
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.1), -4px -4px 6px rgba(255, 255, 255, 0.6);
        }
        .btn-edit {
            background: #6c5ce7;
            color: white;
            margin-right: 4%;
        }
        .btn-delete {
            background: #d63031;
            color: white;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        h1 {
            text-align: center;
            margin-bottom: 2%;
        }
        .btn-edit:hover{
            box-shadow:2px 1px 4px 4px rgba(0,0,0,0.2);
            background:#003092;
        }
        .btn-delete:hover{
            box-shadow:2px 1px 4px 4px rgba(0,0,0,0.2);
            background:#A31D1D;
        }
    </style>
</head>
<body>
    <?php $ad = $_GET['admin'];?>
    <div class="sidebar" id="sidebar">
        <ul>
            <form method="post">
            <a class='first_child' href="dashboard.php?admin=<?php echo $ad; ?>&table=user"><li><i class="fa fa-user" aria-hidden="true"></i><span>User</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=crop_data"><li><i class="fa fa-leaf" aria-hidden="true"></i><span>Crop Data</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=wallet_addresses"><li><i class="fa fa-wallet"></i> <span>Wallet Address</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=cart_data"><li><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Cart Data</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=transactions"><li><i class="fa fa-exchange-alt" aria-hidden="true"></i> <span>Transactions</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=order_history"><li><i class="fa fa-history" aria-hidden="true"></i> <span>Order History</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=common_chat"><li><i class="fa fa-comments" aria-hidden="true"></i> <span>Community Forum</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=specific_chat"><li><i class="fa fa-commenting" aria-hidden="true"></i> <span>User Forum</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=fb_chat"><li><i class="fa fa-comment" aria-hidden="true"></i> <span>Specific Forum</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=buyer_address"><li><i class="fa fa-house" aria-hidden="true"></i> <span>Buyer Address</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=contact_us"><li><i class="fa fa-phone-square" aria-hidden="true"></i> <span>Contact Us</span></li></a>
            <a href="dashboard.php?admin=<?php echo $ad; ?>&table=educators_content"><li><i class="fa fa-chalkboard-teacher" aria-hidden="true"></i> <span>Educational Content</span></li></a>
            <a href="add_educators.php?admin=<?php echo $ad; ?>&table=educators_content"><li><span>Add Educational Content</span></li></a>
            <a href="send_email.php?admin=<?php echo $ad; ?>"><li><span>Send Notification Each User</span></li></a>
            </form> 
        </ul>
    </div>
    <div class="main-content" id="main-content">
        <div class="navbar" id="navbar">
            <div class="logo_hamburger">
                <div class="logo">
                   <a href="dashboard.php?admin=<?=$ad?>"><img src="../Images/images/logo.png" class="logo me-5" alt=""></a>
                </div>
                <div class="hamburger" id="hamburger">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
            <span>Welcome, Admin</span>
            <div class="profile">
                <img src="../Images/images/dev1.jpg" alt="Profile">
                <div class="dropdown"><a href="logout.php?admin=<?=$ad?>">Logout</a></div>
            </div>
        </div>
        <div class="table-container" id="table-container">
            <?php include '../db_connectivity/db.php';
                if(isset($_GET['table'])){
                    if (isset($_GET['result'])) {
                        if ($_GET['result'] == 'true') {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Deletion Successful.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }else{
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Deletion Error or This id used in another table and it is a foreign key so first delete the data from that table.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }
                    }

                    if (isset($_GET['reply'])) {
                        if ($_GET['reply'] == 'true') {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Email send Successful.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }
                    }

                    $first_col = "";
                    $k = 0;
                    $table = $_GET['table'];
                    $result_column = mysqli_query($con, "SHOW COLUMNS FROM $table");
                    echo "<h1>$table</h1>";
                    echo "<table class='table table-striped table-hover' border='2px solid black'>
                            <thead>
                                <tr>";
                    if (mysqli_num_rows($result_column) > 0) {
                        while ($row = mysqli_fetch_assoc($result_column)) {
                            if ($k == 0) {
                                $first_col = $row['Field'];
                                $k++;
                            }
                            echo "<th>" .$row['Field'] . "</th>";
                        }
                        echo "<th>Actions</th>";
                    }
                    echo "</tr>";
                    $sql = "SELECT * FROM $table";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            foreach ($row as $key => $value) {
                                $len = strlen($value);
                                if ($len > 45) {
                                    $value = substr($value, 0, 10) . "...";
                                }
                                if (!empty($value)) {
                                    echo "<td>$value</td>";
                                }else{
                                    echo "<td>Not Provided.</td>";
                                }
                            }
                            echo "<td>";
                            if ($table == 'user') {
                                echo "<a class='btns_edit' href='./edit_user.php?uid=" . base64_encode($row['u_id']) . "'><button class='btn btn-edit'>Edit</button></a>";
                            }
                            if ($table == 'contact_us') {
                                echo "<a class='btns_edit' href='./view_chat.php?cid=" . base64_encode($row['c_id']) . "'><button class='btn btn-edit'>View</button></a>";
                            }
                            echo "<a class='btns_delete' href='./del_data.php?table=$table&col_name=&$first_col=" . base64_encode($row[$first_col]). "'><button class='btn btn-delete'>Delete</button></a>
                                </td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
            ?>
        </div>
    </div>
    
    <script>
        document.getElementById("hamburger").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("main-content").classList.toggle("collapsed");
            document.getElementById("navbar").classList.toggle("collapsed");
            document.getElementById("table-container").classList.toggle("collapsed");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>