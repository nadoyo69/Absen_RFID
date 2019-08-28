<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title m-b-0">Surat Izin </h4>
            </div>
            <?php foreach ($suratizin as $izin) : ?>
            <div class="comment-widgets scrollable">
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="p-2"><img src="<?= base_url('assets/images/fotopegawai/' . $izin['foto']) ?>" alt="user" width="50" class="rounded-circle"></div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium"><?= $izin['nama_pegawai'] ?></h6>
                        <span class="m-b-15 d-block"><?= substr($izin['isi'], 0, 30) ?></span>
                        <div class="comment-footer">
                            <span class="text-muted float-right"><?= $izin['DTM'] ?></span>
                            <button type="button" class="btn btn-cyan btn-sm" data-toggle="modal" data-target="#izin<?= $izin['id'] ?>">View</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="izin<?= $izin['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <p>Nama : <?= $izin['nama_pegawai'] ?></p>
                            <p>Nomor Pegawai : <?= $izin['nomor_pegawai'] ?></p>
                            <br>
                            <p>Bersama Surat ini bermaksud mengajukan permohonan izin untuk tidak masuk kerja mulai dari tanggal <?= $izin['tanggal_mulai'] ?> sampai dengan tanggal <?= $izin['tanggal_selesai'] ?> dengan alasan sebagai berikut :</p>
                            <p><?= $izin['isi'] ?></p>
                            <br>
                            <p>Demikian Surat ini saya sampaikan untuk dapat dimaklumi dan atas izin yang diberikan saya ucapkan terimakasih</p>
                            <br>
                            <br>
                            <p class="float-right">Hormat Saya</p>
                            <br><br><br>
                            <p class="float-right"><?= $izin['nama_pegawai'] ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="<?= base_url('tolaksurat/' . $izin['id']) ?>" type="button" class="btn btn-danger" onClick="return confirm('Apakah Anda Yakin?')">Tolak</a>
                            <a href="<?= base_url('accsurat/' . $izin['id']) ?>" type="button" class="btn btn-primary" onClick="return confirm('Apakah Anda Yakin?')">ACC</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title m-b-0">Surat Sakit </h4>
            </div>
            <?php foreach ($suratsakit as $sakit) : ?>
            <div class="comment-widgets scrollable">
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="p-2"><img src="<?= base_url('assets/images/fotopegawai/' . $sakit['foto']) ?>" alt="user" width="50" class="rounded-circle"></div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium"><?= $sakit['nama_pegawai'] ?></h6>
                        <span class="m-b-15 d-block"><?= substr($sakit['isi'], 0, 30) ?></span>
                        <div class="comment-footer">
                            <span class="text-muted float-right"><?= $sakit['DTM']; ?></span>
                            <button type="button" class="btn btn-cyan btn-sm" data-toggle="modal" data-target="#sakit<?= $sakit['id'] ?>">View</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="sakit<?= $sakit['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <p>Nama : <?= $sakit['nama_pegawai'] ?></p>
                            <p>Nomor Pegawai : <?= $sakit['nomor_pegawai'] ?></p>
                            <br>
                            <p>Bersama Surat ini bermaksud mengajukan permohonan izin untuk tidak masuk kerja mulai dari tanggal <?= $sakit['tanggal_mulai'] ?> sampai dengan tanggal <?= $sakit['tanggal_selesai'] ?> dengan alasan sebagai berikut :</p>
                            <p><?= $sakit['isi'] ?></p>
                            <br>
                            <p>Demikian Surat ini saya sampaikan untuk dapat dimaklumi dan atas izin yang diberikan saya ucapkan terimakasih</p>
                            <br>
                            <br>
                            <p class="float-right">Hormat Saya</p>
                            <br><br><br>
                            <p class="float-right"><?= $sakit['nama_pegawai'] ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="<?= base_url('tolaksurat/' . $sakit['id']) ?>" type="button" class="btn btn-danger" onClick="return confirm('Apakah Anda Yakin?')">Tolak</a>
                            <a href="<?= base_url('accsurat/' . $sakit['id']) ?>" type="button" class="btn btn-primary" onClick="return confirm('Apakah Anda Yakin?')">ACC</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>