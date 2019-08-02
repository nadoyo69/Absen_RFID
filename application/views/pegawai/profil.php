<?php
$tbl_idpegawai = $profil->tbl_idpegawai;
$nama = $profil->nama_pegawai;
$nip = $profil->nomor_pegawai;
$tgl = $profil->tanggal_lahir_pegawai;
$tmp = $profil->tempat_lahir_pegawai;
$kontak = $profil->nomor_hp_pegawai;
$jenis = $profil->jeniskelamin;
$alamat = $profil->alamat;
$agama = $profil->agama;
$email =  $profil->email;
$foto = $profil->foto;
?>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10">
            <h1><?php echo $this->session->userdata("username"); ?></h1>
        </div>
    </div>

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
        <div class="col-sm-3">
            <div class="text-center">
                <img src="<?= $foto ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                <hr>
                <button class="btn btn-lg btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i><a class="text-white" href="<?php echo base_url() . 'editfotopegawai/' . $tbl_idpegawai; ?>">Ganti Foto</a></button>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <form class="form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $nama ?></div>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $tgl ?></div>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $tmp ?></div>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Agama</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $agama ?></div>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $jenis ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Kontak</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $kontak ?></div>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Nomor Pegawai</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $nip ?></div>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $email ?></div>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <div type="text" class="form-control"><?= $alamat ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 float-right">
                                <br>
                                <button class="btn btn-lg btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i><a class="text-white" href="<?php echo base_url() . 'editpasswordpegawai/' . $tbl_idpegawai; ?>">Ganti Password</a></button>
                                <button class="btn btn-lg btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i><a class="text-white" href="<?php echo base_url() . 'editprofilpegawai/' . $tbl_idpegawai; ?>">Edit Profil</a></button>
                            </div>
                        </div>
                    </form>

                    <hr>

                </div>
            </div>
        </div>
    </div>