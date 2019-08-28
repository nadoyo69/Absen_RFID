<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Selamat datang <?php echo $this->session->userdata("nama_pegawai"); ?></li>
    </ol>
</nav>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Masuk Pada Tahun <?= date('Y') ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $Tahunabsen; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Masuk Pada Bulan <?= date('M') ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $absen; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>