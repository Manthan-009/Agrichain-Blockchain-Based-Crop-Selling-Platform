<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <style>
        .ice-coin-price {
            text-align: center;
            padding: 8px;
            box-shadow: 0 2px 8px rgba(217, 83, 79, 0.2);
            background: linear-gradient(135deg, #fff3e0, #ffe8cc);
            margin: 5px auto;
            border-radius: 12px;
            width: 98vw;
            position: relative;
            border: 2px solid #f0ad4e;
            overflow: hidden;
        }
        .ice-coin-price::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2); 
            transform: rotate(30deg);
            animation: shine 3s infinite; 
        }
        .ice-coin-price .price-ticker {
            margin: 0;
            color: #d9534f;
            font-size: 20px;
            font-weight: 700;
            font-family: 'Arial', sans-serif;
            display: inline-block;
            white-space: nowrap; 
            position: relative;
            z-index: 1;
            animation: moveRightToLeft 10s linear infinite;
        }
        .ice-coin-price .price-date {
            font-weight: bold;
            color: #0288d1;
            margin: 0 15px;
            transition: color 0.3s ease;
        }
        .ice-coin-price .price-ticker:hover .price-date { color: #01579b; }
        @keyframes shine {
            0% { transform: translateX(-100%) rotate(30deg); }
            50% { transform: translateX(100%) rotate(30deg); }
            100% { transform: translateX(-100%) rotate(30deg); }
        }
        @keyframes moveRightToLeft {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-113%); }
        }
    </style>
</head>

<body>
    <?php include './nav.php'; ?>
    
    <!-- ICE Coin Price Section -->
    <div class="ice-coin-price">
        <p class="price-ticker" id="priceTicker"></p>
    </div>

    <div class="index_slider-container">
        <div class="index_slide index_slide-1">
            <div class="index_slide-text">
                <h1><strong>Welcome To Agrichain</strong></h1>
                <p>See how your users experience your website in realtime or view trends to see any changes in performance over time.</p>
            </div>
        </div>
        <div class="index_slide index_slide-2">
            <div class="index_slide-text">
                <h1><strong>Welcome To Agrichain</strong></h1>
                <p>See how your users experience your website in realtime or view trends to see any changes in performance over time.</p>
            </div>
        </div>
        <div class="index_slide index_slide-3">
            <div class="index_slide-text">
                <h1><strong>Welcome To Agrichain</strong></h1>
                <p>See how your users experience your website in realtime or view trends to see any changes in performance over time.</p>
            </div>
        </div>
        <div class="index_slide index_slide-4">
            <div class="index_slide-text">
                <h1><strong>Welcome To Agrichain</strong></h1>
                <p>See how your users experience your website in realtime or view trends to see any changes in performance over time.</p>
            </div>
        </div>
        <div class="index_slide index_slide-5">
            <div class="index_slide-text">
                <h1><strong>Welcome To Agrichain</strong></h1>
                <p>See how your users experience your website in realtime or view trends to see any changes in performance over time.</p>
            </div>
        </div>
        <div class="index_slide index_slide-6">
            <div class="index_slide-text">
                <h1><strong>Welcome To Agrichain</strong></h1>
                <p>See how your users experience your website in realtime or view trends to see any changes in performance over time.</p>
            </div>
        </div>
    </div>
    <!-- End Slider -->

    <!-- crop list -->
    <div class="container">
        <h1 class="index_heading_index">Crops</h1>
        <div class="index_containers7">
            <?php
            $tp = 0;
            $sql = "SELECT * FROM `crop_data`";
            $query = mysqli_query($con, $sql);
            $num = mysqli_num_rows($query);
            if ($num != 0) {
                $i = 1;
                while ($fetch = mysqli_fetch_assoc($query)) {
                    if ($i <= 3) {
                        $usid = $fetch['u_id'];
                        $sql2 = "SELECT * FROM `user` WHERE u_id = $usid";
                        $query2 = mysqli_query($con, $sql2);
                        $sname = mysqli_fetch_assoc($query2);

                        $data = $fetch['c_description'];
                        $desc = substr($data, 0, 33);
                        echo "<div class='index_product-cart'>
                        <img src='./crop_image/" . $fetch['c_img'] . "' alt='Crop Image'>
                        <div class='index_product-details2'>
                            <h2>" . $fetch['c_type'] . "</h2>";
                        if (strlen($data) >= 33) {
                            echo "<p>$desc...</p>";
                        } else {
                            echo "<p>$desc</p>";
                        }
                        echo "<div class='index_price'>" . $fetch['c_price'] . "ICE per KG</div>
                        <div class='index_quantity'>";
                        if ($fetch['c_quantity'] > 0) {
                            echo "<p>" . $fetch['c_quantity'] . " KG</p>";
                        } else {
                            echo "<p style='color: red; font-weight: 700;'>Currently Unavailable</p>";
                        }
                        echo "</div>
                        <p>Seller Name :- " . $sname['u_name'] . "</p>
                        </div>
                        </div>";
                        $i++;
                    }
                }
            } else {
                $tp = 1;
                echo "<h1 class='index_h1_ndf2'>No Data Found at this Time</h1>";
            }
            ?>
        </div>
        <?php
        if (isset($_SESSION['logedin']) && $tp == 0) {
            $id = $_GET['uid'];
            if (isset($_GET['w'])) {
                if ($_GET['w'] == "true") {
                    echo "<div><a href='./all_crop.php?uid=$id&w=true' class='index_view'>View all</a></div>";
                } else {
                    echo "<div><a href='./all_crop.php?uid=$id&w=false' class='index_view'>View all</a></div>";
                }
            } else {
                echo "<div><a href='./all_crop.php?uid=$id' class='index_view'>View all</a></div>";
            }
        } else {
            echo "<div style='margin-bottom:2%;'></div>";
        }
        ?>
    </div>

    <!-- Sponsor Section -->
    <div class="index_sponsor-section">
        <h2>Our Sponsors</h2>
        <div class="index_sponsor-container">
            <div class="index_sponsor-card">
                <img src="./Images/images/sp1.png" alt="Sponsor 1">
                <p>The One Technologies</p>
            </div>
            <div class="index_sponsor-card">
                <img src="./Images/images/sp2.png" alt="Sponsor 2">
                <p>Nutrien Ag Solution</p>
            </div>
            <div class="index_sponsor-card">
                <img src="./Images/images/sp3.png" alt="Sponsor 3">
                <p>Syngenta</p>
            </div>
            <div class="index_sponsor-card">
                <img src="./Images/images/sp4.png" alt="Sponsor 3">
                <p>Bunge Limited</p>
            </div>
        </div>
    </div>
    
    <?php include './footer.php'; ?>

    <script>
        // Fetch ICE Coin price data
        async function fetchIceCoinPrice() {
            const apiKey = 'b54bcf4d1bca4e8e9a2422ff2c3d462c';
            const url = `https://min-api.cryptocompare.com/data/v2/histoday?fsym=ICE&tsym=USD&limit=2&api_key=${apiKey}`;//api

            try {
                const response = await fetch(url);// fetch repsonse
                if (!response.ok) {// IF RESPONSE IS NOT OK
                    throw new Error(`HTTP error! status: ${response.status}`); // throw error
                }
                const data = await response.json(); // convert response to json
                return data;
            } catch (error) {
                console.error('Error fetching data:', error);
                return false;
            }
        }

        // Function to display price data
        async function displayPriceData() {
            const tickerElement = document.getElementById('priceTicker');
            let tickerText = "ICE Coin Price (USD) - Last 3 Days: ";

            // Get dates for last 3 days
            const today = new Date();
            today.setTime(today.getTime() + today.getTimezoneOffset() * 60 * 1000 - 7 * 60 * 60 * 1000); // tdat.getTime() :- convert current time into milliseconds
            //today.getTimezoneOffset() * 60 * 1000 :- Converts the timezone offset from minutes to milliseconds.
            const dates = [];
            for (let i = 2; i >= 0; i--) {
                const date = new Date(today);// creates a new date starting with today's date
                date.setDate(today.getDate() - i);// Changes the date by subtracting "i" days from today
                dates.push(date.toLocaleString('en-US', { month: 'short', day: 'numeric' }));// Converts the date to a string like "Apr 6" (short month name + day number)
            }

            // Fetch and process price data
            const data = await fetchIceCoinPrice();
            if (data && data.Response === 'Success' && data.Data && data.Data.Data) {
                const prices = data.Data.Data;
                prices.forEach((priceData, index) => {
                    const price = Number(priceData.close).toFixed(6);
                    tickerText += `<span class='price-date'>${dates[index]}</span>: $${price} USD `;
                });
            } else {
                tickerText += "Unable to load ICE Coin price data at this time.";
            }

            tickerElement.innerHTML = tickerText;
        }

        // Call the function when the page loads
        window.addEventListener('load', displayPriceData);

        // Slider functionality
        const slides = document.querySelectorAll('.index_slide');
        let currentSlide = 0;
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('index_active', i === index);
            });
        }
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        showSlide(currentSlide);
        setInterval(nextSlide, 3000);
    </script>
</body>
</html>