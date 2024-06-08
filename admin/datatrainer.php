<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>
<body class="trainer">
<div class="sidebar">
        <a href="adminnew.php" class="sidebar-logo">Membership<span>Gym.</span></a>

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

    <!-- Content -->
    <div class="content">
        <div class="satu">
            <h2>Data Trainer<span>
                <a href="profiladmin.php" style="margin-left: 45rem; margin-right: 2rem;">
                    <i class="fa fa-user-circle" style="margin-right: 8px;"></i>Profile
                </a>
            </h2>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID Trainer</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telepon</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Koneksi ke database
            $servername = "localhost";
            $database = "membership_gym";
            $db_username = "root";
            $db_password = "";

            $conn = mysqli_connect($servername, $db_username, $db_password, $database);

            // Memeriksa koneksi
            if (!$conn) {
                die("Koneksi gagal: " . mysqli_connect_error());
            }

            // Menampilkan data dalam tabel
            $query = "SELECT id_trainer, nama, alamat, tgl_lahir, jenis_kelamin, no_telp FROM trainer";
            $result = mysqli_query($conn, $query);

            // Mengecek apakah query berhasil dijalankan
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // Menampilkan data dalam tabel
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id_trainer"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["alamat"] . "</td>";
                        echo "<td>" . $row["tgl_lahir"] . "</td>";
                        echo "<td>" . $row["jenis_kelamin"] . "</td>";
                        echo "<td>" . $row["no_telp"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data trainer.</td></tr>";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // Menutup koneksi
            mysqli_close($conn);
            ?>
            </tbody>
        </table>

        <hr style="margin-right: 2rem; margin-top: 1rem">

        <h2>Cetak Tabel</h2>
        <button class="print-button" onclick="printData()">Print</button>

        <hr style="margin-right: 2rem; margin-top: 1rem">

        <div class="delete-container">
            <form method="post" action="">
                <label for="usernameToDelete">Pilih ID trainer untuk dihapus:</label>
                <select name="id_trainer" id="id_trainer">
                    <option value="">Pilih ID Trainer</option>
                    <?php
                    // Koneksi ke database
                    $servername = "localhost";
                    $database = "membership_gym";
                    $db_username = "root";
                    $db_password = "";

                    $conn = mysqli_connect($servername, $db_username, $db_password, $database);

                    // Memeriksa koneksi
                    if (!$conn) {
                        die("Koneksi gagal: " . mysqli_connect_error());
                    }

                    // Menampilkan data dalam tabel
                    $query = "SELECT id_trainer FROM trainer";
                    $result = mysqli_query($conn, $query);

                    // Mengecek apakah query berhasil dijalankan
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id_trainer'] . "'>" . $row['id_trainer'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Tidak ada data trainer</option>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }

                    // Menutup koneksi
                    mysqli_close($conn);
                    ?>
                </select>
                <input type="submit" name="hapus_trainer" value="Hapus" class="delete-button">
            </form>
        </div>
    </div>
    <?php
    // Menghapus data trainer jika tombol hapus ditekan
    if (isset($_POST['hapus_trainer'])) {
        $id_trainer_to_delete = $_POST['id_trainer'];
        $conn = mysqli_connect($servername, $db_username, $db_password, $database);

        // Memeriksa koneksi
        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        $query_delete = "DELETE FROM trainer WHERE id_trainer = '$id_trainer_to_delete'";
        $result_delete = mysqli_query($conn, $query_delete);
        
        if ($result_delete) {
            echo "<script>alert('Data trainer berhasil dihapus');</script>";
            // Refresh halaman setelah penghapusan berhasil
            echo "<script>window.location.href = 'tabel_trainer.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data trainer');</script>";
        }

        // Menutup koneksi
        mysqli_close($conn);
    }
    ?>
    <script>
        function printData() {
            // Membuka jendela baru untuk mencetak data
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Data Trainer</title></head><body>');
            printWindow.document.write('<h1>Data Trainer</h1>');
            printWindow.document.write(document.getElementsByTagName('table')[0].outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>
</html>