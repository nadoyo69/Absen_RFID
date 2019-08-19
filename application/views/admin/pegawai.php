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
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($pegawai as $data) : ?>
                    <tr>
                        <td><?= $data['nama_pegawai'] ?></td>
                        <td><?= $data['nomor_pegawai'] ?></td>
                        <td><?= $data['nomor_hp_pegawai'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td class="text-center">
                            <a target="_blank" href="<?= base_url('viewpegawai/' . $data['tbl_idpegawai']); ?>" class="mdi mdi-cloud-print"></a> |
                            <a href="<?= base_url('editpegawai/' . $data['tbl_idpegawai']); ?>" class="mdi mdi-account-edit"></a> |
                            <a href="<?= base_url('resetpasswordpegawai/' . $data['tbl_idpegawai']) ?>" onClick="return confirm('Apakah Anda benar-benar mau Reset Password?')" class="mdi mdi-account-key"></a> |
                            <a href="<?= base_url('hapuspegawai/' . $data['tbl_idpegawai']) ?>" onClick="return confirm('Apakah Anda benar-benar mau Menghapus Pegawai?')" class="mdi mdi-delete-forever"></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>