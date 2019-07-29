<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('admin'); ?>">Home</a> / Input Data Pegawai</li>
    </ol>
</nav>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Input Data</h6>
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url('newpegawai') ?>" enctype="multipart/form-data">
            <?php $this->load->helper('form'); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
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
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl" class="form-control" placeholder="Tanggal Lahir">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input name="jeniskelamin" class="form-check-input" type="radio" value="Laki-Laki">
                                <label class="form-check-label">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="jeniskelamin" class="form-check-input" type="radio" value="Perempuan">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" name="agama" class="form-control" placeholder="Agama">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nomor Kartu</label>
                        <div class="col-sm-10">
                            <input type="number" name="rfid" class="form-control" placeholder="Nomor Kartu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nomor Pegawai</label>
                        <div class="col-sm-10">
                            <input type="number" name="nip" class="form-control" placeholder="Nomor Pegawai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kontak</label>
                        <div class="col-sm-10">
                            <input type="number" name="kontak" class="form-control" placeholder="Kontak">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group btn-lg">
                <button class="btn btn-danger float-right" type="reset"> Reset </button>
                <button type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
            </div>
        </form>
    </div>
</div>