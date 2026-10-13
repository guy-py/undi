<?php
    /*
    terdapat dua jenis pengguna iaitu
        1. Pengundi 2. Admin
    kedua-dua pengguna di atas
    menggunakan borang login yang sama
    untuk masuk ke dalam sistem
    */

    include("sambungan.php");
    include("pengundi_menu.php");

    if (isset($_POST["submit"])) {
        $userid = $_POST["userid"];
        $password = $_POST["password"];

        $jumpa = FALSE;

        if ($jumpa == FALSE) {
            $sql = "SELECT * FROM pengundi";
            $result = mysqli_query($sambungan, $sql);
            while($pengundi = mysqli_fetch_array ($result)) {
                if ($pengundi["id_pengundi"] == $userid && $pengundi["password"] == $password) {
                    $jumpa = TRUE;
                    $_SESSION["idpengguna"] = $pengundi["id_pengundi"];
                    $_SESSION["nama"] = $pengundi["nama_pengundi"];
                    $_SESSION["status"] = "pengundi";
                    break;
                }
            }
        }

        if ($jumpa == FALSE) {
            $sql = "SELECT * FROM admin";
            $result = mysqli_query($sambungan, $sql);
            while($admin = mysqli_fetch_array($result)) {
                if ($admin["id_admin"] == $userid && $admin["password"] == $password) {
                    $jumpa = TRUE;
                    $_SESSION["idpengguna"] = $admin["id_admin"];
                    $_SESSION["nama"] = $admin["namaadmin"];
                    $_SESSION["status"] = "admin";
                    break;
                }
            }
        }

        if ($jumpa == TRUE){
            echo "<script>alert('Daftar masuk berjaya');</script>";
            if ($_SESSION["status"] == "pengundi")
                header("Location: index.php");
            else if ($_SESSION["status"] == "admin")
                header("Location: tema_senarai.php");
        } else {
            echo "<script>alert('kesalahan pada username atau password');</script>";
        }
    }
?>

<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/universal.css">

<body>
    <h3>LOG MASUK</h3>
    <form action="login.php" method="post">
        <table>
            <tr>
                <td>ID Pengguna</td>
                <td><input type="text" name="userid" placeholder="ID pengguna"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" placeholder="password"></td>
            </tr>
        </table>
        <button class="login" type="submit" name="submit">
            Log Masuk
        </button>
        <button class="tambah" type="button" onclick="window.location='signup.php'">
            Daftar
        </button>
        <br><br>
        Belum ada username? Klik daftar
    </form>
</body>

<?php
 // Paparan footer
include('footer.php');
?>


