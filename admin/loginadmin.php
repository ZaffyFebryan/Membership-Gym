<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];

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

    // Query untuk memeriksa apakah username ada dalam database
    $query = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    if ($query) {
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            // Username ditemukan, periksa apakah password cocok
            $row = $result->fetch_assoc();
            if ($password === $row['password']) { // Membandingkan password yang dimasukkan dengan yang ada di database
                // Password cocok, simpan data login ke sesi dan redirect ke halaman admin
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['username'] = $username;

                // Menyimpan data login ke database
                $login_query = $conn->prepare("INSERT INTO login_admin (username, password, login_time) VALUES (?, ?, NOW())");
                if ($login_query) {
                    $login_query->bind_param("ss", $username, $password);
                    $login_query->execute();
                    $login_query->close();
                } else {
                    die("Error preparing login query: " . $conn->error);
                }

                header("Location: dashboard.php");
                exit();
            } else {
                // Password tidak cocok, tampilkan pesan error
                $error_message = "Password salah.";
            }
        } else {
            // Username tidak ditemukan, tampilkan pesan error
            $error_message = "Username tidak ditemukan.";
        }
        $query->close();
    } else {
        $error_message = "Query preparation failed: " . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #241c15;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #333;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            text-align: center;
            width: 300px;
        }
        .login-container h1 {
            margin-bottom: 1.5rem;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            background-color: #e0ac1c;
            color: #241c15;
            cursor: pointer;
        }
        .error-message {
            color: red;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <?php
        if (isset($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>
    </div>
</body>
</html>