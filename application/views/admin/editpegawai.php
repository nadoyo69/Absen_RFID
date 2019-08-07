<?php
$id = $editpegawai->tbl_idpegawai;
$nama = $editpegawai->nama_pegawai;
$nip = $editpegawai->nomor_pegawai;
$rfid = $editpegawai->koderfid;
?>
<div class="container bootstrap snippet">
    <div class="tab-content">
        <div class="tab-pane active" id="home">
            <form class="form" action="<?= base_url('updatepegawai') ?>" enctype="multipart/form-data" method="post">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" hidden name="id" class="form-control" value="<?= $id ?>">
                        <input type="text" name="nama" class="form-control" value="<?= $nama ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Pegawai</label>
                    <div class="col-sm-10">
                        <input type="text" name="nip" class="form-control" value="<?= $nip ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor RFID</label>
                    <div class="col-sm-10">
                        <input type="text" name="rfid" class="form-control" value="<?= $rfid ?>">
                    </div>
                </div>
                <div class="form-group btn-lg">
                    <button class="btn btn-danger float-right" type="reset"> Reset </button>
                    <button type="submit" value="Submit" class="btn  btn-primary float-right"> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>