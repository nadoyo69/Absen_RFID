<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Input Surat Izin</h6>
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url('inputsuratizin') ?>" enctype="multipart/form-data">
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
                <div class="container">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" readonly name="nama" class="form-control" value="<?php echo $this->session->userdata("nama_pegawai"); ?>" placeholder="Nama">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jenis Surat</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input name="jenisurat" class="form-check-input" type="radio" value="Sakit">
                                <label class="form-check-label">Sakit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="jenisurat" class="form-check-input" type="radio" value="Izin">
                                <label class="form-check-label">Izin</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mulai Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl1" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sampai Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" name="tgl2" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Isi Surat</label>
                        <div class="col-sm-10">
                            <textarea name="isi" id="editor1" rows="10" cols="80"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group btn-lg">
                <button class="btn btn-danger float-right" type="reset"> Reset </button>
                <button type="submit" onClick="return confirm('Apakah Sudah Benar?')" value="Submit" class="btn  btn-primary float-right"> Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    var editor = CKEDITOR.replace('editor1');
    CKFinder.setupCKEditor(editor);
</script>