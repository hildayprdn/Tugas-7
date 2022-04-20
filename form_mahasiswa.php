<?php
include('koneksi.php');

// edit mahasiswa
if (isset($_GET["update"])) {


  $nama = $_POST["nama"];
  $npm = $_GET["update"];
  $jurusan = $_POST["jurusan"];
  $alamat = $_POST["alamat"];

  $sql = "UPDATE `mahasiswa` SET `npm` = '" . $npm . "' , `nama` = '" . $nama . "' , `jurusan` = '" . $jurusan . "' , `alamat` = '" . $alamat . "' WHERE `npm` = '" . $npm . "' ";

  $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert(" . mysqli_error($kon) . ");</script>");

  $message = 'mahasiswa berhasil diupdate';
  header("Location:mahasiswa.php?message={$message}");
}

// tambah mahasiswa
elseif (isset($_POST["nama"])) {

  $nama = $_POST["nama"];
  $npm = $_POST["npm"];
  $jurusan = $_POST["jurusan"];
  $alamat = $_POST["alamat"];

  $sql = "INSERT INTO `mahasiswa` (`nama`, `npm`, `jurusan`, `alamat`) VALUES ('" . $nama . "', '" . $npm . "', '" . $jurusan . "', '" . $alamat . "')";


  $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

  $message = 'mahasiswa berhasil ditambahkan';
  header("Location:mahasiswa.php?message={$message}");
}

// hapus
elseif (isset($_GET["hapus"])) {

  $id = $_GET["hapus"];

  $sql = "DELETE FROM `mahasiswa` WHERE npm = $id";

  $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

  $message = 'mahasiswa berhasil dihapus';
  header("Location:mahasiswa.php?message={$message}");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title>Form Mahasiswa</title>
</head>

<body>
  <div class="container pt-5">
    <a href="mahasiswa.php" class="btn btn-dark my-5">Kembali</a>

    <?php
    if (isset($_GET["edit"])) :
      $id = $_GET["edit"];
      // Mengambil data yang akan diedit
      $sql = "SELECT * FROM `mahasiswa` WHERE npm = $id";

      $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

      foreach ($result as $data) :
    ?>

        <form class="needs-validation" action="form_mahasiswa.php?update=<?= $data['npm'] ?>" method="POST" novalidate>
          <div class="form-row">
            <div class="col-md-4 mb-6">
              <label for="validationCustom01">Nama</label>
              <input name="nama" type="text" class="form-control" value="<?= $data['nama'] ?>" id="validationCustom01" required>
              <div class="invalid-feedback">
                Please provide a valid Name
              </div>
            </div>
            <div class="col-md-4 mb-6">
              <div class="form-group">
                <label for="validationCustom02">Jurusan</label>
                <select name="jurusan" class="custom-select" required>
                  <option value="<?= $data['jurusan'] ?>" selected><?= $data['jurusan'] ?></option>
                  <option value="Teknik Informatika">Teknik Informatika</option>
                  <option value="Sistem Operasi">Sistem Operasi</option>
                </select>
                <div class="invalid-feedback">Example invalid custom select feedback</div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-6">
              <label for="validationCustom03">Alamat</label>
              <input name="alamat" value="<?= $data['alamat'] ?>" type="text" class="form-control" id="validationCustom03" required>
              <div class="invalid-feedback">
                Please provide a valid address.
              </div>
            </div>
          </div>
          <button class="btn btn-primary mt-3" type="submit">Submit form</button>
        </form>
      <?php
      endforeach;
    else : ?>
      <form class="needs-validation" action="form_mahasiswa.php" method="POST" novalidate>
        <div class="form-row">
          <div class="col-md-4 mb-6">
            <label for="validationCustom01">Nama</label>
            <input name="nama" type="text" class="form-control" id="validationCustom01" required>
            <div class="invalid-feedback">
              Please provide a valid Name
            </div>
          </div>
          <div class="col-md-4 mb-6">
            <label for="validationCustom02">NPM</label>
            <input name="npm" type="text" class="form-control" id="validationCustom02" required>
            <div class="invalid-feedback">
              Please provide a valid NPM
            </div>
          </div>
          <div class="col-md-4 mb-6">
            <div class="form-group">
              <label for="validationCustom02">Jurusan</label>
              <select name="jurusan" class="custom-select" required>
                <option value="" disabled selected>Pilih Jurusan</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Operasi">Sistem Operasi</option>
              </select>
              <div class="invalid-feedback">Example invalid custom select feedback</div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-6">
            <label for="validationCustom03">Alamat</label>
            <input name="alamat" type="text" class="form-control" id="validationCustom03" required>
            <div class="invalid-feedback">
              Please provide a valid address.
            </div>
          </div>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Submit form</button>
      </form>

    <?php endif; ?>
  </div>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>