<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('admin'); ?>">Home</a> / Data Presensi</li>
    </ol>
</nav>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Presensi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Tanggal Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Tanggal Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($daftarhadir as $data) : ?>
                        <tr>
                            <td><?= $data['nama_pegawai'] ?></td>
                            <td><?= $data['nomor_pegawai'] ?></td>
                            <td><?= $data['tanggal_masuk'] ?></td>
                            <td><?= $data['jam_masuk'] ?></td>
                            <td><?= $data['jam_keluar'] ?></td>
                            <td class="text-center">
                                <a href="" class="fa fa-eye"></a> | <a href="" class="fa fa-pencil-square-o"></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>