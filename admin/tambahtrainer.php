<?php
$servername = "localhost";
$database = "membership_gym";
$db_username = "root";
$db_password = "";

$conn = mysqli_connect($servername, $db_username, $db_password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$queryLastId = "SELECT id_trainer FROM trainer ORDER BY id_trainer DESC LIMIT 1";
$resultLastId = mysqli_query($conn, $queryLastId);
if ($resultLastId && mysqli_num_rows($resultLastId) > 0) {
    $lastId = mysqli_fetch_assoc($resultLastId)['id_trainer'];
    $lastIdNumber = intval(substr($lastId, 3));
    $newIdNumber = $lastIdNumber + 1;
    $newId = "TRN" . str_pad($newIdNumber, 7, "0", STR_PAD_LEFT);
} else {
    $newId = "TRN0000001";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telp = $_POST['no_telp'];

    $query_insert = "INSERT INTO trainer (id_trainer, nama, alamat, tgl_lahir, jenis_kelamin, no_telp) VALUES ('$newId', '$nama', '$alamat', '$tgl_lahir', '$jenis_kelamin', '$no_telp')";
    $result_insert = mysqli_query($conn, $query_insert);

    if ($result_insert) {
        echo "<script>alert('Data trainer berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data trainer');</script>";
        echo "Error: " . $query_insert . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>

<body class="tamtrain">
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
    <div class="form-container">
        <h2>Tambah Trainer</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" required>
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" style="padding-top: 0.5rem; padding-bottom: 0.5rem; border-radius: 5px;" required>
                <option value="Laki - laki">Laki - laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <label for="no_telp">Nomor Telepon:</label>
            <input type="text" id="no_telp" name="no_telp" required>
            <input type="submit" value="Simpan">
        </form>
    </div>
</div>
</body>
</html>