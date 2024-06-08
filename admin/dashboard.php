<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/headeradmin.php'; ?>
</head>

<body class="dash">
    <div class="content">
        <h2>Welcome to the Admin Dashboard<span>
            <a href="profiladmin.php" class="dec">
                <i class="fa fa-user-circle" style="margin-right: 8px;"></i>Profile
            </a>
        </h2>
        <p style="margin-top: -0.8rem;">Hi, Welcome Back!</p>
        <p style="margin-top: 1.6rem;">Use the menu on the left to navigate through the different sections.</p>
    </div>

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

    <script>
        function showAdminTable() {
            var adminContent = document.getElementById("adminContent");
            adminContent.style.display = "block";
        }

        function hideAdminTable() {
            var adminContent = document.getElementById("adminContent");
            adminContent.style.display = "none";
        }
    </script>
    <script src="https://kit.fontawesome.com/0305f8347c.js" crossorigin="anonymous"></script>
</body>
</html>