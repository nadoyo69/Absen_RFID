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
<?php
$this->load->helper('form');
$error = $this->session->flashdata('error');
if ($error) {
    ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $error; ?>
    </div>
<?php
}
$success = $this->session->flashdata('success');
if ($success) {
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $success; ?>
    </div>
<?php
} ?>
<div class="row">
    <div class="col-xl-3 col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Status Pegawai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php if ($profil->active == 1) { ?> <h3>Aktif <i class="fa fa-check" aria-hidden="true"></i></h3> <?php } ?>
                            <?php if ($profil->active == 0) { ?> <h5 style="color:red">Belum Aktivasi <i class="fa fa-times" aria-hidden="true"></i></h5>
                                <button class="btn btn-danger"><a class="text-white" href="<?= base_url('aktivasipegawai') ?>">Silahkan klik disini untuk Aktivasi</a></button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user-circle-o fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-4 mb-4">
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
    <div class="col-xl-3 col-md-4 mb-4">
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