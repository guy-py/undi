<?php
    include("sambungan.php");
    include("pengundi_menu.php");

        if(isset($_POST["submit"])) {
        $idpengundi = $_POST["idpengundi"];
        $password = $_POST["password"];
        $namapengundi = $_POST["namapengundi"];

        //T00 adalah tema yang kosong - menandakan pengundi belum mengundi
        $sql = "insert into pengundi values('$idpengundi', '$namapengundi', '$password', 'T00')";

        try {
            $result = mysqli_query($sambungan, $sql);
        } catch (Throwable $e) {
            $result = False;
        }
        if ($result) {
            echo "<script>alert('Berjaya signup')</script>";
            echo "<script>window.location='index.php'</script>";
        }
        else {
            echo "<script>alert('Tidak berjaya signup')</script>";
            $collumn = explode("'", mysqli_error($sambungan))[1];
            echo "<h4>Ralat: $collumn terlalu panjang</h4>";
        }
    }
?>

<link rel="stylesheet" href="styles/borang.css">
<link rel="stylesheet" href="styles/button.css">
<link rel="stylesheet" href="styles/universal.css">

<body>
    <h3>SIGN UP</h3>
    <form name="borang" action="signup.php" method="post">
    <table>
        <tr>
            <td>ID Pengundi</td>
            <td><input type="text" name="idpengundi" placeholder="Contoh: P064"></td>
        </tr>
        <tr>
            <td>Nama Pengundi</td>
            <td><input required type="text" name="namapengundi" placeholder="Contoh: Amir"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input required type="password" name="password" placeholder="Contoh: 12345"></td>
        </tr>
    </table>
    <button class="tambah" type="submit" name="submit" onclick="return semak()">Daftar</button>
    <button class="batal" type="button" onclick="window.location='login.php'">Batal</button>
    <br>
</form>

<script>
    function semak() {
        var borang = document.forms["borang"];
        var idpengundi = borang["idpengundi"].value.trim();

        // Semak had bawah dan had atas
        if (idpengundi.length !== 4) {
            alert("id_pengundi mesti tepat 4 aksara");
            return false;
        }

        // Jika semua ok, submit form
        borang.submit();
    }
    </script>
</body>

<?php
 // Paparan footer
include('footer.php');
?>