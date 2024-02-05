<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Data Album</h5>


                    <?php echo form_open('album/add') ?>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama Album</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_album" value="<?= set_value('nama_album') ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" name="deskripsi" value="<?= set_value('deskripsi') ?>"
                                class="form-control" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 ">
                            <a href="<?= base_url('album') ?>" class="btn btn-warning"><i
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