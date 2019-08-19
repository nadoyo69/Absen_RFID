<div class="card shadow mb-4">
    <div class="card-body">

        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <a href="<?= base_url('Admin/exportexcel') ?>" onClick="return confirm('Apakah Anda Yakin?')">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                            <h6 class="text-white">Export Data Pegawai</h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <a href="<?= base_url('Admin/exportabsenbulan') ?>" onClick="return confirm('Apakah Anda Yakin?')">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                            <h6 class="text-white">Export Absensi Tahunan</h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <a href="<?= base_url('Admin/exportabsentahun') ?>" onClick="return confirm('Apakah Anda Yakin?')">
                        <div class="box bg-warning text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                            <h6 class="text-white">Export Data Absensi Bulanan</h6>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <a href="#" onClick="return confirm('Apakah Anda Yakin?')">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                            <h6 class="text-white">Export Data Pegawai</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>