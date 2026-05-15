<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimal Message Card</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #e5e7eb;
        }

        .message-card {
            width: 500px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease-in-out;
        }

        .message-content {
            padding: 25px;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .message-content.active {
            display: block;
            opacity: 1;
        }

        .message-content h3 {
            margin: 0 0 15px;
            color: #1a202c;
            font-size: 1.4em;
        }

        .message-content p {
            margin: 8px 0;
            color: #4a5568;
            font-size: 1em;
            line-height: 1.5;
        }

        .message-content .timestamp {
            font-size: 0.9em;
            color: #718096;
            margin-top: 15px;
            text-align: right;
        }

        .next-button {
            display: block;
            margin: 15px auto;
            padding: 10px 25px;
            border: none;
            border-radius: 25px;
            background-color: #3b82f6;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .next-button:hover {
            background-color: #2563eb;
            transform: scale(1.05);
        }

        .message-card:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body>

    <?php include '../db_connectivity/db.php';
        $cid = base64_decode($_GET['cid']);
        $sql = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM contact_us WHERE c_id = '$cid'"));

        if(isset($_POST['back'])) {
            header('Location: ./dashboard.php?admin=true&table=contact_us&reply=false');
        }

        if(isset($_POST['answer'])) {
            header('Location: ./give_answer.php?cid=' .base64_encode($cid). '');
        }
    ?>

    <form method="POST">
        <div class="message-card">
            <div class="message-content active" id="message-1">
                <h3><?php echo $sql['u_subject']; ?></h3>
                <p><strong>Name:</strong> <?php echo $sql['u_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $sql['u_mail']; ?></p>
                <p><strong>Subject:</strong> <?php echo $sql['u_subject']; ?></p>
                <p><strong>Message:</strong> <?php echo $sql['u_message']; ?></p>
                <p><strong>Role:</strong> <?php echo $sql['u_role']; ?></p>
                <div class="timestamp"><?php echo $sql['time']; ?></div>
            </div>
        
            <button name='answer' class="next-button">Give Answer</button>
            <button name='back' class="next-button">Back to Dashboard</button>
        </div>
    </form>

</body>
</html>