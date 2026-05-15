<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Educational Data - Agrichain</title>
    <link rel="shortcut icon" href="../Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #E6F4F1, #F0F8FF);
            margin: 0;
            padding: 20px;
            background-size: cover;
            background-attachment: fixed;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            margin:0 auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            border: 2px solid #B0E0E6; 
            position: relative;
            animation: float 4s infinite ease-in-out;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        h2 {
            color: #4682B4; 
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            text-shadow: 0 2px 4px rgba(70, 130, 180, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #5F9EA0;
            font-size: 16px;
        }
        label .icon {
            font-size: 18px;
            margin-left: 8px;
            vertical-align: middle;
            color: #87CEEB;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #B0E0E6; 
            border-radius: 10px;
            font-size: 14px;
            background: #F5F5F5;
            color: #333;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #4682B4; 
            box-shadow: 0 0 10px rgba(70, 130, 180, 0.3);
        }
        select {
            appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%228%22%20viewBox%3D%220%200%2012%208%22%3E%3Cpath%20fill%3D%22%234682B4%22%20d%3D%22M0%200l6%208%206-8H0z%22%2F%3E%3C%2Fsvg%3E');
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 30px;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        input[type="file"] {
            border: none;
            padding: 8px 0;
            background: transparent;
            color: #333;
        }
        input[type="file"]::file-selector-button {
            background: #87CEEB;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(135, 206, 235, 0.3);
            transition: background 0.3s;
        }
        input[type="file"]::file-selector-button:hover {background: #4682B4;}
        input[readonly] {
            background: #F5F5F5;
            cursor: not-allowed;
            border-style: solid;
        }
        .submit-btn {
            background: #4682B4;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(70, 130, 180, 0.4);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(70, 130, 180, 0.6);
        }
        select option[value="crop_type"] {
            background-color: #87CEEB;
            color: white;
        }
        select option[value="blockchain_education"] {
            background-color: #4682B4;
            color: white;
        }
        .btns{
            display: flex;
            flex-direction:column;
        }
        .btn1{ margin-bottom:2%; }
        .custom-modal .modal-content {
          border-radius: 20px;
          border: none;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
          background: linear-gradient(135deg, #6a11cb, #2575fc);
          color: white;
        }        
        .custom-modal .modal-header {
          border-bottom: none;
          padding: 20px;
        }
        .custom-modal .modal-body {
          padding: 20px;
          font-size: 18px;
        }
        .custom-modal .modal-footer {
          border-top: none;
          padding: 20px;
        }
        .custom-modal .btn-close {
          filter: invert(1);
        }
        .custom-modal .btn-primary {
          background-color: #ff6f61;
          border: none;
          border-radius: 10px;
          padding: 10px 20px;
          font-size: 16px;
        }
        .custom-modal .btn-primary:hover {
          background-color: #ff3b2f;
        }
        @keyframes slideIn {
          from {
            transform: translateY(-50px);
            opacity: 0;
          }
          to {
            transform: translateY(0);
            opacity: 1;
          }
        }
        .custom-modal .modal-dialog {
          animation: slideIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <?php include '../db_connectivity/db.php';
        if (isset($_POST['btn1'])) {
            $title = $_POST['title'];
            $category = $_POST['category'];
            $content = $_POST['content'];
            $media_file = $_FILES['file']['name'];
            $media_file_tmp = $_FILES['file']['tmp_name'];
            $dir = '../crop_image/Videos/';
            $fi = $dir . $media_file;
            $error = array();

            if (empty($title)) {$error[] = "Title is required";}
            if ($category == "sc") {$error[] = "Category is required";}
            if (empty($content)) {$error[] = "Content is required";}
            if (!move_uploaded_file($media_file_tmp, $fi)) {$error[] = "Media file is required";}

            if (count($error) > 0) {
                foreach ($error as $i) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Error!, </strong>$i
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            }else{
                $sql = mysqli_query($con, "INSERT INTO `educators_content`(`title`, `category`, `content`, `media_url`) VALUES ('$title', '$category', '$content', '$media_file')");
                if ($sql) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Content </strong> added Successfully.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            }            
        }

        if (isset($_POST['btn2'])) {
            echo "<script>location.href='./dashboard.php?admin=true&table=educators_content'</script>";
        }
    ?>
    <div class="form-container">
        <h2>Upload Video & Data</h2>
        <form id="dataForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title <span class="icon">📌</span></label>
                <input type="text" id="title" name="title"  placeholder="Enter Title">
            </div>
            
            <div class="form-group">
                <label for="category">Category <span class="icon">📂</span></label>
                <select id="category" name="category" >
                    <option value="sc">Select Category</option>
                    <option value="Crop Type">Crop Type</option>
                    <option value="Blockchain Education">Blockchain Education</option>
                    <option value="Farming Techniques">Farming Techniques</option>
                    <option value="How to access this Site?">How to access this Site?</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="content">Content <span class="icon">📝</span></label>
                <textarea id="content" name="content"  placeholder="Enter Content"></textarea>
            </div>
            
            <div class="form-group">
                <label for="media_file">Upload Video <span class="icon">🎥</span></label>
                <input type="file" id="media_file" name="file" accept="video/*">
            </div>
            
            <div class="btns">
                <button type="submit" class="submit-btn btn1" name="btn1">Submit Data</button>
                <button type="submit" class="submit-btn btn1" name="btn2">Home</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>