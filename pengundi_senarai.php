<?php
    include("sambungan.php");
include("admin_menu.php");
?>

<link rel="stylesheet" href="styles/senarai.css">
<link rel="stylesheet" href="styles/universal.css">
<table>
    <caption>SENARAI NAMA PENGUNDI</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Password</th>
        <th>Tema</th>
        <th colspan="2">Tindakan</th>
    </tr>

    <?php
        $sql = "select * from pengundi";
        $result = mysqli_query($sambungan, $sql);
        while($pengundi = mysqli_fetch_array($result)) {
        $idpengundi = $pengundi["id_pengundi"];
        $namapengundi = $pengundi["nama_pengundi"];

            if ($idpengundi !== "P000"){
                echo "<tr> <td>$pengundi[id_pengundi]</td>
                            <td class='nama'>$pengundi[nama_pengundi]</td>
                            <td>$pengundi[password]</td>
                            <td>$pengundi[id_tema]</td>
                            <td>
                                <a href='pengundi_update.php?idpengundi=$idpengundi'>
                                    <img class='icon' src='imej/refresh.png'>
                                </a>
                            </td>
                            <td>
                                <a href='javascript:padam(\"$idpengundi\", \"$namapengundi\");'>
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
        if (confirm(`Adakah anda ingin padam ${nama}?`) == true) {
            window.location="pengundi_delete.php?idpengundi=" + id;
        }
    }
</script>

<?php
 // Paparan footer
include('footer.php');
?>