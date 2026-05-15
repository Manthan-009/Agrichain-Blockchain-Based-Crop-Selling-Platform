<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #e9ecef);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

    </style>
</head>

<body>
    <?php include './nav.php'; ?>
    <div class="container education_containers4 mt-5">
    
        <div class="education_search-container2">
            <form method="POST" class='education_form_2'>
                <select name="sort" class="education_new_select">
                    <option value="" disabled selected>Select Category</option>
                    <option value="Crop Type">Crop Type</option>
                    <option value="Farming Techniques">Farming Techniques</option>
                    <option value="Blockchain Education">Blockchain Education</option>
                    <option value="How to access this Site?">How to access this Site?</option>
                </select>
                <button type="submit" class='education_rama'>Apply</button>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['sort'])) {
            $selected_category = mysqli_real_escape_string($con, $_POST['sort']);
            $sql = "SELECT * FROM `educators_content` WHERE category = '$selected_category'";
            $run = mysqli_query($con, $sql);
            $num = mysqli_num_rows($run);
            
            if ($num == 0) {
                echo "<div class='education_no_data_found'>No Videos Found.</div>";
            } else {
                while ($row = mysqli_fetch_assoc($run)) {
                    echo '<div class="education_card">
                        <h2 class="education_card-title">' . $row['title'] . '</h2>
                        <h5 class="education_text-secondary">Category: ' . $row['category'] . '</h5>
                        <div class="mt-4">
                            <h5>Media Preview:</h5>
                            <video class="education_media-preview" width="100%" controls>
                                <source src="./crop_image/Videos/' . $row['media_url'] . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="education_content mt-3">' . $row['content'] . '</div>
                        <p class="education_uploaded-time mt-3">Uploaded on: ' . $row['uploaded_at'] . '</p>
                    </div>';   
                }
            }
        }
        ?>

    </div>

    <?php include './footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>