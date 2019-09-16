<div class="card shadow mb-4">
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
    <div class="card-body">
        <div class="table-responsive jumbotron">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($status as $data) : ?>
                        <tr>
                            <td><?= $data['nama_pegawai'] ?></td>
                            <td><?= $data['nomor_pegawai'] ?></td>
                            <td class="text-center">
                                <?php if (time() < $data['time']) { ?>
                                    <span class="badge badge-pill badge-success">ON</span>
                                <?php } ?>
                                <?php if (time() > $data['time']) { ?>
                                    <span class="badge badge-pill badge-danger">OFF</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>