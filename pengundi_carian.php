<?php
    include("sambungan.php");
    include("admin_menu.php");
?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<main>
    <h3>CARIAN PENGUNDI</h3>
    <form action="pengundi_maklumat.php" method="post">
        <table>
            <tr>
                <td>pengundi</td>
                <td>
                    <select name="idpengundi">
                    <?php
                        $sql = "select * from pengundi";
                        $data = mysqli_query($sambungan, $sql);
                        while($pengundi = mysqli_fetch_array($data)){
                            echo "<option value='$pengundi[id_pengundi]'>
                            $pengundi[nama_pengundi]</option>";
                        }
                    ?>
                    </select>
                </td>
            </tr>
        </table>
        <button class="cari" type="submit" name="submit">Cari</button>
    </form>
</main>

<?php
 // Paparan footer
include('footer.php');
?>