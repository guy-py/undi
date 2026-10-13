<?php
    /*
        fail admin_update.php perlu dipanggil
        dari fail admin_senarai.php
    */
    include("sambungan.php");
    include("admin_menu.php");

if (isset($_GET['idadmin'])){
    $idadmin = $_GET['idadmin'];
}

if (isset($_POST["submit"])) {
    $idadmin = $_POST["idadmin"];
    $namaadmin = $_POST["namaadmin"];
    $password = $_POST["password"];

    $sqli = "update admin
                    set nama_admin = '$namaadmin', password = '$password'
                    where id_admin = '$idadmin' ";

    $result = mysqli_query($sambungan, $sqli);

    $sqli_count = "SELECT * FROM admin COUNT
                        where id_admin = '$idadmin'";

    $result_count = mysqli_query($sambungan, $sqli_count);


    if ($result_count == "0"){
        echo "<h4>ID Admin tidak wujud<h4>";

    } else {

        if ($result == TRUE) {
        echo "<h4>Berjaya kemaskini</h4>";

        } else {
        echo "<h4>Ralat : $sql<br>".mysqli_error($sambungan)."</h4>";
        }
    }
}

    // idadmin dari fail admin_senarai.php

$sql = "select * from admin where id_admin = '$idadmin' ";
$result = mysqli_query($sambungan, $sql);
while($admin = mysqli_fetch_array($result)) {
$password = $admin['password'];
$namaadmin = $admin['nama_admin'];
}
?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<h3>KEMASKINI ADMIN</h3>
<form action="admin_update.php" method="post">
    
    <table>
        <tr>
            <td>ID Admin</td>
            <td><input type="text" name="idadmin" value="<?php echo $idadmin; ?>" ></td>
        </tr>
        <tr>
            <td>Nama Admin</td>
            <td><input type="text" name="namaadmin" value="<?php echo $namaadmin; ?>" ></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" value="<?php echo $password; ?>" ></td>
        </tr>
    </table>
    <button class="update" type="submit" name="submit">Update</button>
</form>

<?php
 // Paparan footer
include('footer.php');
?>