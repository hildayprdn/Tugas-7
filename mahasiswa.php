<?php
include('koneksi.php');

// mengambil semua data mahasiswa
$query = mysqli_query($kon, "SELECT * FROM mahasiswa");

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
  <!-- Menampilkan message -->
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
    <p class="lead">Ini adalah halaman CRUD Mahasiswa.</p>
    <a href="index.php" class="btn btn-dark">Kembali</a>
  </div>
  <div class="container">
    <a href="form_mahasiswa.php" class="btn btn-primary my-4">Tambah Mahasiswa</a>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">NPM</th>
          <th scope="col">Jurusan</th>
          <th scope="col">Alamat</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
<!-- Menampilkan setiap data -->
        <?php
        $no = 1;

        foreach ($query as $mahasiswa) :
        ?>
          <tr>
            <th scope="row"><?= $no++ ?></th>
            <td><?= $mahasiswa['nama'] ?></td>
            <td><?= $mahasiswa['npm'] ?></td>
            <td><?= $mahasiswa['jurusan'] ?></td>
            <td><?= $mahasiswa['alamat'] ?></td>
            <td>
              <a href="form_mahasiswa.php?edit=<?= $mahasiswa['npm'] ?>" class="btn btn-info">Edit</a>
              <a href="form_mahasiswa.php?hapus=<?= $mahasiswa['npm'] ?>" class="btn btn-danger">Hapus</a>
            </td>
          </tr>
        <?php
        endforeach;
        ?>

      </tbody>
    </table>
  </div>

</body>

</html>