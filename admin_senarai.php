<?php
    include("sambungan.php");
    include("admin_menu.php");
?>

<link rel="stylesheet" href="styles/senarai.css">
<link rel="stylesheet" href="styles/universal.css">

<table>
    <caption>SENARAI NAMA ADMIN</caption>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Password</th>
        <th colspan="2">Tindakan</th>
    </tr>
    
    <?php
        $sql = "select * from admin";
        $result = mysqli_query($sambungan, $sql);
        while($admin = mysqli_fetch_array($result)) {
            $idadmin = $admin["id_admin"];
            $namaadmin = $admin["nama_admin"];
            if ($idadmin !== "M00") {
                echo "<tr> <td>$admin[id_admin]</td>
                            <td class='nama'>$admin[nama_admin]</td>
                            <td>$admin[password]</td>
                            <td>
                                <a href='admin_update.php?idadmin=$admin[id_admin]'>
                                    <img class='icon' src='imej/refresh.png'>
                                </a>
                            </td>
                            <td>
                                <a href='javascript:padam(\"$idadmin\", \"$namaadmin\");'>
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
        if (confirm(`Adakah anda ingin padam admin ${nama}?`) == true) {
            window.location = "admin_delete.php?idadmin=" + id;
        }
    }
</script>

<?php
 // Paparan footer
include('footer.php');
?>