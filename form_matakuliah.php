<?php
include('koneksi.php');

// proses edit matakuliah
if (isset($_GET["update"])) {


    $nama = $_POST["nama"];
    $kodemk = $_GET["update"];
    $jumlah_sks = $_POST["jumlah_sks"];

    $sql = "UPDATE `matakuliah` SET `nama` = '" . $nama . "' , `kodemk` = '" . $kodemk . "' , `jumlah_sks` = '" . $jumlah_sks . "' WHERE `kodemk` = '" . $kodemk . "' ";

    $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert(" . mysqli_error($kon) . ");</script>");

    $message = 'matakuliah berhasil diupdate';
    header("Location:matakuliah.php?message={$message}");
}

// proses tambah matakuliah
elseif (isset($_POST["nama"])) {

    $nama = $_POST["nama"];
    $kodemk = $_POST["kodemk"];
    $sks = $_POST["jumlah_sks"];

    $sql = "INSERT INTO `matakuliah` (`nama`, `kodemk`, `jumlah_sks`) VALUES ('" . $nama . "', '" . $kodemk . "', '" . $sks . "')";


    $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

    $message = 'matakuliah berhasil ditambahkan';
    header("Location:matakuliah.php?message={$message}");
}

// proses hapus
elseif (isset($_GET["hapus"])) {

    $id = $_GET["hapus"];

    $sql = "DELETE FROM `matakuliah` WHERE kodemk = '" . $id . "'";

    $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

    $message = 'matakuliah berhasil dihapus';
    header("Location:matakuliah.php?message={$message}");
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
    <title>Form Matakuliah</title>
</head>

<body>
    <div class="container pt-5">
        <a href="matakuliah.php" class="btn btn-dark my-5">Kembali</a>
        <?php
        if (isset($_GET["edit"])) :
            $id = $_GET["edit"];
            // mengambil data yang akan di edit
            $sql = "SELECT * FROM `matakuliah` WHERE kodemk = '" . $id . "'";

            $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

            foreach ($result as $data) :
        ?>
                <form class="needs-validation " method="POST" action="form_matakuliah.php?update=<?= $data['kodemk'] ?>" novalidate>
                    <div class="form-row">
                        <div class="col-md-4 mb-6">
                            <label for="validationCustom01">Nama</label>
                            <input type="text" class="form-control" value="<?= $data['nama'] ?>" name="nama" id="validationCustom01" value="Mark" required>
                            <div class="invalid-feedback">
                                please write!
                            </div>
                        </div>
                        <div class="col-md-4 mb-6">
                            <label for="validationCustom02">Jumlah SKS</label>
                            <input type="number" class="form-control" value="<?= $data['jumlah_sks'] ?>" name="jumlah_sks" id="validationCustom02" value="Otto" required>
                            <div class="invalid-feedback">
                                please write!
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Submit form</button>
                </form>
            <?php
            endforeach;
        else : ?>
            <form class="needs-validation" method="POST" action="form_matakuliah.php" novalidate>
                <div class="form-row">
                    <div class="col-md-4 mb-6">
                        <label for="validationCustom01">Nama</label>
                        <input type="text" class="form-control" name="nama" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            please write!
                        </div>
                    </div>
                    <div class="col-md-4 mb-6">
                        <label for="validationCustom02">Kode MK</label>
                        <input type="text" class="form-control" name="kodemk" id="validationCustom02" required>
                        <div class="invalid-feedback">
                            please write!
                        </div>
                    </div>
                    <div class="col-md-4 mb-6">
                        <label for="validationCustom02">Jumlah SKS</label>
                        <input type="number" class="form-control" name="jumlah_sks" id="validationCustom02" required>
                        <div class="invalid-feedback">
                            please write!
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3" type="submit">Submit form</button>
            </form>
        <?php endif ?>
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