<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>

<body class="dtad">
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
            <h2>Data Admin<span>
                <a href="profiladmin.php" style="margin-left: 46rem; margin-right: 2rem;">
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
            $usernameToDelete = $_POST['usernameToDelete'];
            $deleteQuery = "DELETE FROM admin WHERE username = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("s", $usernameToDelete);
            if ($stmt->execute()) {
            echo "Admin dengan username $usernameToDelete berhasil dihapus.";
            } else {
            echo "Error: " . $stmt->error;
            }
            $stmt->close();
            }

                $query = "SELECT nama_depan, nama_belakang, alamat, telpon, username, password FROM admin";
                $result = mysqli_query($conn, $query);
            
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {

                        echo "<table>";
                        echo "<tr><th>Nama Depan</th><th>Nama Belakang</th><th>Alamat</th><th>Telpon</th><th>Username</th><th>Password</th></tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["nama_depan"] . "</td>";
                            echo "<td>" . $row["nama_belakang"] . "</td>";
                            echo "<td>" . $row["alamat"] . "</td>";
                            echo "<td>" . $row["telpon"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["password"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Tidak ada data admin.";
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
                <label for="usernameToDelete">Pilih username admin untuk dihapus:</label>
                <select name="usernameToDelete" id="usernameToDelete" onchange="setUsernameToDelete(this.value)">
                    <option value="">Pilih Username</option>
                    <?php

                    $servername = "localhost";
                    $database = "membership_gym";
                    $db_username = "root";
                    $db_password = "";

                    $conn = mysqli_connect($servername, $db_username, $db_password, $database);

                    if (!$conn) {
                        die("Koneksi gagal: " . mysqli_connect_error());
                    }

                    $query = "SELECT username FROM admin";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row["username"] . "'>" . $row["username"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada data admin</option>";
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
                    printWindow.document.write('<html><head><title>Data Admin</title></head><body>');
                    printWindow.document.write('<h1>Data Admin</h1>');
                    printWindow.document.write(document.getElementsByTagName('table')[0].outerHTML);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                }
            
                function setUsernameToDelete(username) {
                    document.getElementById("usernameToDelete").value = username;
                }
            </script>
</body>
</html>