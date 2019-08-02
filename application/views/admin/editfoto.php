<?php
$id = $profil->tbl_idadmin;
$foto = $profil->foto;
?>
<div class="row">
    <div class="col-lg-6">
        <div class="container bootstrap snippet">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <form class="form" action="<?= base_url('updatefoto') ?>" enctype="multipart/form-data" method="post">
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
                            <label class="col-sm-2">Foto</label>
                            <div class="col-sm-10">
                                <input type="text" hidden name="id" value="<?= $id ?>">
                                <input type="file" class="form-control required" name="foto">
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