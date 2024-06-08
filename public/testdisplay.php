<?php
$servername = "localhost";
$database = "membership_gym";
$username = "root";
$password_db = "";

$conn = mysqli_connect($servername, $username, $password_db, $database);

if (!$conn) {
    die("Koneksi Gagal : " . mysqli_connect_error());
}

$query_member = "SELECT id_user, nama_depan, nama_belakang, tgl_lahir, email, no_telp, layanan FROM member ORDER BY id_user DESC LIMIT 1";
$result_member = mysqli_query($conn, $query_member);

$query_jadwal = "SELECT tanggal_latihan, waktu_latihan, trainer FROM jadwal ORDER BY id_jadwal DESC LIMIT 1";
$result_jadwal = mysqli_query($conn, $query_jadwal);

if (mysqli_num_rows($result_member) > 0) {
    $row_member = mysqli_fetch_assoc($result_member);
    $id_user = $row_member['id_user'];
    $nama_depan = $row_member['nama_depan'];
    $nama_belakang = $row_member['nama_belakang'];
    $tgl_lahir = $row_member['tgl_lahir'];
    $email = $row_member['email'];
    $no_telp = $row_member['no_telp'];
    $layanan = $row_member['layanan'];
} else {
    echo "Tidak ada data member yang ditemukan.";
}

if (mysqli_num_rows($result_jadwal) > 0) {
    $row_jadwal = mysqli_fetch_assoc($result_jadwal);
    $date = $row_jadwal['tanggal_latihan'];
    $time = $row_jadwal['waktu_latihan'];
    $trainer = $row_jadwal['trainer'];
} else {
    echo "Tidak ada data jadwal yang ditemukan.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST["nama_lengkap"]);
    $metode_bayar = mysqli_real_escape_string($conn, $_POST["metode_bayar"]);
    $bukti = mysqli_real_escape_string($conn, $_POST["bukti"]);

    $query_get_last_pembayaran_id = "SELECT id_pembayaran FROM pembayaran ORDER BY id_pembayaran DESC LIMIT 1";
    $result_pembayaran = mysqli_query($conn, $query_get_last_pembayaran_id);

    if ($result_pembayaran && mysqli_num_rows($result_pembayaran) > 0) {
        $row_pembayaran = mysqli_fetch_assoc($result_pembayaran);
        $last_pembayaran_id = $row_pembayaran['id_pembayaran'];

        $new_pembayaran_id = 'A' . sprintf('%d', substr($last_pembayaran_id, 1) + 1);
    } else {
        $new_pembayaran_id = 'A1';
    }

    $query_sql = "INSERT INTO pembayaran (id_pembayaran, id_user, nama_lengkap, metode_bayar, bukti) 
                  VALUES ('$new_pembayaran_id', '$id_user', '$nama_lengkap', '$metode_bayar', '$bukti')";

    if (mysqli_query($conn, $query_sql)) {
        echo "<script>window.location.href = 'indexnew.php';</script>";
        exit();
    } else {
        echo "Error: " . $query_sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/header.php'; ?>
</head>
<body class="testd">
    <nav class="navbar" style="background-color: #241c15;">
        <a href="indexnew.php" class="navbar-logo">Membership<span>Gym.</span></a>
    </nav>

    <div class="container">
        <div class="satuu">
            <div class="profil">
                <h1>Profil Data:</h1>
                <p id="displayFirstName"><b>First Name: </b><?php echo $nama_depan; ?></p>
                <p id="displayLastName"><b>Last Name: </b><?php echo $nama_belakang; ?></p>
                <p id="displayDob"><b>Date of Birth: </b><?php echo $tgl_lahir; ?></p>
                <p id="displayEmail"><b>Email: </b><?php echo $email; ?></p>
                <p id="displayPhone"><b>Phone Number: </b><?php echo $no_telp; ?></p>
                <p id="displayService"><b>Service: </b><?php echo $layanan; ?></p>
            </div>

            <div class="jadwal">
                <h1>Jadwal Data:</h1>
                <p id="displayDate"><b>Date: </b><?php echo $date; ?></p>
                <p id="displayTime"><b>Time: </b><?php echo $time; ?></p>
                <p id="displayTrainer"><b>Trainer: </b><?php echo $trainer; ?></p>
            </div>
        </div>

        <div class="duaa">
            <div class="form">
                <div>
                    <h1>Konfirmasi</h1>
                </div>
                <div class="isian">
                    <form id="myForm">
                        <label for="name" style="padding-right: 50px;">Nama:</label>
                        <input type="text" id="name" name="name" required style="width: 300px"><br><br>
                        
                        <label for="email" style="padding-right: 56px;">Email:</label>
                        <input type="email" id="email" name="email" required style="width: 300px"><br><br>
                        
                        <label for="message" style="padding-right: 49px;">Pesan:</label>
                        <input id="message" name="message" required style="width: 300px;"></input><br><br>
                        
                        <button type="button" onclick="sendToWhatsApp()">Kirim ke WhatsApp</button>
                    </form>

                    <script>
                        function sendToWhatsApp() {
                            var name = document.getElementById('name').value;
                            var email = document.getElementById('email').value;
                            var message = document.getElementById('message').value;

                            var whatsappMessage = `Halo, saya ${name}%0AEmail: ${email}%0APesan: ${message}`;

                            var phoneNumber = '6287872315275';

                            var whatsappURL = `https://wa.me/${phoneNumber}?text=${whatsappMessage}`;

                            window.open(whatsappURL, '_blank');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <hr style="margin-right: 4rem; margin-left: 4rem; margin-top: 2rem;">

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