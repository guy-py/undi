<?php
    $nama_database = "undi";

    $sambungan = mysqli_connect("localhost:5173", "root", "", $nama_database);
    if ( !$sambungan ) {
        die("sambungan gagal");
    }
?>