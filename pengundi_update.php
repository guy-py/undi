<?php
    /*
        fail pengundi_update.php perlu dipanggil
        dari fail pengundi_senarai.php
    */
    include("sambungan.php");
    include("admin_menu.php");

if (isset($_POST["submit"])) {
    $idpengundi = $_POST["idpengundi"];
    $password = $_POST["password"];
    $namapengundi = $_POST["namapengundi"];

    $sql2 = "select * from pengundi where id_pengundi = '$idpengundi'";
    $sql = "update pengundi
            set password = '$password', nama_pengundi = '$namapengundi'
            where id_pengundi = '$idpengundi'";
    try {
        $result = mysqli_query($sambungan, $sql);
    } catch (Throwable $e) {
        $result = False;
    }

    try {
        $result2 = mysqli_query($sambungan, $sql2);
    } catch (Throwable $e) {
        $result2 = False;
    }

    if ($result2) {
        echo "<script>alert('Berjaya kemaskini')</script>";
    } else {
        echo "<script>alert('Tidak berjaya kemaskini')</script>";
        $error = explode("'", mysqli_error($sambungan))[0];
        echo $error;
        echo mysqli_error($sambungan);
        if ($error == "Data too long for column "){
            $column = explode("'", mysqli_error($sambungan))[1];
            echo "<h4>Ralat: $column terlalu panjang</h4>";
        } else {
            echo "<h4>Ralat: $idpengundi tidak wujud</h4>";
        }
    }
}

// idpengundi dari fail pengundi_senarai.php
if (isset($_GET["idpengundi"]))
    $idpengundi = $_GET["idpengundi"];
        

$sql = "select * from pengundi where id_pengundi = '$idpengundi'";
$result = mysqli_query($sambungan, $sql);
while($pengundi = mysqli_fetch_array($result)) {
    $namapengundi = $pengundi["nama_pengundi"];
    $password = $pengundi["password"];
}
?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<h3>KEMASKINI PENGUNDI</h3>
<form action="pengundi_update.php" method="post">
    <table>
        <tr>
            <td>ID Pengundi</td>
            <td><input type="text" name="idpengundi" value="<?php echo $idpengundi; ?>"></td>
        </tr>
        <tr>
            <td>Nama Pengundi</td>
            <td><input type="text" name="namapengundi" value="<?php echo $namapengundi; ?>"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" value="<?php echo $password; ?>"></td>
        </tr>
    </table>
    <button class="update" type="submit" name="submit">Update</button>
</form>

<?php
 // Paparan footer
include('footer.php');
?>


