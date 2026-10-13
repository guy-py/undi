<?php
    include("sambungan.php");
    include("admin_menu.php");

    $idadmin = $_GET["idadmin"];

    $sql = "delete from admin where id_admin = '$idadmin';";
    try{
        $result = mysqli_query($sambungan, $sql);
    } catch(Throwable $e) {
        echo "<script>alert('Tidak boleh delete admin ini \n kerana mempunyai penghubung dengan tema.')</script>";
    }

    echo "<script>window.location='admin_senarai.php'</script>";
?>