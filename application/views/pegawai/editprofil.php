<?php
$tbl_idpegawai = $editprofil->tbl_idpegawai;
$nama = $editprofil->nama_pegawai;
$nip = $editprofil->nomor_pegawai;
$tgl = $editprofil->tanggal_lahir_pegawai;
$tmp = $editprofil->tempat_lahir_pegawai;
$kontak = $editprofil->nomor_hp_pegawai;
$jenis = $editprofil->jeniskelamin;
$alamat = $editprofil->alamat;
$agama = $editprofil->agama;
$email =  $editprofil->email;
?>
<div class="container bootstrap snippet">
    <div class="tab-content">
        <div class="tab-pane active" id="home">
            <form class="form" action="<?= base_url('updateprofilpegawai') ?>" enctype="multipart/form-data" method="post">
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

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" hidden name="id" class="form-control" value="<?= $tbl_idpegawai ?>">
                        <input type="text" name="nama" class="form-control" value="<?= $nama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="date" name="tgl" class="form-control" value="<?= $tgl ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" name="tmp" class="form-control" value="<?= $tmp ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-10">
                        <input type="text" name="agama" class="form-control" value="<?= $agama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="text" name="jenis" class="form-control" value="<?= $jenis ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kontak</label>
                    <div class="col-sm-10">
                        <input type="number" name="kontak" class="form-control" value="<?= $kontak ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" value="<?= $email ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" value="<?= $alamat ?>">
                    </div>
                </div>
                <div class="form-group btn-lg">
                    <button class="btn btn-danger float-right" type="reset"> Reset </button>
                    <button type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>