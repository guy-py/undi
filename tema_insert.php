<?php
include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {
$idtema = $_POST["idtema"];
        $namatema = $_POST["namatema"];
$moto = $_POST["moto"];
        $idadmin = $_POST["idadmin"];
        
        $namafail = $idtema.".png";
        $sementara = $_FILES["namafail"]["tmp_name"];
        move_uploaded_file($sementara, "imej/".basename($namafail));
        
$sql = "insert into tema values('$idtema', '$namatema', '$namafail', '$moto', '$idadmin')";
$result = mysqli_query($sambungan, $sql);
if ($result == true)
echo "<h4>Berjaya tambah</h4>";
else
echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
}
?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<h3>BORANG TAMBAH tema</h3>
<form action="tema_insert.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
        <td>ID tema</td>
        <td><input required type="text" name="idtema" placeholder="Contoh: T01"></td>
        </tr>
        <tr>
            <td>Nama tema</td>
            <td><input type="text" name="namatema" placeholder="Contoh: Flora dan Fauna"></td>
        </tr>
        <tr>
            <td>Gambar 350x320</td>
            <td><input type="file" name="namafail" accept=".png, .jpg"></td>
        </tr>
        <tr>
            <td>Penerangan</td>
            <td><input type="text" name="moto" placeholder="Maximum: 140 aksara"></td>
        </tr>
        <tr>
            <td>Admin</td>
            <td>
                <select name="idadmin">
                <?php
                    $sql = "select * from admin";
                    $data = mysqli_query($sambungan, $sql);
                    while($admin = mysqli_fetch_array($data)){
                    echo "<option value='$admin[id_admin]'>$admin[nama_admin]</option>";
                    }
                ?>
                </select>
            </td>
            </tr>
    </table>
    <button class="tambah" type="submit" name="submit">Tambah</button>
</form>

<?php
// Paparan footer
include('footer.php');
?>