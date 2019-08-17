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
$password = $profil->password;
?>
<div class="container bootstrap snippet">
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
                        <h1><?php echo $this->session->userdata("username"); ?></h1>
                    </div>
                </div>

                <img src="<?= $foto ?>" class="avatar img-circle img-thumbnail" alt="avatar">
            </div>
        </div>

        <div class="col-sm-8">
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
                    <form class="form" action="<?= base_url('updateprofil') ?>" enctype="multipart/form-data" method="post">
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
                            <button onClick="return confirm('Apakah Sudah Benar?')" type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="changepass">
                    <form class="form" action="<?= base_url('updatepassword') ?>" enctype="multipart/form-data" method="post">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password Lama</label>
                            <div class="col-sm-10">
                                <input type="text" hidden value="<?= $tbl_idadmin ?>" name="id" class="form-control">
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
                    <form class="form" action="<?= base_url('updatefoto') ?>" enctype="multipart/form-data" method="post">
                        <div class="form-group row">
                            <label class="col-sm-2">Foto</label>
                            <div class="col-sm-10">
                                <input type="text" hidden name="id" value="<?= $tbl_idadmin ?>">
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