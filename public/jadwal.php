<?php
if (isset($_POST['submit'])) {
    $tanggal_latihan = $_POST["tanggal_latihan"];
    $waktu_latihan = $_POST["waktu_latihan"];
    $trainer = $_POST["trainer"];
    
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];
    } else {
        die("ID User tidak ditemukan");
    }

    $servername = "localhost";
    $database = "membership_gym";
    $username = "root";
    $password_db = "";

    $conn = mysqli_connect($servername, $username, $password_db, $database);

    if (!$conn) {
        die("Koneksi Gagal : " . mysqli_connect_error());
    }

    $query_get_last_jadwal_id = "SELECT id_jadwal FROM jadwal ORDER BY id_jadwal DESC LIMIT 1";
    $result_jadwal = mysqli_query($conn, $query_get_last_jadwal_id);

    if ($result_jadwal && mysqli_num_rows($result_jadwal) > 0) {
        $row_jadwal = mysqli_fetch_assoc($result_jadwal);
        $last_jadwal_id = $row_jadwal['id_jadwal'];

        $new_jadwal_id = 'JD' . sprintf('%d', substr($last_jadwal_id, 2) + 1);
    } else {
        $new_jadwal_id = 'JD1';
    }

    switch ($trainer) {
        case 'EKO':
            $id_trainer = 'TRN0000001';
            break;
        case 'EMA':
            $id_trainer = 'TRN0000002';
            break;
        case 'WONGKA':
            $id_trainer = 'TRN0000003';
            break;
        case 'AGHATA':
            $id_trainer = 'TRN0000004';
            break;
        default:
            $id_trainer = '';
    }

    $query_sql = "INSERT INTO jadwal (id_jadwal, id_user, id_trainer, tanggal_latihan, waktu_latihan, trainer) 
                  VALUES ('$new_jadwal_id', '$id_user', '$id_trainer', '$tanggal_latihan', '$waktu_latihan', '$trainer')";

    if (mysqli_query($conn, $query_sql)) {
        echo "<script>window.location.href = 'testdisplay.php';</script>";
        exit();
    } else {
        echo "Error: " . $query_sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/header.php'; ?>
</head>

<body class="jadwal">
    <nav class="navbar" style="background-color: #241c15;">
        <a href="indexnew.php" class="navbar-logo">Membership<span>Gym.</span></a>
    </nav>

    <section class="form">
        <div class="keseluruhan">
            <div class="kiri">
                <h1>SET UP <br>YOUR SCHEDULE </h1>
                <img src="../public/img/profile.png" alt="">
            </div>
            <div class="kanan">
                <div class="info">
                    <h3 class="satu"><span>•</span>PROFILE</h3>
                    <h3 class="dua"><span>2</span>SCHEDULE</h3>
                    <h3 class="tiga"><span>•</span>PAYMENT</h3>
                </div>

                <form id="myForm" action="jadwal.php?id_user=<?php echo htmlspecialchars($_GET['id_user']); ?>" method="POST">
                    <label for="tanggal_latihan">Tanggal Latihan:</label>
                    <input type="date" id="tanggal_latihan" name="tanggal_latihan" required><br><br>
                    
                    <label for="waktu_latihan">Waktu Latihan:</label>
                    <select id="waktu_latihan" name="waktu_latihan" required style="font-family: 'Poppins', sans-serif;">
                        <option value="" disabled selected>Set the Date</option>
                        <option value="PAGI">PAGI</option>
                        <option value="SIANG">SIANG</option>
                        <option value="SORE">SORE</option>
                        <option value="MALAM">MALAM</option>
                    </select><br><br>
                    
                    <label for="trainer">Trainer:</label>
                    <select id="trainer" name="trainer" required>
                        <option value="" disabled selected>Select a trainer</option>
                        <option value="EKO">EKO</option>
                        <option value="EMA">EMA</option>
                        <option value="WONGKA">WONGKA</option>
                        <option value="AGHATA">AGHATA</option>
                    </select><br><br>

                    <input type="submit" name="submit" value="Continue">
                </form>
            </div>
        </div>
    </section>
</body>
</html>