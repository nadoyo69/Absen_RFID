<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data LOG</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Platform</th>
                        <th>Tangal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Platform</th>
                        <th>Tangal</th>
                        <th>Jam</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($logadmin as $data) : ?>
                    <tr>
                        <td><?= $data['username'] ?></td>
                        <td><?= $data['platform'] ?></td>
                        <td><?= $data['tanggal_login'] ?></td>
                        <td><?= $data['jam'] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>