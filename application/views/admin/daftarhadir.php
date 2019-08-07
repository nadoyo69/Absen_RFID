<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('admin'); ?>">Home</a> / Data Presensi</li>
    </ol>
</nav>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class=" float-right px-2">
            <a href="<?= base_url('Admin/exportabsenbulan') ?>" class="btn btn-primary btn-icon-split btn-sm" onClick="return confirm('Apakah Anda Mau Export Ke Excel?')">
                <span class="icon text-white-50">
                    <i class="fa fa-file-excel-o"></i>
                </span>
                <span class="text">Rekap Bulanan</span>
            </a>
        </div>

        <div class="float-right">
            <a href="<?= base_url('Admin/exportabsentahun') ?>" class="btn btn-primary btn-icon-split btn-sm" onClick="return confirm('Apakah Anda Mau Export Ke Excel?')">
                <span class="icon text-white-50">
                    <i class="fa fa-file-excel-o"></i>
                </span>
                <span class="text">Rekap Tahunan</span>
            </a>
        </div>
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