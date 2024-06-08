<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $layanan = $_POST["layanan"];
    $id_user = $_POST["id_user"];
    $email = $_POST["email"];
    $nama_depan = $_POST["nama_depan"];
    $nama_belakang = $_POST["nama_belakang"];
    $tgl_lahir = $_POST["tgl_lahir"];
    $no_telp = $_POST["no_telp"];

    switch ($layanan) {
        case "REGULER GREY - 250.000":
            $id_layanan = "GR";
            break;
        case "REGULER BLACK - 450.000":
            $id_layanan = "BL";
            break;
        case "REGULER GOLD - 600.000":
            $id_layanan = "GL";
            break;
        case "UNLIMITED 1 - 1.400.000":
            $id_layanan = "U1";
            break;
        case "UNLIMITED 2 - 10.000.000":
            $id_layanan = "U2";
            break;
        default:
            $id_layanan = null;
            break;
    }

    $servername = "localhost";
    $database = "membership_gym";
    $username = "root";
    $password_db = "";

    $conn = mysqli_connect($servername, $username, $password_db, $database);

    if (!$conn) {
        die("Koneksi Gagal : " . mysqli_connect_error());
    }

    $query_insert_member = "INSERT INTO member (id_user, id_layanan, layanan, email, nama_depan, nama_belakang, tgl_lahir, no_telp) 
                            VALUES ('$id_user', '$id_layanan', '$layanan', '$email', '$nama_depan', '$nama_belakang', '$tgl_lahir', '$no_telp')";

    if (mysqli_query($conn, $query_insert_member)) {
        $new_user_id = $id_user;

        mysqli_close($conn);
        header("Location: jadwal.php?id_user=" . $new_user_id);
        exit();
    } else {
        echo "Error: " . $query_insert_member . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/header.php'; ?>
</head>
<body class="profil">
    <nav class="navbar" style="background-color: #241c15;">
        <a href="indexnew.php" class="navbar-logo">Membership<span>Gym.</span></a>
    </nav>

    <section class="form">
        <div class="keseluruhan">
            <div class="kiri">
                <h1>SET UP <br>YOUR PROFILE </h1>
                <img src="../public/img/profil.png" alt="">
            </div>
            <div class="kanan">
                <div class="info">
                    <h3 class="satu"><span>1</span>PROFILE</h3>
                    <h3 class="dua"><span>•</span>SCHEDULE</h3>
                    <h3 class="tiga"><span>•</span>PAYMENT</h3>
                </div>

                <div class="terserah">
                    <p><b>ID User: </b><span id="display_id_user"></span></p>
                    <p><b>Email: </b><span id="display_email"></span></p>
                    <p><b>Nama Depan: </b><span id="display_nama_depan"></span></p>
                    <p><b>Nama Belakang: </b><span id="display_nama_belakang"></span></p>
                    <p><b>Tanggal Lahir: </b><span id="display_tgl_lahir"></span></p>
                    <p><b>No Telp: </b><span id="display_no_telp"></span></p>
                </div>

                <form action="profil.php" method="POST">
                    <input type="hidden" id="id_user" name="id_user" value="">
                    <input type="hidden" id="email" name="email" value="">
                    <input type="hidden" id="nama_depan" name="nama_depan" value="">
                    <input type="hidden" id="nama_belakang" name="nama_belakang" value="">
                    <input type="hidden" id="tgl_lahir" name="tgl_lahir" value="">
                    <input type="hidden" id="no_telp" name="no_telp" value="">

                    <label for="layanan">Service:</label>
                    <select id="layanan" name="layanan" required style="font-family: 'Poppins', sans-serif;">
                        <option value="" disabled selected>Select a service</option>
                        <option value="REGULER GREY - 250.000">REGULER GREY - 250.000</option>
                        <option value="REGULER BLACK - 450.000">REGULER BLACK - 450.000</option>
                        <option value="REGULER GOLD - 600.000">REGULER GOLD - 600.000</option>
                        <option value="UNLIMITED 1 - 1.400.000">UNLIMITED 1 - 1.400.000</option>
                        <option value="UNLIMITED 2 - 10.000.000">UNLIMITED 2 - 10.000.000</option>
                    </select><br><br>

                    <div class="checkbox-containersatu">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms" style="white-space: pre;">I've read and agreed to the <a href="terms.html" style="color: #241c15;"><i><u>terms and conditions</u></i></a></label>
                    </div>
                
                    <div class="checkbox-containerdua">
                        <input type="checkbox" id="promo" name="promo">
                        <label for="promo" style="white-space: pre;">I'd like to receive promotional emails</label>
                    </div>

                    <input type="submit" value="Continue">
                </form>
            </div>
        </div>
    </section>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var signupData = <?php echo json_encode($_SESSION['signup_data'] ?? []); ?>;

    if (signupData) {
        document.getElementById('id_user').value = signupData.id_user;
        document.getElementById('email').value = signupData.email;
        document.getElementById('nama_depan').value = signupData.nama_depan;
        document.getElementById('nama_belakang').value = signupData.nama_belakang;
        document.getElementById('tgl_lahir').value = signupData.tgl_lahir;
        document.getElementById('no_telp').value = signupData.no_telp;

        document.getElementById('display_id_user').textContent = signupData.id_user;
        document.getElementById('display_email').textContent = signupData.email;
        document.getElementById('display_nama_depan').textContent = signupData.nama_depan;
        document.getElementById('display_nama_belakang').textContent = signupData.nama_belakang;
        document.getElementById('display_tgl_lahir').textContent = signupData.tgl_lahir;
        document.getElementById('display_no_telp').textContent = signupData.no_telp;
    }
});
</script>