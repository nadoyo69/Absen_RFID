<div class="card shadow mb-4">
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
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Tanggal Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
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
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>