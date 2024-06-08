<?php
session_start();
if (isset($_POST['nama_depan'])) {

    $nama_depan = $_POST["nama_depan"];
    $nama_belakang = $_POST["nama_belakang"];
    $email = $_POST["email"];
    $tgl_lahir = $_POST["tgl_lahir"];
    $no_telp = $_POST["no_telp"];
    $password = $_POST["password"];

    $servername = "localhost";
    $database = "membership_gym";
    $username = "root";
    $password_db = "";

    $conn = mysqli_connect($servername, $username, $password_db, $database);

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $query_get_next_id = "SELECT CONCAT('U', LPAD(COALESCE(MAX(SUBSTRING(id_user, 2) + 1), 4), 7, '0')) AS next_id FROM signup";
    $result_get_next_id = mysqli_query($conn, $query_get_next_id);
    $row = mysqli_fetch_assoc($result_get_next_id);
    $next_id = $row['next_id'];

    $query_sql = "INSERT INTO signup (id_user, nama_depan, nama_belakang, tgl_lahir, no_telp, email, password) 
                  VALUES ('$next_id', '$nama_depan', '$nama_belakang', '$tgl_lahir', '$no_telp', '$email', '$password')";

    if (mysqli_query($conn, $query_sql)) {

        $_SESSION['signup_data'] = [
            'id_user' => $next_id,
            'email' => $email,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'tgl_lahir' => $tgl_lahir,
            'no_telp' => $no_telp
        ];

        echo "<script>window.location.href = 'login.php';</script>";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../register/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/0305f8347c.js" crossorigin="anonymous"></script>
</head>

<body class="signup">
    <section class="login">
        <div class="kanan">
            <a href="index.php" style="text-decoration: none;"><p class="satu">Gym.</p></a>
            <p class="dua">Sign up</p>
            <p class="tiga">The email has to be the same email registered <br>under your membership</p>
            <form action="signup.php" method="POST" class="form">
                <div class="a">
                    <label for="nama_depan" style="padding-right: 33px;">Nama Depan </label>
                    <input type="text" id="nama_depan" name="nama_depan" required style="border-radius: 8px;"><br>
                    <label for="nama_belakang" style="padding-right: 5px;">Nama Belakang </label>
                    <input type="text" id="nama_belakang" name="nama_belakang" required style="border-radius: 8px;"><br>
                    <label for="email" style="padding-right: 108px;">Email </label>
                    <input type="email" id="email" name="email" required style="border-radius: 8px;"><br>
                    <label for="tgl_lahir" style="padding-right: 29px;">Tanggal Lahir </label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" required style="border-radius: 8px;"><br>
                    <label for="no_telp" style="padding-right: 84px;">Telepon </label>
                    <input type="text" id="no_telp" name="no_telp" required style="border-radius: 8px;"><br>
                    <label for="password" style="padding-right: 68px;">Password </label>
                    <input type="password" id="password" name="password" required style="border-radius: 8px;"><br>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="tph" name="tph" required>
                    <label for="tph">I have read and accepted the <a href="terms.html"><i><u>Terms and <br>Conditions</u></i></a>, <a href="privacy.html"><i><u>Privacy Policy</u></i></a> and <a href="health.html"><i><u>Health Statement</u></i></a>.</label>
                </div>
                <button type="submit" class="log">Sign Up</button>
            </form>
            <p class="empat">
                <a href="login.php">Back to Login</a>
            </p>
        </div>
    </section>
</body>
</html>