<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Agrichain</title>
    <link rel="shortcut icon" href="./Images/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html {
            font-size: 16px;
            line-height: 1.6;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(160deg, #e8eaf6 0%, #fffde7 100%);
            overflow-x: hidden;
            color: #2d3e2f;
        }
        a {
            text-decoration: none;
            color: #4a8d5f;
        }
        a:hover {
            text-decoration: underline;
            color: #3a7047;
        }
    </style>
</head>

<body>
    <?php include './nav.php'; ?>

    <!-- Start About Title Section -->
    <div class="about-title-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="about-heading">ABOUT US</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Title Section -->

    <!-- Start About Content -->
    <div class="about-content-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-image-wrapper">
                        <img class="img-fluid about-image" src="./Images/images/about-img.jpg" alt="About Agrichain" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <h2 class="about-main-title">We are <span>AGRICHAIN</span></h2>
                    <p>Welcome to AgriChain, we believe in harnessing the power of blockchain technology to
                        revolutionize the agricultural industry. Our platform serves as a bridge between farmers and
                        buyers, enabling direct, secure, and transparent transactions. By leveraging blockchain, we
                        ensure trust, efficiency, and sustainability in the agricultural supply chain, paving the way
                        for a better future.</p>
                    <h4 class="about-subheading">Our Mission</h4>
                    <p>Our mission is to create an ecosystem where farmers are empowered, buyers are confident, and
                        agricultural trade is transparent and efficient. We strive to eliminate the traditional barriers
                        that plague the agriculture industry, such as unfair pricing, lack of traceability, and
                        dependence on intermediaries.</p>
                    <h4 class="about-subheading">Our Vision</h4>
                    <p>We envision a future where technology bridges the gap between farmers and buyers, ensuring fair
                        prices, trust, and traceability in every transaction.</p>
                </div>
            </div>
            <div class="row my-5 about-services-row">
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="about-service-block">
                        <h3 class="about-service-title">We are Trusted</h3>
                        <p>At AgriChain, trust is at the core of everything we do. We have built a platform that ensures
                            transparency, security, and reliability for both farmers and buyers.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="about-service-block">
                        <h3 class="about-service-title">We are Professional</h3>
                        <p>At AgriChain, our team is composed of industry experts, technologists, and agricultural
                            specialists who are passionate about transforming the way crops are traded globally.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="about-service-block">
                        <h3 class="about-service-title">We are Expert</h3>
                        <p>At AgriChain, our expert team combines technology, agriculture, and innovation to
                            revolutionize farming, ensuring efficiency, transparency, and sustainability in the
                            industry.</p>
                    </div>
                </div>
            </div>
            <div class="row my-4 about-team-row">
                <div class="col-12">
                    <h2 class="about-team-title">Meet Our Team</h2>
                </div>
                <div class="about-team-members d-flex flex-wrap justify-content-center">
                    <div class="about-team-member">
                        <img src="./Images/images/dev1.jpg" alt="Manthan Beladiya" class="img-fluid about-team-image" />
                        <div class="about-team-info">
                            <h3 class="about-team-name">Manthan Beladiya</h3>
                            <span class="about-team-role">Backend Developer</span>
                        </div>
                        <div class="about-team-description">
                            <p>Manthan is a backend developer who specializes in server-side applications and databases.
                                He ensures fast performance, scalability, and security in web solutions.</p>
                        </div>
                    </div>
                    <div class="about-team-member">
                        <img src="./Images/images/dev2.jpg" alt="Darshil Dalsaniya"
                            class="img-fluid about-team-image" />
                        <div class="about-team-info">
                            <h3 class="about-team-name">Darshil Dalsaniya</h3>
                            <span class="about-team-role">Web Designer</span>
                        </div>
                        <div class="about-team-description">
                            <p>Darshil designs modern and user-friendly web interfaces. With attention to detail, he
                                ensures websites look visually appealing and perform seamlessly.</p>
                        </div>
                    </div>
                    <div class="about-team-member">
                        <img src="./Images/images/dev3.jpg" alt="Priyanshu Rathod" class="img-fluid about-team-image" />
                        <div class="about-team-info">
                            <h3 class="about-team-name">Priyanshu Rathod</h3>
                            <span class="about-team-role">Frontend Developer</span>
                        </div>
                        <div class="about-team-description">
                            <p>Priyanshu builds dynamic and responsive web applications. He focuses on delivering smooth
                                user experiences through clean code and innovative designs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Content -->

    <?php include './footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>