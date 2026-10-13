<?php
    include("sambungan.php");
include("pengundi_menu.php");
?>

<link rel="stylesheet" href="styles/senarai.css">
<link rel="stylesheet" href="styles/universal.css">

<table>
    <caption>SENARAI tema</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Penerangan</th>
    </tr>

    <?php
        $sql = "select * from tema";
        $result = mysqli_query($sambungan, $sql);
        while($tema = mysqli_fetch_array($result)) {
            if ($tema['id_tema'] != 'T00')
            echo "<tr> <td>$tema[id_tema]</td>
                    <td>$tema[nama_tema]</td>
                    <td><img width= 100 src= 'imej/$tema[gambar]'></td>
                    <td>$tema[penerangan]</td>
                </tr>";
        }
    ?>
</table>

<?php
// Paparan footer
include('footer.php');
?>