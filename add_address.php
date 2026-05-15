<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" class="add_address_html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Address - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="add_address_body">
    <?php include './nav.php'; ?>

    <?php
    if (isset($_POST['btn'])) {
        $id = $_GET['uid'];
        $add = $_POST['add'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $error = array();
        $dir = 'crop_image/';

        if (!preg_match_all("/^[a-zA-Z0-9\s,.-]+$/", $add)) {
            $error[] = "Invalid Format of Address.";
        }
        if (!preg_match_all("/^[a-zA-Z\s]+$/", $city)) {
            $error[] = "Please enter Valid City.";
        }
        if (!preg_match_all("/^\d{6}$/", $zip)) {
            $error[] = "Please enter Valid Zip Code must be 6 Digit.";
        }

        if (count($error) == 0) {
            $ci = "$add, $city, $zip";
            $id = base64_decode($id);
            $sql = "INSERT INTO `buyer_address`(`u_id`, `address`) VALUES ($id, '$ci')";
            $query = mysqli_query($con, $sql);
            if ($query) {
                $crid = $_GET['crpd'];
                $id = $_GET['uid'];
                echo "<script type='text/javascript'>
                    function Ram(){
                        window.location.href = 'http://localhost/Mini_Project/buy_now.php?uid=$id&crpd=$crid&w=true';
                    }
                    Ram();
                </script>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show add_address_alert add_address_alert-danger' role='alert'>
                        Something went Wrong.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        } else {
            for ($i = 0; $i < count($error); $i++) {
                echo "<div class='alert alert-danger alert-dismissible fade show add_address_alert add_address_alert-danger' role='alert'>$error[$i]
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        }
    }
    ?>

    <div class="add_address_contn container">
        <div class="add_address_containeres container">
            <h1 class="add_address_h1">Add Address</h1>
            <form method="POST" class="add_address_form">
                <label class="add_address_label" for="add">Full Address:</label>
                <input class="add_address_input" type="text" id="add" name="add" placeholder="Enter full address"
                    required>

                <label class="add_address_label" for="city">City:</label>
                <input class="add_address_input" type="text" id="city" name="city" placeholder="Enter city" required>

                <label class="add_address_label" for="zip">Zipcode:</label>
                <input class="add_address_input" type="text" id="zip" name="zip" placeholder="Enter 6-digit zipcode"
                    required>

                <input class="add_address_input-submit" type="submit" value="Add Address" name="btn">
            </form>
        </div>
    </div>

    <?php include './footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>