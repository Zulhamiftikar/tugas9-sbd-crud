<!DOCTYPE html>
<html>
<head>
    <title>FORM TAMBAH FILM</title>
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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]);

        $sql="select * from film where id=$id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama=input($_POST["nama"]);
        $id_rak=input($_POST["id_rak"]);
        $id_kategori=input($_POST["id_kategori"]);

        //Query update data pada tabel film
        $sql="update film set
			nama='$nama',
			id_rak='$id_rak',
			id_kategori='$id_kategori',
			where id=$id";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>NAMA:</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" placeholder="Masukan nama film" required />

        </div>
        <div class="form-group">
            <label>ID RAK:</label>
            <input type="text" name="id_rak" class="form-control" value="<?php echo $data['id_rak']; ?>" placeholder="Masukan Id rak" required/>
        </div>

        <div class="form-group">
            <label>ID KATEGORI:</label>
            <input type="text" name="id_kategori" class="form-control" value="<?php echo $data['id_kategori']; ?>" placeholder="Masukan Id kategori" required/>
        </div>

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>