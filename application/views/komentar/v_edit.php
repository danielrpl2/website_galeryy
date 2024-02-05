<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Data Komentar</h5>
                    <?php echo form_open('komentar/edit/' . $komentar->komentarid) ?>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Fotoid</label>
                        <div class="col-sm-10">
                            <input type="text" name="fotoid" value="<?= $komentar->fotoid ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Userid</label>
                        <div class="col-sm-10">
                            <input type="text" name="userid" value="<?= $komentar->userid ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Komentar</label>
                        <div class="col-sm-10">
                            <input type="text" name="komentar" value="<?= $komentar->komentar ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal" value="<?= $komentar->tanggal ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10 ">
                            <a href="<?= base_url('komentar') ?>" class="btn btn-warning"><i
                                    class="bx bx-arrow-back"></i>Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>

        </div>
    </div>
</section>