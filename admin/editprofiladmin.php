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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];

    $query = $conn->prepare("UPDATE admin SET nama_depan = ?, nama_belakang = ?, alamat = ?, telpon = ? WHERE username = ?");
    $query->bind_param("sssss", $nama_depan, $nama_belakang, $alamat, $telpon, $username);
    
    if ($query->execute()) {
        header("Location: profiladmin.php");
        exit();
    } else {
        echo "Error: " . $query->error;
    }

    $query->close();
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

<body class="edprofad">
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
        <div class="edit-container">
            <h1>Edit Profil Admin</h1>
            <form action="editprofiladmin.php" method="post">
                <div class="edit-item">
                    <label for="nama_depan">Nama Depan:</label>
                    <input type="text" id="nama_depan" name="nama_depan" value="<?php echo htmlspecialchars($admin_data['nama_depan']); ?>" required>
                </div>
                <div class="edit-item">
                    <label for="nama_belakang">Nama Belakang:</label>
                    <input type="text" id="nama_belakang" name="nama_belakang" value="<?php echo htmlspecialchars($admin_data['nama_belakang']); ?>" required>
                </div>
                <div class="edit-item">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($admin_data['alamat']); ?>" required>
                </div>
                <div class="edit-item">
                    <label for="telpon">Telpon:</label>
                    <input type="text" id="telpon" name="telpon" value="<?php echo htmlspecialchars($admin_data['telpon']); ?>" required>
                </div>
                <div class="edit-item">
                    <button type="submit" class="edit-button">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>