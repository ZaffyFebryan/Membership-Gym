<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $database = "membership_gym";
    $db_username = "root";
    $db_password = "";

    $conn = mysqli_connect($servername, $db_username, $db_password, $database);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $nama_depan = $_POST['nama_depan'];
    $nama_belakang = $_POST['nama_belakang'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO admin (nama_depan, nama_belakang, alamat, telpon, username, password) 
              VALUES ('$nama_depan', '$nama_belakang', '$alamat', '$telpon', '$username', '$password')";

    if (mysqli_query($conn, $query)) {
        echo "<p>Admin baru berhasil ditambahkan.</p>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>
<body class="tamadm">
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
        <h2>Tambah Admin</h2>
        <form action="tambahadmin.php" method="POST">
            <label for="nama_depan">Nama Depan:</label>
            <input type="text" id="nama_depan" name="nama_depan" required>

            <label for="nama_belakang">Nama Belakang:</label>
            <input type="text" id="nama_belakang" name="nama_belakang" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>

            <label for="telpon">Telpon:</label>
            <input type="text" id="telpon" name="telpon" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Tambah Admin">
        </form>
    </div>
</body>
</html>
</body>
</html>