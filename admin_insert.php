<?php
    /* Program ini bertujuan untuk memasukkan admin yang baru
        pastikan idadmin tidak sama semasa memasukkan data */

include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {
    $idadmin = $_POST["idadmin"];
    $password = $_POST["password"];
    $namaadmin = $_POST["namaadmin"];

    $sql = "insert into admin values('$idadmin', '$password', '$namaadmin')";

    try {
        $result = mysqli_query($sambungan, $sql);
    } catch (Throwable $e) {
        $result = False;
    }
    if ($result) {
        echo "<script>alert('Berjaya tambah')</script>";
    } else {
        echo "<script>alert('Tidak berjaya tambah')</script>";
        $column = explode("'", mysqli_error($sambungan))[1];
        $error = explode("'", mysqli_error($sambungan))[0];
        if ($error == "Data too long for column "){
            echo "<h4>Ralat: $column terlalu panjang</h4>";
        } else {
            echo "<h4>Ralat: sudah ada $column yang sama</h4>";
        }
    }
}
?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">


<h3>BORANG TAMBAH ADMIN</h3>
<form action="admin_insert.php" method="post">
    <table>
        <tr>
            <td>ID Admin</td>
            <td><input required type="text" name="idadmin" placeholder="Contoh: M01 "></td>
        </tr>
        <tr>
            <td>Nama Admin</td>
            <td><input type="text" name="namaadmin" placeholder="Contoh: Amir"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" placeholder="Contoh: 12345"></td>
        </tr>
    </table>
    <button class="tambah" type="submit" name="submit">Tambah</button>
</form>

<?php
 // Paparan footer
include('footer.php');
?>