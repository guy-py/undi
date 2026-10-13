<?php
    include("sambungan.php");
    include("admin_menu.php");

    if (isset($_POST["submit"])) {
        $namajadual = $_POST["namajadual"];
        $namafail = $_FILES["namafail"]["name"];
        $sementara = $_FILES["namafail"]["tmp_name"];
        move_uploaded_file($sementara, "data/".$namafail);

        $fail = fopen("data/".$namafail, "r");
        while (!feof($fail)) {
            $berjaya = false;
            $baris = fgets($fail);
            $medan = explode(",", $baris);

            if (count($medan) == 1){
                break;
            }

            if (strtolower($namajadual) === "pengundi") {

                if (count($medan) !== 4){
                    echo $baris;
                    echo "<br><center><h4>Ralat: Bilangan medan mestilah 4</h4></center>";
                    $berjaya = false;
                    break;
                }

                try{
                    $idpengundi = $medan[0];
                    $password = $medan[1];
                    $namapengundi = $medan[2];
                    $idtema = $medan[3];
                    $sql = "insert into pengundi values('$idpengundi', '$password', '$namapengundi', '$idtema')";
                    mysqli_query($sambungan, $sql);
                    $berjaya = true;
                } catch (Throwable $e) {
                    echo "<br><center><h4>Ralat: $sql<br>".mysqli_error($sambungan)."</h4></center>";
                }
            }

            if (strtolower($namajadual) === "admin") {
                if (count($medan) !== 3){
                    echo "<br><center><h4>";
                    echo $baris;
                    echo "<br>Ralat: Bilangan medan mestilah 3</h4></center>";
                    $berjaya = false;
                    break;
                }

                try{
                    $idadmin = $medan[0];
                    $password = $medan[1];
                    $namaadmin = $medan[2];
                    $sql = "insert into admin values('$idadmin', '$password', '$namaadmin')";
                    mysqli_query($sambungan, $sql);
                    $berjaya = true;
                } catch (Throwable $e) {
                    echo "<br><center><h4>Ralat: $sql<br>".mysqli_error($sambungan)."</h4></center>";
                }
            }
        }

        //Menyemak proses penyimpanan data
        if ($berjaya == true)
            echo "<script>alert('Rekod berjaya diimport');</script>";
        else
            echo "<script>alert('Rekod tidak berjaya diimport');</script>";
        mysqli_close($sambungan);
    }

?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<h3>IMPORT DATA</h3>
<form action="import.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Jadual</td>
            <td>
            <select name="namajadual">
                <option>Pengundi</option>
                <option>Admin</option>
            </select>
            </td>
        </tr>
        <tr>
            <td>Fail</td>
            <td><input required type="file" name="namafail" accept=".txt"></td>
        </tr>
    </table>
    <button class="import" type="submit" name="submit">Import</button>
</form>

<?php
 // Paparan footer
include('footer.php');
?>




