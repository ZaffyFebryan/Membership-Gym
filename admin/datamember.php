<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>

<body class="user">
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

    <div class="content">
        <div class="satu">
            <h2>Data User<span>
                <a href="profiladmin.php" style="margin-left: 46rem;">
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

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            $idToDelete = $_POST['idToDelete'];
            $deleteQuery = "DELETE FROM signup WHERE id_user = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("s", $idToDelete);
            if ($stmt->execute()) {
                echo "User dengan ID $idToDelete berhasil dihapus.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }

        $query = "SELECT id_user, email, nama_depan, nama_belakang, tgl_lahir, no_telp FROM signup";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>ID User</th><th>Email</th><th>Nama Depan</th><th>Nama Belakang</th><th>Tanggal Lahir</th><th>No. Telepon</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id_user"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["nama_depan"] . "</td>";
                    echo "<td>" . $row["nama_belakang"] . "</td>";
                    echo "<td>" . $row["tgl_lahir"] . "</td>";
                    echo "<td>" . $row["no_telp"] . "</td>";
                    echo "</tr>";                    
                }
                echo "</table>";
            } else {
                echo "Tidak ada data user.";
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

        <div class="delete-container">
            <h2>Hapus Data</h2>
            <form method="post" action="">
                <label for="idToDelete">Pilih ID User untuk dihapus:</label>
                <select name="idToDelete" id="idToDelete" onchange="setIdToDelete(this.value)">
                    <option value="">Pilih ID User</option>
                    <?php
                    
                    $servername = "localhost";
                    $database = "membership_gym";
                    $db_username = "root";
                    $db_password = "";

                    $conn = mysqli_connect($servername, $db_username, $db_password, $database);

                    if (!$conn) {
                        die("Koneksi gagal: " . mysqli_connect_error());
                    }

                    $query = "SELECT id_user FROM signup";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row["id_user"] . "'>" . $row["id_user"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada data user</option>";
                    }

                    mysqli_close($conn);
                    ?>
                </select>
                <input type="submit" name="delete" value="Hapus" class="delete-button">
            </form>

            <hr style="margin-right: 2rem; margin-top: 1rem">
        </div>
    </div>

    <script>
        function printData() {
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Data Member</title></head><body>');
            printWindow.document.write('<h1>Data Member</h1>');
            printWindow.document.write(document.getElementsByTagName('table')[0].outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function setIdToDelete(id) {
            document.getElementById("idToDelete").value = id;
        }
    </script>
</body>
</html>