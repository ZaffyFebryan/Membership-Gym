<?php
$servername = "localhost";
$database = "membership_gym";
$db_username = "root";
$db_password = "";

$conn = mysqli_connect($servername, $db_username, $db_password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "SELECT * FROM layanan";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>

<body class="layadm">
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
        <div class="satu">
            <h2>Data Layanan<span>
                <a href="profiladmin.php" style="margin-left: 44rem;">
                    <i class="fa fa-user-circle" style="margin-right: 8px;"></i>Profile
                </a>
            </h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Layanan</th>
                    <th>Jenis Layanan</th>
                    <th>Jumlah Latihan Maksimal</th>
                    <th>Biaya</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id_layanan"] . "</td>";
                        echo "<td>" . $row["jenis_layanan"] . "</td>";
                        echo "<td>" . $row["jml_lat_max"] . "</td>";
                        echo "<td>" . $row["biaya"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <hr style="margin-right: 2rem; margin-top: 1rem">

        <h2>Cetak Tabel</h2>
        <button class="print-button" onclick="printData()">Cetak Tabel</button>
    </div>
    <script>
        function printData() {
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Daftar Layanan</title></head><body>');
            printWindow.document.write('<h1>Daftar Layanan</h1>');
            printWindow.document.write(document.getElementsByTagName('table')[0].outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>
</html>

<?php
// Menutup koneksi
mysqli_close($conn);
?>