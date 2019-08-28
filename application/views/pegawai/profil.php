<?php
$tbl_idpegawai = $profil->tbl_idpegawai;
$nama = $profil->nama_pegawai;
$nip = $profil->nomor_pegawai;
$tgl = $profil->tanggal_lahir_pegawai;
$tmp = $profil->tempat_lahir_pegawai;
$kontak = $profil->nomor_hp_pegawai;
$jenis = $profil->jeniskelamin;
$alamat = $profil->alamat;
$password = $profil->password;
$agama = $profil->agama;
$email =  $profil->email;
$foto = $profil->foto;
?>
<div class="container bootstrap snippet">
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
                <div class="row">
                    <div class="col-sm-10">
                        <h1><?php echo $this->session->userdata("nama_pegawai"); ?></h1>
                    </div>
                </div>

                <img src="<?php echo base_url('assets/images/fotopegawai/' . $foto); ?>" class="avatar img-circle img-thumbnail" alt="avatar">
            </div>
        </div>

        <div class="col-sm-9">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <ul class="nav nav-tabs">
                        <li class="nav-item nav-link"><a href="#details" data-toggle="tab">Details</a></li>
                        <li class="nav-item nav-link"><a href="#changepass" data-toggle="tab">Change Password</a></li>
                        <li class="nav-item nav-link"><a href="#changepicture" data-toggle="tab">Change Pictrure</a></li>
                    </ul>
                </div>
            </nav>

            <div class="tab-content mt-3">
                <div class="tab-pane fade show active" id="details">
                    <form class="form" action="<?= base_url('updateprofilpegawai') ?>" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-lg-6">
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
                                    <label class="col-sm-2 col-form-label">Nomor Pegawai</label>
                                    <div class="col-sm-10">
                                        <input type="number" readonly name="nip" class="form-control" value="<?= $nip ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="alamat" class="form-control" value="<?= $alamat ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Agama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="agama" class="form-control" value="<?= $agama ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="jns" class="form-control" value="<?= $jenis ?>">
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
                            </div>
                        </div>
                        <div class="form-group btn-lg">
                            <button class="btn btn-danger float-right" type="reset"> Reset </button>
                            <button onClick="return confirm('Apakah Sudah Benar?')" type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="changepass">
                    <form class="form" action="<?= base_url('updatepasswordpegawai') ?>" enctype="multipart/form-data" method="post">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password Lama</label>
                            <div class="col-sm-10">
                                <input type="text" hidden value="<?= $tbl_idpegawai ?>" name="id" class="form-control">
                                <input type="password" name="oldpassword" class="form-control" placeholder="Password Lama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password Baru</label>
                            <div class="col-sm-10">
                                <input type="password" name="password1" class="form-control" placeholder="Password Baru">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password2" class="form-control" placeholder="Konfimasi Password">
                            </div>
                        </div>
                        <button class="btn btn-danger float-right" type="reset"> Reset </button>
                        <button onClick="return confirm('Apakah Sudah Benar?')" type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="changepicture">
                    <form class="form" action="<?= base_url('updatefotopegawai') ?>" enctype="multipart/form-data" method="post">
                        <div class="form-group row">
                            <label class="col-sm-2">Foto</label>
                            <div class="col-sm-10">
                                <input type="text" hidden name="id" value="<?= $tbl_idpegawai ?>">
                                <input type="file" class="form-control required" name="foto">
                            </div>
                        </div>
                        <button class="btn btn-danger float-right" type="reset"> Reset </button>
                        <button onClick="return confirm('Apakah Sudah Benar?')" type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>