<?php
    include("sambungan.php");
include("admin_menu.php");
?>

<link rel="stylesheet" href="styles/senarai.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<main>
    <div id="printarea">
    <?php
            if (isset($_POST['submit'])) {
            $pilih = $_POST['pilih'];
        
            $sql = "select tema.id_tema, nama_tema, count(*) as jum_ikut_tema from pengundi
                join tema on pengundi.id_tema = tema.id_tema
                group by id_tema order by jum_ikut_tema desc";
        
            $result = mysqli_query($sambungan, $sql);
            
            if ($pilih == 1) {
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jumlah undi</th>
                        </tr>";
                            
                while($undian = mysqli_fetch_array($result)) {
                    if ($undian['id_tema'] != 'T00') {
                        echo "<tr> <td>$undian[id_tema]</td>
                                    <td>$undian[nama_tema]</td>
                                    <td>$undian[jum_ikut_tema]</td>
                            </tr>";
                        }
                        }
                echo "<caption><img src='imej/tajuk.png' width=400><br>
                SENARAI TEMA MENGIKUT BILANGAN UNDI</caption></table>";
            }
        
                        if ($pilih == 2) {
                    
                $sql_undi = "select * from pengundi where id_tema != 'T00' ";
                $result_undi = mysqli_query($sambungan, $sql_undi);
                $jum_semua_undi = mysqli_num_rows($result_undi);
                
                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Carta</th>
                            <th>Peratus</th>
                        </tr>";
                
                while ($undian = mysqli_fetch_array($result)) {

                    $peratus_belum_format = $undian['jum_ikut_tema']/$jum_semua_undi*100;
                        $peratus = number_format($peratus_belum_format, 1);
                                if ($undian['id_tema'] != 'T00') {
                    echo "<tr> <td>$undian[id_tema]</td>
                                    <td>$undian[nama_tema]</td>
                                    <td><progress value=$peratus max=100></progress></td>
                                    <td>$peratus%</td>
                            </tr>";
                }
                }
                echo "<caption><img src='imej/tajuk.png' width=400><br>
                SENARAI TEMA MENGIKUT PERATUS UNDI</caption></table>";
            }
    }
    ?>
    </div>
    <center>
        <button class="cetak" onclick="printPageArea()">Cetak</button>
    </center>
</main>

<script>
    function printPageArea(){
        var printContent = document.getElementById("printarea").innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>

<?php
 // Paparan footer
include('footer.php');
?>