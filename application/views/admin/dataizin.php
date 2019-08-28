<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive jumbotron">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Tanggan Surat Masuk</th>
                        <th>Hasil</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Pegawai</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Tanggan Surat Masuk</th>
                        <th>Hasil</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($dataizin as $data) : ?>
                    <tr>
                        <td><?= $data['nama_pegawai'] ?></td>
                        <td><?= $data['nomor_pegawai'] ?></td>
                        <td><?= $data['tanggal_mulai'] ?></td>
                        <td><?= $data['tanggal_selesai'] ?></td>
                        <td><?= $data['DTM'] ?></td>
                        <td><?= $data['hasil'] ?></td>
                        <td><a href="" class="mdi mdi-cloud-print" data-toggle="modal" data-target="#surat<?= $data['id'] ?>">View</a></td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="surat<?= $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Surat Izin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Kepada Yth.</p>
                                    <p><strong>Bapak/Ibu</strong></p>
                                    <p><strong>Kepala PT-Nadoyo</strong></p>
                                    <br>
                                    <p>Dengan Hormat.</p>
                                    <p>Saya yang bertanda tangan dibawah ini:</p>
                                    <p>Nama : <?= $data['nama_pegawai'] ?></p>
                                    <p>Nomor Pegawai : <?= $data['nomor_pegawai'] ?></p>
                                    <br>
                                    <p>Bersama Surat ini bermaksud mengajukan permohonan izin untuk tidak masuk kerja mulai dari tanggal <?= $data['tanggal_mulai'] ?> sampai dengan tanggal <?= $data['tanggal_selesai'] ?> dengan alasan sebagai berikut :</p>
                                    <p><?= $data['isi'] ?></p>
                                    <br>
                                    <p>Demikian Surat ini saya sampaikan untuk dapat dimaklumi dan atas izin yang diberikan saya ucapkan terimakasih</p>
                                    <br>
                                    <br>
                                    <p class="float-right">Hormat Saya</p>
                                    <br><br><br>
                                    <p class="float-right"><?= $data['nama_pegawai'] ?></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>