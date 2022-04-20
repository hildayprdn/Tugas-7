<?php
// Mengambil data krs dan join ke table matakuliah untuk mendapat kan nilai sks
include('koneksi.php');
$query = mysqli_query($kon, "SELECT * , matakuliah.nama as matkul FROM krs LEFT JOIN matakuliah ON krs.matakuliah_kodemk = matakuliah.kodemk LEFT JOIN mahasiswa ON krs.mahasiswa_npm = mahasiswa.npm");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
  <!-- menampilkan message -->
<?php if (isset($_GET['message'])){
  ?>
    <div class="alert alert-info" role="alert">
      <?= $_GET['message'] ?>
    </div>
  <?php
  }
  ?>
<div class="jumbotron m-5">
  <h1 class="display-4">Hello, world!</h1>
  <p class="lead">Ini adalah halaman CRUD KRS.</p>
  <a href="index.php" class="btn btn-dark">Kembali</a>
</div>
<div class="container">
<a href="form_krs.php" class="btn btn-primary my-4">Tambah KRS</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nama Lengkap</th>
      <th scope="col">Matakuliah</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- menampilkan semua data -->
  <?php 
  $no=1;
  
  foreach($query as $krs):
    ?>
    <tr>
      <th scope="row"><?=$krs['id']?></th>
      <td><?=$krs['nama']?></td>
      <td><?=$krs['matkul']?></td>
      <td><span class="text-danger"><?=$krs['nama']?></span> Mengambil matakuliah <span class="text-danger"><?=$krs['matkul']?></span> ( <?=$krs['jumlah_sks']?> SKS ) </td>
      <td>
        <a href="form_krs.php?edit=<?=$krs['id']?>" class="btn btn-info">Edit</a>
        <a href="form_krs.php?hapus=<?=$krs['id']?>" class="btn btn-danger">Hapus</a>
      </td>
    </tr>
<?php endforeach ?>
  </tbody>
</table>
</div>
    
</body>
</html>