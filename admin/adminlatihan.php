<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>
<body class="lat">
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
            <h2>Data Latihan<span>
                <a href="profiladmin.php" style="margin-left: 44rem; margin-right: 2rem;">
                    <i class="fa fa-user-circle" style="margin-right: 8px;"></i>Profile
                </a>
            </h2>
        </div>

        <?php

        $servername = "localhost";
        $database = "membership_gym";
        $db_username = "root";
        $db_password = "";

        $conn = mysqli_connect($servername, $db_username, $db_password, $database);

        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        $query = "SELECT j.id_user, m.id_layanan, j.id_trainer, m.nama_depan, m.nama_belakang, l.jenis_layanan AS layanan, j.tanggal_latihan, j.waktu_latihan, t.nama AS trainer
                  FROM jadwal j
                  JOIN member m ON j.id_user = m.id_user
                  JOIN layanan l ON m.id_layanan = l.id_layanan
                  JOIN trainer t ON j.id_trainer = t.id_trainer";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>ID User</th><th>ID Layanan</th><th>ID Trainer</th><th>Nama Depan</th><th>Nama Belakang</th><th>Layanan</th><th>Tanggal Latihan</th><th>Waktu Latihan</th><th>Trainer</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id_user"] . "</td>";
                    echo "<td>" . $row["id_layanan"] . "</td>";
                    echo "<td>" . $row["id_trainer"] . "</td>";
                    echo "<td>" . $row["nama_depan"] . "</td>";
                    echo "<td>" . $row["nama_belakang"] . "</td>";
                    echo "<td>" . $row["layanan"] . "</td>";
                    echo "<td>" . $row["tanggal_latihan"] . "</td>";
                    echo "<td>" . $row["waktu_latihan"] . "</td>";
                    echo "<td>" . $row["trainer"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Tidak ada data latihan.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        ?>

        <hr style="margin-right: 2rem; margin-top: 1rem">

        <h2>Cetak Tabel</h2>
        <button class="print-button" onclick="printData()">Print</button>

        <hr style="margin-right: 2rem; margin-top: 1rem">
    </div>

    <script>
        function printData() {
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Data Latihan</title></head><body>');
            printWindow.document.write('<h1>Data Latihan</h1>');
            printWindow.document.write(document.getElementsByTagName('table')[0].outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
    <script src="https://kit.fontawesome.com/0305f8347c.js" crossorigin="anonymous"></script>
</body>
</html>