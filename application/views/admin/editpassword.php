<?php
$id = $profil->tbl_idadmin;
$password = $profil->password;
?>
<div class="row">
    <div class="col-lg-6">
        <div class="container bootstrap snippet">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <form class="form" action="<?= base_url('updatepassword') ?>" enctype="multipart/form-data" method="post">
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
                        <?php
                        $noMatch = $this->session->flashdata('nomatch');
                        if ($noMatch) {
                            ?>
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <?php echo $this->session->flashdata('nomatch'); ?>
                            </div>
                        <?php
                        } ?>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password Lama</label>
                            <div class="col-sm-10">
                                <input type="text" hidden value="<?= $id ?>" name="id" class="form-control">
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
                        <button type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>