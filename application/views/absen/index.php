<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <title>Absensi Datang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="<?php echo base_url() ?>assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css_absen/style.css">
</head>

<body oncontextmenu="return !true;">
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
                                        <div class="form-control"><?php echo date("d-m-Y") ?></div>
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
                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user-circle-o"></i></span>
                                        </div>
                                        <div class="form-control"><?= $total_pegawai - $total_absen ?> Pegawai TM</i>
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
                                    <table id="mytable" class="table table-bordered table-striped mb-0 text-center">
                                        <thead class="bg-warning">
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
                    url: '<?php echo site_url("Absen/get_product"); ?>',
                    type: 'GET',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var count = 1;
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + count++ + '</td>' +
                                '<td>' + data[i].nama_pegawai + '</td>' +
                                '<td>' + data[i].tanggal_masuk + '</td>' +
                                '<td>' + data[i].jam_masuk + '</td>' +
                                '<td>' + data[i].jam_keluar + '</td>' +
                                '</tr>';
                        }
                        $('.show_product').html(html);
                    }
                });
            }
        });
    </script>
</body>

</html>