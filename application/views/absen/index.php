<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Absensi Datang</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/nadoyo1.png') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="<?php echo base_url() ?>assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/absen/style.css">
</head>

<body oncontextmenu="return !true;">
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-4">
                <div class="d-flex justify-content-center h-100">
                    <div class="container">
                        <div class="cards card cardbody p-3 mb-3">
                            <div class="flat card-header font-weight-bold text-center ">
                                DATA
                            </div>
                            <hr>
                            <div class="flat card-body">
                                <form>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text flat bg-cyan"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <div class="form-control"><?php echo date("d-m-Y") ?></div>
                                    </div>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text flat bg-cyan"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                        <div class="form-control"><i id="jam"></i>:<i id="menit"></i>:<i id="detik"></i>
                                        </div>
                                    </div>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text flat bg-cyan"><i class="fa fa-user-circle-o"></i></span>
                                        </div>
                                        <div class="form-control"><i id="totalabsen"></i> Pegawai Masuk</div>
                                    </div>
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text flat bg-cyan"><i class="fa fa-user-circle-o"></i></span>
                                        </div>
                                        <div class="form-control"><i id="absen"></i> Pegawai TM </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="cards card p-3 mb-3 ">
                            <div class="flat card-header font-weight-bold text-center ">
                                STATUS
                            </div>
                            <hr>
                            <div class="flat card-body">
                                <div class="alert text-center text-white font-weight-bold alertabsen" role="alert">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="d-flex justify-content-center h-100">
                    <div class="container">
                        <div class="cards card">
                            <div class="card-body">
                                <h1 class="card-title text-center">Presensi PT-NADOYO</h1>
                                <hr>
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table id="mytable" class="table table-bordered table-striped mb-0 text-center text-white">
                                        <thead class="bg-cyan">
                                            <tr>
                                                <th scope="col">ID Pegawai</th>
                                                <th scope="col">Nama Pegawai</th>
                                                <th scope="col">Tanggal Masuk</th>
                                                <th scope="col">Jam Datang</th>
                                                <th scope="col">Jam Pulang</th>
                                            </tr>
                                        </thead>
                                        <tbody class="show_product">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
    <script src="<?= base_url('assets/absen/absenjs.js') ?>"></script>

</body>

</html>