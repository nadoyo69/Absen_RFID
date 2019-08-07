<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pegawai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pegawai; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pegawai Masuk Hari ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $absen_hari_ini; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Absensi perBulan</h6>
            </div>
            <div class="card-body">
                <canvas id="mychart"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- data table -->
<?php
foreach ($grafik as $data) {
    $tanggal[] = $data->tanggal_masuk;
    $total[] = $data->total;
}
?>
<script>
    new Chart(document.getElementById("mychart"), {
        type: 'line',
        data: {
            labels: <?= json_encode($tanggal) ?>,
            datasets: [{
                data: <?= json_encode($total) ?>,
                label: "Data Prsensi",
                borderColor: "#3e95cd",
                fill: false
            }],
        }
    });
</script>