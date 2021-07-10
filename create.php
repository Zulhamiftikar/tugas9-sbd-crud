<!DOCTYPE html>
<html>
<head>
    <title>FORM TAMBAH FILM </title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama=input($_POST["nama"]);
        $id_rak=input($_POST["id_rak"]);
        $id_kategori=input($_POST["id_kategori"]);
    

        //Query input menginput data kedalam tabel anggota
        $sql="insert into film (nama,id_rak,id_kategori) values
		('$nama','$id_rak','$id_kategori')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>TAMBAHKAN DATA FILM </h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan nama" required />

        </div>

        <div class="form-group">
            <label>id_rak:</label>
            <textarea name="id_rak" class="form-control" rows="5"placeholder="Masukan rak" required></textarea>

    
        <div class="form-group">
            <label>id_kategori:</label>
            <input type="text" name="id_kategori" class="form-control" placeholder="Masukan kategori"required/>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
    </form>
</div>
</body>
</html>