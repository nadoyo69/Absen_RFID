<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-cyan shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-cyan text-uppercase mb-1">Jumlah Pegawai Aktif</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pegawai; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-cyan"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jumlah Pegawai Belum Aktivasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pegawai_nonaktif; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pegawai Masuk Hari ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><i id="totalabsen"></i></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pegawai Sedang Login</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user-circle-o fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Izin</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_permintaan_izin; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-newspaper-o fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Reset Password</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $resetpassword; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-flag-o fa-2x text-danger"></i>
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


<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Absensi Tahun <?= date('Y') ?></h6>
            </div>
            <div class="card-body">
                <canvas id="mychartlogin"></canvas>
            </div>
        </div>
    </div>
</div>