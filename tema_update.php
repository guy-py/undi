<?php
    /*
        fail tema_update.php perlu dipanggil
        dari fail tema_senarai.php
    */
include("sambungan.php");
include("admin_menu.php");

if (isset($_POST["submit"])) {
$idtema = $_POST["idtema"];
        $namatema = $_POST["namatema"];
$penerangan = $_POST["penerangan"];
        
        $namafail = $idtema.".png";
        $sementara = $_FILES["namafail"]["tmp_name"];
        move_uploaded_file($sementara, "imej/".basename($namafail));
        
$sql = "update tema set
                nama_tema = '$namatema', gambar = '$namafail', penerangan = '$penerangan'
                where id_tema = '$idtema'";
$result = mysqli_query($sambungan, $sql);
if ($result == true)
echo "<h4>Berjaya kemaskini</h4>";
else
echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
}

    // idtema dari fail tema_senarai.php
    if (isset($_GET["idtema"]))
$idtema = $_GET["idtema"];

$sql = "select * from tema where id_tema = '$idtema' ";
$result = mysqli_query($sambungan, $sql);
while($tema = mysqli_fetch_array($result)) {
$namatema = $tema["nama_tema"];
$namafail = $idtema.".png";
$penerangan = $tema["penerangan"];
}
?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<h3>KEMASKINI TEMA</h3>
<form action="tema_update.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>ID Tema</td>
            <td><input type="text" name="idtema" value="<?php echo $idtema; ?>"></td>
        </tr>
        <tr>
            <td>Nama Tema</td>
            <td><input type="text" name="namatema" value="<?php echo $namatema; ?>"></td>
        </tr>
        <tr>
            <td class="warna">Gambar 350x320</td>
            <td><input type="file" name="namafail" accept=".png, .jpg">
                <?php echo "<img width=100 src='imej/".$namafail."'>";?>
            </td>
        </tr>
        <tr>
            <td>Penerangan</td>
            <td><input type="text" name="penerangan" value="<?php echo $penerangan; ?>"></td>
        </tr>
    </table>
    <button class="update" type="submit" name="submit">Update</button>
</form>

<?php
// Paparan footer
include('footer.php');
?>