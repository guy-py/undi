<?php
    include("sambungan.php");
    include("pengundi_menu.php");

    echo "<link rel='stylesheet' href='styles/button.css'>";
    echo '<link rel="stylesheet" href="styles/universal.css">';
    echo "<main>";
    
    if (isset($_SESSION["idpengguna"])) {
        $idpengundi = $_SESSION["idpengguna"];

        $sudah_mengundi = false;
        
        $sql = "SELECT * FROM pengundi
                join tema on pengundi.id_tema = tema.id_tema";

        $result = mysqli_query($sambungan, $sql);
        while($undian = mysqli_fetch_array($result)) {
            if ($undian['id_pengundi'] == $idpengundi && $undian['id_tema'] != "T00") {
                $namatema = $undian['nama_tema'];
                $sudah_mengundi = true;
                break;
            }
        }


        echo "<form method='post' action='pengundi_undi.php'>";
        echo "<div height='500px'>";
        echo "<div class=gambar>";

        $sql = "select * from tema";
        $result = mysqli_query($sambungan, $sql);
        while($tema = mysqli_fetch_array($result)) {
            if ($tema['id_tema'] != 'T00') {
                echo "<figure>
                        <img id='zoom' class='home' onclick='toggleScale(this)' style='transition:0.2s' src='imej/$tema[gambar]'>
                        <p></p>
                        <figcaption>
                            {$tema['nama_tema']}";
                
                if (isset($undian)) {
                    if ($tema['id_tema'] == $undian['id_tema']){
                        $command = 'document.getElementById("tukar").style.setProperty("display", "none");
                                    document.getElementById("status").style.setProperty("display", "block");';
                        echo "<input type='radio' name='idtema' value='$tema[id_tema]' onchange='$command' checked>";
                    } else {
                        $command = 'document.getElementById("tukar").style.setProperty("display", "block");
                                    document.getElementById("status").style.setProperty("display", "none");';
                        echo "<input type='radio' name='idtema' value='$tema[id_tema]' onchange='$command'>";
                    }
                } else {
                    $command = 'document.getElementById("undi").style.setProperty("display", "block");';
                    echo "<input type='radio' name='idtema' value='$tema[id_tema]' onchange='$command'>";
                }

                echo   "</figcaption>
                    </figure>";
            }
        }
        echo "</div><p></p>";
        
        if ($sudah_mengundi == true){
            echo "<center>
                <p id='status' class='arahan'>Status : Anda telah mengundi <b>$namatema</b></p>";
            
            echo "<button id='tukar' class='tambah' type='submit' name='submit' style='display: none; width: 150;'>Tukar undi</button>";
            
            echo "</center>
            </form>";
        }else{
           echo "<center>
                <p class='arahan'>Status : belum mengundi, Pilih tema yang sesuai dan klik butang undi</p>
                <button id='undi' class='tambah' type='submit' name='submit' style='display: none;'>Undi</button>
            </center>
            </form>";
        }
        
    } else {
        echo "<div class='gambar'>";
        $sql = "SELECT * FROM tema";
        $result = mysqli_query($sambungan, $sql);
        while ($tema = mysqli_fetch_array($result)) {
            if ($tema['id_tema'] != 'T00')
                    echo "<img class='home' src='imej/$tema[gambar]' >";
        }
        echo "</div>";
    }
    if (true or false){
        echo "you";
    }
    echo "</main>";
?>

<script>
    function toggleScale(e) {
        var element = e
        if (element.zoomed === true) {
            element.style.transform = "scale(1)";
            element.setAttribute("style", "z-index: 5;");
            element.style.transition = "0.2s";
            element.zoomed = false;
        } else {
            element.setAttribute("style", "z-index: 10;");
            element.style.transition = "0.2s";
            const rect = element.getBoundingClientRect();
            console.log(rect.right);
            console.log(rect.bottom);
            const x = ((rect.right + rect.left) / -2) + (window.innerWidth / 2);
            const y = ((rect.bottom + rect.top) / -2) + (window.innerHeight / 2);
            const s = 1000 / (rect.right - rect.left);
            element.style.transform = `translate(${x}px, ${y}px) scale(${s})`;
            element.zoomed = true;
        }
    }
</script>

<?php
 // Paparan footer
include('footer.php');
?>