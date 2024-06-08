<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$servername = "localhost";
$database = "membership_gym";
$db_username = "root";
$db_password = "";

$conn = mysqli_connect($servername, $db_username, $db_password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = $conn->prepare("SELECT nama_depan, nama_belakang, alamat, telpon FROM admin WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
$admin_data = $result->fetch_assoc();

$query->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>

<body class="profad">
    <div class="sidebar">
        <a href="dashboard.php" class="sidebar-logo">Membership<span>Gym.</span></a>

        <div class="sidebar-links">
            <a href="dashboard.php">Dashboard</a>

            <div class="has-submenu">
                <a href="#">Admin</a>
                <div class="submenu" onmouseleave="hideAdminTable()" onmouseenter="showAdminTable()">
                    <a href="dataadmin.php">Data Admin</a>
                    <a href="tambahadmin.php?type=admin">Tambah Admin</a>
                </div>
            </div>

            <a href="layananadmin.php">Layanan</a>

            <div class="has-submenu">
                <a href="#">User</a>
                <div class="submenu">
                    <a href="datamember.php">Data User</a>
                </div>
            </div>

            <div class="has-submenu">
                <a href="#">Trainer</a>
                <div class="submenu">
                    <a href="datatrainer.php">Data Trainer</a>
                    <a href="tambahtrainer.php">Tambah Trainer</a>
                </div>
            </div>

            <a href="adminlatihan.php">Latihan</a>

            <a href="adminpembayaran.php">Konfirmasi Pembayaran</a>
        </div>
    </div>


    <div class="content">
        <div class="profile-container">
            <h1>Profil Admin</h1>
            <div class="profile-item">
                <strong>Nama Depan:</strong>
                <p><?php echo htmlspecialchars($admin_data['nama_depan']); ?></p>
            </div>
            <div class="profile-item">
                <strong>Nama Belakang:</strong>
                <p><?php echo htmlspecialchars($admin_data['nama_belakang']); ?></p>
            </div>
            <div class="profile-item">
                <strong>Alamat:</strong>
                <p><?php echo htmlspecialchars($admin_data['alamat']); ?></p>
            </div>
            <div class="profile-item">
                <strong>Telpon:</strong>
                <p><?php echo htmlspecialchars($admin_data['telpon']); ?></p>
            </div>
            <a href="editprofiladmin.php" class="edit-button">Edit Profil</a>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/0305f8347c.js" crossorigin="anonymous"></script>
</body>
</html>