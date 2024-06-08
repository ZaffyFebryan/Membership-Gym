<?php
if(isset($_POST['nama_depan'])){
    $nama_depan = $_POST["nama_depan"];
    $nama_belakang = $_POST["nama_belakang"];
    $no_kontak = $_POST["no_kontak"];
    $email = $_POST["email"];
    $pesan = $_POST["pesan"];

    $servername = "localhost";
    $database = "membership_gym";
    $username = "root";
    $password_db = "";

    $conn = mysqli_connect($servername, $username, $password_db, $database);

    if (!$conn) {
        die("Koneksi Gagal : " . mysqli_connect_error());
    }

    $query_sql = "INSERT INTO hubungi_kami (nama_depan, nama_belakang, no_kontak, email, pesan) 
                  VALUES ('$nama_depan', '$nama_belakang', '$no_kontak', '$email', '$pesan')";
    if(mysqli_query($conn, $query_sql)) {
        // Pendaftaran berhasil, arahkan pengguna ke halaman login
        echo "<script>window.location.href = 'contact.php';</script>";
        exit(); // Pastikan untuk keluar dari skrip setelah pengalihan
    } else {
        echo "Error: " . $query_sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/header.php'; ?>
</head>
<body class="contact">
    <nav class="navbar" style="background-color: #241c15;">

        <a href="index.php" class="navbar-logo">Membership<span>Gym.</span></a>

        <div class="navbar-nav">
            <a href="indexnew.php">HOME</a>
            <a href="layanan.php">LAYANAN</a>
            <a href="galeri.php">GALERI</a>
            <a href="contact.php">CONTACT US</a>
            <a href="profil.php" class="satu">JOIN ONLINE ></a>

            <a href="lokasi.php" id="lokasi" class="two"><i class="fa-solid fa-location-dot two" style="font-size: 1.3rem;"></i></a>
        </div>
    </nav>

    <section class="hero" id="home">
        <main class="content">
            <h1>HIT US UP. GET <br><span>IN TOUCH.</span></h1>
            <p id="ganti-teks">GOT QUESTIONS? WANT TO SHARE YOUR FEEDBACK? TALK TO US!</p>
        </main>
    </section>

    <section class="isii">
        <div class="pertama">
            <h1>GOT QUESTIONS?</h1>
            <p>Just complete the form and hit us up! We're always happy to help!</p>
        </div>
        <div class="kedua">
            <div>
            <form action="contact.php" method="POST">
                    <label for="nama_depan" class="atas" style="padding-right: 46px;">Nama Depan</label>
                    <input type="text" id="nama_depan" name="nama_depan" required><br><br>

                    <label for="nama_belakang" class="atas" style="padding-right: 23px;">Nama Belakang</label>
                    <input type="text" id="nama_belakang" name="nama_belakang" required><br><br>

                    <label for="no_kontak" class="atas" style="padding-right: 37px;">Nomor Kontak</label>
                    <input type="text" id="no_kontak" name="no_kontak" required><br><br>

                    <label for="email" class="atas" style="padding-right: 107px;">Email</label>
                    <input type="text" id="email" name="email" required><br><br>

                    <label for="pesan" class="atas" style="padding-right: 102px;">Pesan</label>
                    <input type="text" id="pesan" name="pesan" required><br><br>

                    <button type="login" class="log">Sign Up</button>
            </div>
        </div>
    </section>

    <hr style="margin-right: 4rem; margin-left: 4rem;">

    <footer class="footer">
        <div class="kolomjudul" style="margin-top: 1.2rem;">
            <a href="indexnew.php" class="satu"  style="text-decoration: none;">Membership<span>Gym.</span></a>
            <p>Tune Your Body <br>Transform Your Life!</p>
        </div>
        <div class="isi">
            <div class="kolomsatu">
                <h4>MEMBERSHIP</h4>
                <a href="layanan.php" style="text-decoration: none; color: white;"><p>Layanan</p></a>
                <a href="profil.php" style="text-decoration: none; color: white;"><p>Join Online</p></a>
            </div>
            <div class="kolomdua">
                <h4>FEATURE</h4>
                <a href="galeri.php" style="text-decoration: none; color: white;"><p>Galeri</p></a>
                <a href="lokasi.php" style="text-decoration: none; color: white;"><p>Location</p></a>
            </div>
            <div class="kolomtiga">
                <h4>OUR COMPANY</h4>
                <a href="aboutus.php" style="text-decoration: none; color: white;"><p>About Us</p></a>
                <a href="faq.php" style="text-decoration: none;color: white;"><p>FAQ</p></a>
            </div>
            <div class="kolomempat">
                <h4>CONTACT US</h4>
                <p>+62 812 4000 4000</p>
                <p>membershipgym@gmail.com</p>
                <a href="testimoni.php" style="text-decoration: none;color: white;"><p>Testimoni</p></a>
            </div>
        </div>
    </footer>

    <hr style="margin-right: 4rem; margin-left: 4rem; margin-top: 4rem;">

    <div class="bawah">
        <p>Created by <a>Kelompok 2 SID</a>. | &copy; 2024. |  Award Winning Fitness Chain in South East Asia. All Rights reserved
        <a href="terms.php" style="color: white">Terms & Conditions</a> | <a href="privacy.php" style="color: white;">Privacy Policy</a></p>
    </div>

    <script src="index.js"></script>
</body>
</html>