<!DOCTYPE html>
<html>

<head>
    <title>Absensi Datang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="<?php echo base_url() ?>assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css_absen/style.css">
</head>

<body oncontextmenu="return false;">
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-4">
                <div class="d-flex justify-content-center h-100">
                    <div class="container">
                        <div class="card cardbody p-3 mb-3">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#absendatang">
                                Absen Manual
                            </button>
                            <br>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#absenpulang">
                                Absen Pulang
                            </button>
                        </div>
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
                                        <div class="form-control"><?= $total_absen ?> Pegawai</i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--
                            <div class="card-footer">
                                <button type="button" class="btn btn-warning float-right"><a href="<?= base_url(); ?>logout" class="text-dark">Logout</a></button>
                            </div>
                                -->
                        </div>
                        <div class="card cardbody p-3 mb-3">
                            <div class="card-body">
                                <small class="text-muted">
                                    <?php
                                    $this->load->helper('form');
                                    $error = $this->session->flashdata('error');
                                    if ($error) {
                                        ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php
                                    } ?>
                                    <?php
                                    $success = $this->session->flashdata('success');
                                    if ($success) {
                                        ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <?php echo $this->session->flashdata('success'); ?>
                                        </div>
                                    <?php
                                    } ?>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                        </div>
                                    </div>
                                    <?php $this->load->helper("form"); ?>
                                </small>
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

    <!-- Modal Absen Datang Manual-->
    <div class="modal fade" id="absendatang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Absen Datang</h5>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?php echo base_url(); ?>absen" method="post" enctype="multipart/form-data">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input name="idpegawai" type="text" class="form-control" placeholder="Nomor Kepegawaian">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Input" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-->

    <!-- Modal Absen Pulang-->
    <div class="modal fade" id="absenpulang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Absen Pulang</h5>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?php echo base_url(); ?>pulang" method="post" enctype="multipart/form-data">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input name="nomor_pegawai" type="text" class="form-control" placeholder="Nomor Kepegawaian">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Input" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
        }, 5000)
    </script>
</body>

</html>