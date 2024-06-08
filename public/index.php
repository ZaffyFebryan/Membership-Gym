<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/header.php'; ?>
</head>

<body class="index">
    <section class="hero" id="home">
        <div class="content">
            <main class="satu">
                <h1>WAKE UP. WORK OUT. <br><span>POWER ON.</span></h1>
                <p id="ganti-teks">TUNE YOUR BODY, TRANSFORM YOUR LIFE!</p>
                <a href="register/login.php" class="cta">SIGN UP NOW ></a>
            </main>

            <div class="dua">
                <img src="img/indoor1.jpeg" class="slide" alt="Photo 1">
                <img src="img/outdoor1.jpeg" class="slide" alt="Photo 2" style="display:none;">
                <img src="img/alat1.jpg" class="slide" alt="Photo 3" style="display:none;">
                <img src="img/indoor3.jpeg" class="slide" alt="Photo 4" style="display:none;">
                <img src="img/outdoor2.jpeg" class="slide" alt="Photo 5" style="display:none;">
                <img src="img/alat2.jpg" class="slide" alt="Photo 6" style="display:none;">

                <span class="dot" onclick="currentSlide(0)" style="margin-left: 10.4rem;"></span>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
                <span class="dot" onclick="currentSlide(5)"></span>
            </div>
        </div>
    </section>
    
    <script src="js/script.js"></script>
</body>
</html>