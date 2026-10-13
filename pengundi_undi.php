<?php
session_start();
include("sambungan.php");

if (isset($_POST["submit"])) {

    if (!isset($_POST["idtema"])){
        echo "<script>alert('Sila buat satu undian');</script>";
        echo "<script>window.location='index.php'</script>";
    }

    $idpengundi = $_SESSION["idpengguna"];
    $idtema = $_POST["idtema"];
    
    $sudah_undi = false;
    
    $sql = "SELECT * FROM pengundi WHERE id_pengundi = '{$idpengundi}' ";
    $result = mysqli_query($sambungan, $sql);
    while($pengundi = mysqli_fetch_array($result)) {
        $password = $pengundi['password'];
        $namapengundi = $pengundi['namapengundi'];
        if ($pengundi['idtema'] != 'T00')
                $sudah_undi = true;
    }
    $sql = "update pengundi set id_tema = '$idtema'
            where id_pengundi = '$idpengundi'";

    $result = mysqli_query($sambungan, $sql);
    if ($result == true)
        echo "<script>alert('Berjaya Mengundi Tema')</script></h4>";
    else
        echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
}
echo "<script>window.location='index.php'</script>";
?>

<?php
 // Paparan footer
include('footer.php');
?>