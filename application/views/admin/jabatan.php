<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive jumbotron">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($jabatan as $data) : ?>
                                <tr>
                                    <td><?= $data['jabatan'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('hapusjabatan/' . $data['id']) ?>" onClick="return confirm('Apakah Anda benar-benar mau Menghapus Jabatan?')" class="mdi mdi-delete-forever"></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="card-title">
                    <h3>Input Jabatan</h3>
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
                <br>
                <form method="post" action="<?= base_url('inputjabatan') ?>" class="jumbotron">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Jabatan">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>