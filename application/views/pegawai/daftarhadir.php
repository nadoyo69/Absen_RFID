<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Hadir Bulan <?= date('m') ?>
        </h6>
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
                        <th>Jam Pulang</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Tanggal Masuk</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($daftarhadir as $absen) : ?>
                    <tr>
                        <td><?= $absen['nama_pegawai'] ?> </td>
                        <td><?= $absen['nomor_pegawai'] ?> </td>
                        <td><?= $absen['tanggal_masuk'] ?> </td>
                        <td><?= $absen['jam_masuk'] ?> </td>
                        <td><?= $absen['jam_keluar'] ?> </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>