<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('admin'); ?>">Home</a> / Pegawai</li>
    </ol>
</nav>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Kontak</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Kontak</th>
                        <th>Foto</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($pegawai as $data) : ?>
                        <tr>
                            <td><?= $data['nama_pegawai'] ?></td>
                            <td><?= $data['nomor_pegawai'] ?></td>
                            <td><?= $data['tempat_lahir_pegawai'] ?></td>
                            <td><?= $data['tanggal_lahir_pegawai'] ?></td>
                            <td><?= $data['nomor_hp_pegawai'] ?></td>
                            <td><img height="50px" width="50px" src="<?= $data['foto']; ?>" alt=""></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>