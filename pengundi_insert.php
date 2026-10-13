<?php
include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {
    $idpengundi = $_POST["idpengundi"];
    $password = $_POST["password"];
    $namapengundi = $_POST["namapengundi"];
            
    // T00 adalah tema yang kosong - menandakan pengundi belum mengundi
    $sql = "insert into pengundi values('$idpengundi', '$password', '$namapengundi', 'T00')";
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

<h3>BORANG TAMBAH PENGUNDI</h3>
<form name="borang" action="pengundi_insert.php" method="post">
    <table>
        <tr>
            <td>ID Pengundi</td>
            <td><input type="text" name="idpengundi" placeholder="Contoh: P064"></td>
        </tr>
        <tr>
            <td>Nama Pengundi</td>
            <td><input type="text" name="namapengundi" placeholder="Contoh: Amir"></td>
            </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" placeholder="Contoh: 12345"></td>
        </tr>
    </table>
    <button class="tambah" type="submit" name="submit" onclick="return semak()">Tambah</button>
    <br>
    
</form>



<script>
function semak() {
    var borang = document.forms["borang"];
    var idpengundi = borang["idpengundi"].value.trim();

    // Semak had bawah dan had atas
    if (idpengundi.length !== 3) {
        alert("IDPengundi mesti tepat 3 aksara");
        return false;
    }

    // Jika semua ok, submit form
    alert("Berjaya semak!");
    borang.submit();
}
</script>

<?php
 // Paparan footer
include('footer.php');
?>