<?php
    include("sambungan.php");
include("admin_menu.php");
?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<main>
<h3>PILIH JENIS LAPORAN</h3>
<form action="laporan_cetak.php" method="post">
    <table>
        <tr>
            <td>Jenis Laporan</td>
            <td>
                <select id='pilih' name='pilih' onchange='papar_pilihan()'>
                    <option value=1>Keputusan ikut Jumlah Undi</option>
                    <option value=2>Keputusan ikut Peratus Undi</option>
                </select>
                </td>
        </tr>
    </table>
    <button class="papar" name="submit" type="submit">Papar</button>
</form>
</main>

<?php
 // Paparan footer
include('footer.php');
?>