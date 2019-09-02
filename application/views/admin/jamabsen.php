<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-title">
                    <h3>Jam Absen</h3>
                </div>
                <br>
                <form method="post" action="<?= base_url('updatejamabsen') ?>" class="jumbotron">
                    <?php foreach ($jamabsen as $ja) : ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jam Masuk</label>
                            <div class="col-sm-10">
                                <input type="time" name="jam_masuk" value="<?= $ja['jam_masuk'] ?>" class="form-control" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Maksimal Jam Masuk</label>
                            <div class="col-sm-10">
                                <input type="time" name="max_jammasuk" value="<?= $ja['max_jammasuk'] ?>" class="form-control" placeholder="Nama">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jam Pulang</label>
                            <div class="col-sm-10">
                                <input type="time" name="jam_pulang" value="<?= $ja['jam_pulang'] ?>" class="form-control" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Maksimal Jam Pulang</label>
                            <div class="col-sm-10">
                                <input type="time" name="max_jampulang" value="<?= $ja['max_jampulang'] ?>" class="form-control" placeholder="Nama">
                            </div>
                        </div>
                        <button class="btn btn-danger float-left" type="reset"> Reset </button>
                        <button onClick="return confirm('Apakah Sudah Benar?')" type="submit" class="btn btn-primary float-right">Submit</button>
                    <?php endforeach ?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
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
    </div>
</div>