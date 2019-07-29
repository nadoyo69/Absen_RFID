<!DOCTYPE html>
<html>

<head>
    <title>Absensi Datang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="<?php echo base_url() ?>assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css_absen/style.css">
</head>

<body oncontextmenu="return false;">
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <div class="d-flex justify-content-center h-100">
                    <div class="container">
                        <div class="card cardbody p-3 mb-3">
                            <div class="card-body">
                                <form>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input readonly class="form-control" value="<?php echo date("d-m-Y") ?>">
                                    </div>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                        <div class="form-control"><i id="jam"></i>:<i id="menit"></i>:<i id="detik"></i>
                                        </div>
                                    </div>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user-circle-o"></i></span>
                                        </div>
                                        <div class="form-control"><?= $total_absen ?> Pegawai Masuk</i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="d-flex justify-content-center h-100">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title text-center">Presensi PT-NADOYO</h1>
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table class="table table-bordered table-striped mb-0 text-center">
                                        <thead class="bg-warning">
                                            <tr>
                                                <th scope="col">ID Pegawai</th>
                                                <th scope="col">Nama Pegawai</th>
                                                <th scope="col">Tanggal Masuk</th>
                                                <th scope="col">Jam Datang</th>
                                                <th scope="col">Jam Pulang</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody-light">
                                            <?php $no = 1;
                                            foreach ($table_absen as $absen) : ?>
                                                <tr>
                                                    <th scope="row"><?= $no++ ?></th>
                                                    <td><?= $absen['nama_pegawai']; ?></td>
                                                    <td><?= $absen['tanggal_masuk']; ?> </td>
                                                    <td><?= $absen['jam_masuk']; ?></td>
                                                    <td><?= $absen['jam_keluar']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours();
            document.getElementById("menit").innerHTML = waktu.getMinutes();
            document.getElementById("detik").innerHTML = waktu.getSeconds();
        }
    </script>
    <script type="text/javascript">
        setTimeout(function() {
            location = '<?php echo base_url() ?>'
        }, 3000)
    </script>
</body>

</html>