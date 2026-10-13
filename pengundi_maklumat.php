<?php
    /*
        fail pengundi_maklumat.php perlu dipanggil
        dari fail pengundi_carian.php
    */
    include("sambungan.php");
    include("admin_menu.php");

$idpengundi = $_POST["idpengundi"];

$sql = "select * from pengundi where id_pengundi = '$idpengundi'";

$result = mysqli_query($sambungan, $sql);
while($pengundi = mysqli_fetch_array($result)) {
    $id_tema = $pengundi["id_tema"];
    $sqli_tema = "select * from tema where id_tema = '$id_tema'";

    $result_tema = mysqli_query($sambungan, $sqli_tema);

    $tema = mysqli_fetch_array($result_tema);

    $namapengundi = $pengundi["nama_pengundi"];
    $password = $pengundi["password"];
    if ($id_tema == "T00"){
        $id_tema = "Tiada tema yang dipilih";
    }
}
?>

<link rel="stylesheet" href="styles/senarai.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<body>
    <table class="maklumat">
        <caption>MAKLUMAT PENGUNDI</caption>
        <tr>
            <th>Perkara</th>
            <th>Maklumat</th>
        </tr>
        <tr>
            <td class="maklumat">ID Penggundi</td>
            <td class="maklumat"><?php echo $idpengundi; ?></td>
        </tr>
        <tr>
            <td class="maklumat">Nama</td>
            <td class="maklumat"><?php echo $namapengundi; ?></td>
        </tr>
        <tr>
            <td class="maklumat">Password</td>
            <td class="maklumat"><?php echo $password; ?></td>
        </tr>
        <tr>
            <td class="maklumat">Undian</td>
            <td class="maklumat"><?php echo $id_tema; ?></td>
        </tr>
    </table>
    <br><br>
    <center>
        <table class="maklumat">
            <caption>Tindakan</caption>
            <tr>
                <?php
                
                echo "
                <td style='background-color: white;'>
                <a href='pengundi_update.php?idpengundi=$idpengundi'>
                    <img class='icon' src='imej/refresh.png'>
                </a>
                </td>";
                
                
                echo "
                <td style='background-color: white;'>
                <a href='javascript:padam($idpengundi, $namapengundi);'>
                    <img class='icon' src='imej/delete.png'>
                </a>
                </td>";

                ?>
            </tr>
        <table>
    </center>
</body>

<?php
 // Paparan footer
include('footer.php');
?>


