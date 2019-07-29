<?php
$tbl_idadmin = $profil->tbl_idadmin;
$nama = $profil->nama_admin;
$username = $profil->username_admin;
$email = $profil->email_admin;
$alamat = $profil->alamat;
$kontak = $profil->nomor_hp;
$tgl = $profil->tanggal_lahir;
$tmp = $profil->tempat_lahir;
$foto = $profil->foto;
?>
<div class="container bootstrap snippet">
    <div class="tab-content">
        <div class="tab-pane active" id="home">
            <form class="form" action="<?= base_url('updateprofil') ?>" enctype="multipart/form-data" method="post">
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
                        <input type="text" hidden name="id" class="form-control" value="<?= $tbl_idadmin ?>">
                        <input type="text" name="nama" class="form-control" value="<?= $nama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" value="<?= $username ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" value="<?= $email ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kontak</label>
                    <div class="col-sm-10">
                        <input type="number" name="kontak" class="form-control" value="<?= $kontak ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" value="<?= $alamat ?>">
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
                <div class="form-group btn-lg">
                    <button class="btn btn-danger float-right" type="reset"> Reset </button>
                    <button type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>