<!-- BAGIAN PHP -->
<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $servername = "localhost";
    $database = "membership_gym";
    $username = "root";
    $password_db = "";

    $conn = mysqli_connect($servername, $username, $password_db, $database);

    if (!$conn) {
        die("Koneksi Gagal : " . mysqli_connect_error());
    }

    $query_check_email = "SELECT * FROM signup WHERE email = '$email'";
    $result_check_email = mysqli_query($conn, $query_check_email);

    if (mysqli_num_rows($result_check_email) > 0) {
        $row = mysqli_fetch_assoc($result_check_email);
        
        if ($password === $row['password']) {
            $query_insert_login = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
            if (mysqli_query($conn, $query_insert_login)) {
                mysqli_close($conn);
                header("Location: ../indexnew.php");
                exit();
            } else {
                echo "Error: " . $query_insert_login . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Akun dengan email tersebut tidak ditemukan.";
    }
    mysqli_close($conn);
}
?>

<!-- BAGIAN HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Gym</title>
    <link rel="stylesheet" href="../register/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/0305f8347c.js" crossorigin="anonymous"></script>
</head>

<body>
    <section class="login">
        <div class="kanan">
            <a href="index.php" style="text-decoration: none;"><p class="satu" >Gym.</p></a>

            <p class="dua">Let's get you started</p>

            <p class="tiga">Enter your details to sign in or press sign up</p>

            <form action="login.php" method="POST" class="form">
                <div class="a">
                    <label for="email" style="padding-right: 41px;">Email </label>
                    <input type="text" id="email" name="email" required style="border-radius: 8px;"><br><br>
                </div>
                <div class="b">
                    <label for="password">Password </label>
                    <input type="password" id="password" name="password" required style="border-radius: 8px;"><br><br>
                </div>

                <button type="submit" class="log">Login</button>
            </form>

            <p class="empat">
                <a href="signup.php">Sign Up</a>
            </p>
        </div>
    </section>

    <script src="js/script.js"></script>
</body>
</html>