<?php
    include("sambungan.php");
    include("admin_menu.php");

    $idtema = $_GET["idtema"];
    print_r($idtema);
    $sql = "DELETE FROM tema WHERE id_tema = '$idtema'";
    try{
        $result = mysqli_query($sambungan, $sql);
    } catch(Throwable $e) {
        echo "<script>alert('Tidak boleh delete tema ini \n kerana mempunyai penghubung dengan pengundi.')</script>";
    }

    echo "<script>window.location='tema_senarai.php'</script>";
?>