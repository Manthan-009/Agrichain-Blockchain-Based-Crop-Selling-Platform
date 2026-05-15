<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information - Admin</title>
    <link rel="shortcut icon" href="../Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin:0 auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            padding: 8px;
            background-color: #f0f0f0;
            border-radius: 4px;
        }

        .info-value {
            padding: 8px;
            background-color: #f9f9f9;
            border-radius: 4px;
            color: #333;
        }

        .edit-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #444;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            background-color: #fff;
            transition: border-color 0.3s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #007bff;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button.save {
            background-color: #007bff;
            color: white;
        }

        button.cancel {
            background-color: #dc3545;
            color: white;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <?php include '../db_connectivity/db.php';
        $id = base64_decode($_GET['uid']);
        $fetch = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE u_id = '$id'"));
        if (isset($_POST['sbtn'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $error = array();
            
            if (!preg_match_all("/^[A-Za-z ]+$/", $name)) {
                $error[] = "Name is Invalid (Must only contain letters and whitespace).";
            }
            if (!preg_match_all("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,3}$/", $email)) {
                $error[] = "Email is Invalid (Must contain a valid email address (with @ and .)).";
            }

            if (count($error) == 0) {
                $update = mysqli_query($con, "UPDATE user SET `u_name` = '$name', `u_mail` = '$email', `user_role` = '$role' WHERE `u_id` = '$id'");
                if ($update) {
                    echo "<script>location.href='./dashboard.php?admin=true&table=user'</script>";
                }else{
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error </strong> to Update.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            }
        }


        if (isset($_POST['cbtn'])) {
            echo "<script>location.href='./dashboard.php?admin=true&table=user'</script>";
        }
    ?>
    <div class="container">
        <h2>Edit User Information</h2>

        <div class="user-info">
            <h3>Current Information</h3>
            <div class="info-grid">
                <div class="info-label">User ID:</div>
                <div class="info-value"><?php echo $id; ?></div>
                <div class="info-label">Name:</div>
                <div class="info-value"><?php echo $fetch['u_name']; ?></div>
                <div class="info-label">Email:</div>
                <div class="info-value"><?php echo $fetch['u_mail']; ?></div>
                <div class="info-label">Role:</div>
                <div class="info-value"><?php echo $fetch['user_role']; ?></div>
                <div class="info-label">Password:</div>
                <div class="info-value">********</div>
                <div class="info-label">Date/Time:</div>
                <div class="info-value"><?php echo $fetch['date_time']; ?></div>
            </div>
        </div>

        <form class="edit-form" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $fetch['u_name']; ?>" >
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $fetch['u_mail']; ?>" >
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" >
                    <option value="Farmer">Farmer</option>
                    <option value="Buyer">Buyer</option>
                </select>
            </div>

            <div class="buttons">
                <button type="submit" class="save" name='sbtn'>Save Changes</button>
                <button type="submit" class="cancel" name='cbtn'>Cancel</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>