<?php
// memanggil koneksi
include('koneksi.php');
// mengambil data matakuliah 
$query = mysqli_query($kon, "SELECT * FROM matakuliah");

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
  <p class="lead">Ini adalah halaman CRUD Mata Kuliah</p>
  <a href="index.php" class="btn btn-dark">Kembali</a>
</div>
<div class="container">
<a href="form_matakuliah.php" class="btn btn-primary my-4">Tambah Matakuliah</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode Matkul</th>
      <th scope="col">Nama</th>
      <th scope="col">Jumlah SKS</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- Menampilkan setiap data  -->
  <?php 
  $no=1;
  
  foreach($query as $matakuliah):
    ?>
    <tr>
      <th scope="row"><?=$no?></th>
      <td><?=$matakuliah['kodemk']?></td>
      <td><?=$matakuliah['nama']?></td>
      <td><?=$matakuliah['jumlah_sks']?></td>
      <td>
        <a href="form_matakuliah.php?edit=<?=$matakuliah['kodemk']?>" class="btn btn-info">Edit</a>
        <a href="form_matakuliah.php?hapus=<?=$matakuliah['kodemk']?>" class="btn btn-danger">Hapus</a>
      </td>
    </tr>
<?php
endforeach 
?>
  </tbody>
</table>
</div>
    
</body>
</html>