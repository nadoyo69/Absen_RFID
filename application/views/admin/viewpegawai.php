<?php
$id = $viewpegawai->tbl_idpegawai;
$nama = $viewpegawai->nama_pegawai;
$tgl = $viewpegawai->tanggal_lahir_pegawai;
$tmp = $viewpegawai->tempat_lahir_pegawai;
$kontak = $viewpegawai->nomor_hp_pegawai;
$alamat = $viewpegawai->alamat;
$jeniskelamin = $viewpegawai->jeniskelamin;
$agama = $viewpegawai->agama;
$email = $viewpegawai->email;
$nip = $viewpegawai->nomor_pegawai;
$foto = $viewpegawai->foto;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <style>
        @media print {
            @page {
                size: landscape
            }
        }
    </style>

</head>

<body>
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <div class="container-fluid mt-3">
                    <div class="container bootstrap snippet">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="text-center">
                                    <img src="<?= $foto ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home">
                                        <form class="form">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $nama ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $tgl ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $tmp ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $jeniskelamin ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Alamat</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $alamat ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Agama</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $agama ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $email ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Kontak</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $kontak ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nomor Pegawai</label>
                                                <div class="col-sm-10">
                                                    <div type="text" class="form-control"><?= $nip ?></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="text-center">
                        <button onclick="window.print()">print</button>
                    </div>
                </div>
            </div>
            <br>
            <br>

        </div>
    </div>
    <script>
        window.print();
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>assets/admin/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin/js/demo/datatables-demo.js"></script>

</body>

</html>