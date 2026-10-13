<?php
    include("sambungan.php");
include("admin_menu.php");
?>

<link rel="stylesheet" href="styles/senarai.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<table>
    <caption>SENARAI NAMA TEMA</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Moto</th>
        <th colspan="3">Tindakan</th>
    </tr>

    <?php
        $sql = "select * from tema";
        $result = mysqli_query($sambungan, $sql);
        while($tema = mysqli_fetch_array($result)) {
            $idtema = $tema["id_tema"];
            $namatema = $tema["nama_tema"];

            if ($idtema !== "T00"){
            
                echo "<tr> <td>$tema[id_tema]</td>
                        <td>$tema[nama_tema]</td>
                        <td><img width= 100 src= 'imej/$tema[gambar]'></td>
                        <td>$tema[penerangan]</td>
                        <td>
                            <a href='tema_update.php?idtema=$idtema' title='update'>
                                <img class='icon' src='imej/refresh.png'>
                            </a>
                        </td>
                        <td>
                            <a href='javascript:padam(\"$idtema\", \"$namatema\");' title='delete'>
                                <img class='icon' src='imej/delete.png'>
                            </a>
                        </td>
                    </tr>";
            
            }
        }
    ?>
</table>

<script>
    function padam(id, nama) {
        if (confirm(`Adakah anda ingin padam tema ${nama}?`) == true) {
            window.location = "tema_delete.php?idtema=" + id;
        }
    }
</script>

<?php
// Paparan footer
include('footer.php');
?>