<?php
include('koneksi.php');

// edit krs
if (isset($_GET["update"])) {


    $mahasiswa_npm = $_POST["mahasiswa"];
    $kodemk = $_POST["matkul"];
    $id = $_GET["update"];

    $sql = "UPDATE `krs` SET `mahasiswa_npm` = '" . $mahasiswa_npm . "' , `matakuliah_kodemk` = '" . $kodemk . "'WHERE `id` = '" . $id . "' ";

    $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert(" . mysqli_error($kon) . ");</script>");

    $message = 'krs berhasil diupdate';
    header("Location:krs.php?message={$message}");
}

// tambah krs
elseif (isset($_POST["matkul"])) {

    $mahasiswa_npm = $_POST["mahasiswa"];
    $kodemk = $_POST["matkul"];


    $sql = "INSERT INTO `krs` (`mahasiswa_npm`, `matakuliah_kodemk`) VALUES ('" . $mahasiswa_npm . "', '" . $kodemk . "')";


    $result = mysqli_query($kon, $sql) or die(mysqli_error($kon));

    $message = 'krs berhasil ditambahkan';
    header("Location:krs.php?message={$message}");
}

// hapus
elseif (isset($_GET["hapus"])) {

    $id = $_GET["hapus"];

    $sql = "DELETE FROM `krs` WHERE id = '" . $id . "'";

    $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

    $message = 'krs berhasil dihapus';
    header("Location:krs.php?message={$message}");
}

$sql = "SELECT * FROM `mahasiswa`";
$mhs = mysqli_query($kon, $sql);
$sql = "SELECT * FROM `matakuliah` ";
$matkul = mysqli_query($kon, $sql)

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
        <a href="krs.php" class="btn btn-dark my-5">Kembali</a>
        <?php
        if (isset($_GET["edit"])) :
            $id = $_GET["edit"];
            // Mengambil data yang akan diedit
            $sql = "SELECT * FROM `krs` WHERE id = '" . $id . "'";

            $result = mysqli_query($kon, $sql) or die("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

            foreach ($result as $krs) :
        ?>
                <form class="needs-validation" method="POST" action="form_krs.php?update=<?= $krs['id'] ?>" novalidate>
                    <div class="col-md-4 mb-6">
                        <div class="form-group">
                            <label for="validationCustom02">Kode matakuliah</label>
                            <select class="custom-select" name="matkul" required>

                                <option value="<?= $krs['matakuliah_kodemk'] ?>" selected><?= $krs['matakuliah_kodemk'] ?></option>
                                <?php
                                foreach ($matkul as $data) :
                                ?>
                                    <option value="<?= $data['kodemk'] ?>"><?= $data['nama'] ?></option>
                                <?php
                                endforeach;
                                ?>

                            </select>
                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-6">
                        <div class="form-group">
                            <label for="validationCustom02">Mahasiswa</label>
                            <select class="custom-select" name="mahasiswa" required>

                                <option value="<?= $krs['mahasiswa_npm'] ?>" selected><?= $krs['mahasiswa_npm'] ?></option>
                                <?php
                                foreach ($mhs as $data) :
                                ?>
                                    <option value="<?= $data['npm'] ?>"><?= $data['nama'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Submit form</button>
                </form>
            <?php
            endforeach;
        else : ?>

            <form class="needs-validation" method="POST" action="form_krs.php" novalidate>
                <div class="col-md-4 mb-6">
                    <div class="form-group">
                        <label for="validationCustom02">Kode matakuliah</label>
                        <select class="custom-select" name="matkul" required>

                            <option value="" disabled selected>Pilih matakuliah</option>
                            <?php
                            foreach ($matkul as $data) :
                            ?>
                                <option value="<?= $data['kodemk'] ?>"><?= $data['nama'] ?></option>
                            <?php
                            endforeach;
                            ?>

                        </select>
                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                    </div>
                </div>
                <div class="col-md-4 mb-6">
                    <div class="form-group">
                        <label for="validationCustom02">Mahasiswa</label>
                        <select class="custom-select" name="mahasiswa" required>

                            <option value="" disabled selected>Pilih mahasiswa</option>
                            <?php
                            foreach ($mhs as $data) :
                            ?>
                                <option value="<?= $data['npm'] ?>"><?= $data['nama'] ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback">Example invalid custom select feedback</div>
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