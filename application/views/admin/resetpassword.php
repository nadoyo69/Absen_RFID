<div class="">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive jumbotron">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($resetpassword as $data) : ?>
                            <tr>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['email'] ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['jam'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>