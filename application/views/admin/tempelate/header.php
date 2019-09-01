<?php
$foto = $profil->foto;
?>
<!DOCTYPE html>
<html class="no-js" dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/nadoyo1.png') ?>">
    <title><?= $title; ?></title>
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="<?= base_url() ?>assets/admin/css/style.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script>
        $(document).ready(function() {
            show_product();
            Pusher.logToConsole = true;
            var pusher = new Pusher('daa8c8cd19c2dc18dbb2', {
                cluster: 'ap1',
                forceTLS: true
            });
            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                if (data.message === 'success') {
                    show_product();
                }
            });

            function show_product() {
                $.ajax({
                    url: '<?php echo site_url("notifikasiizin"); ?>',
                    type: 'GET',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html +=
                                '<div class="d-flex no-block align-items-center p-10">' +
                                '<span class="btn btn-success btn-circle"><i class="ti-user"></i></span>' +
                                '<div class="m-l-10">' +
                                '<h5>' + data[i].nama_pegawai + '</h5>' +
                                '<h6> Jenis Surat "' + data[i].jenis + '"</h6>' +
                                '<span>' + data[i].DTM + '</span>' +
                                '</div>' +
                                '</div>';
                        }
                        $('.notifikasi').html(html);
                    }
                });

                $.ajax({
                    type: 'get',
                    url: '<?php echo site_url("totalnotif"); ?>',
                    dataType: 'json',
                    success: function(html) {
                        $('#totalnotif').html(html);
                    }

                });
            }
        });
    </script>
</head>

<body>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="<?= base_url('Dashboard'); ?>">
                        <b class="logo-icon p-l-10">
                            N
                            <!--<img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" /> -->
                        </b>
                        <span class="logo-text">
                            adoyo
                            <!--  <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="font-24 mdi mdi-comment-processing"></i>
                                <span class="badge badge-pill badge-danger"><i id="totalnotif"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <a class="text-center" href="<?= base_url('suratizinmasuk') ?>">VIEW ALL</a>
                                        <div class="notifikasi">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/images/fotoadmin/' . $foto); ?>" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="<?= base_url('profiladmin') ?>"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="<?= base_url('logadmin') ?>"><i class="ti-wallet m-r-5 m-l-5"></i> LOG</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('logout'); ?>" onClick="return confirm('Apakah Anda Yakin?')"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('Dashboard'); ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Pegawai </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?= base_url('datapegawai') ?>" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Data Pegawai </span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url('inputdatapegawai') ?>" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Input Data Pegawai </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('jabatan') ?>" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Jabatan Pegawai</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('absenharini') ?>" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Absen Perhari</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('daftarhadir') ?>" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Absensi</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-note"></i><span class="hide-menu">Surat Izin </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?= base_url('suratizinmasuk') ?>" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Surat Izin Masuk </span></a></li>
                                <li class="sidebar-item"><a href="<?= base_url('dataizin') ?>" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Data Surat Izin </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('permintaanreset') ?>" aria-expanded="false"><i class="mdi mdi-flag-checkered"></i><span class="hide-menu">Laporan Reset Password</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('laporan') ?>" aria-expanded="false"><i class="mdi mdi-flag-checkered"></i><span class="hide-menu">Laporan</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('statuslogin') ?>" aria-expanded="false"><i class="mdi mdi-nest-thermostat"></i><span class="hide-menu">Status Login</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= base_url('backup') ?>" onClick="return confirm('Apakah Anda Yakin?')" aria-expanded="false"><i class="mdi mdi-backup-restore"></i><span class="hide-menu">Backup Database</span></a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?= $title ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">