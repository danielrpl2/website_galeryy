<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Data Foto</h5>

                    <?php echo form_open_multipart('foto/add') ?>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="judul" value="<?= set_value('judul') ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="textarea" name="deskripsi" value="<?= set_value('deskripsi') ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="lokasi" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Pilih Album</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="albumid">
                      <option value="">--Pilih--</option>
                      <?php foreach ($album as $key => $value) { ?>
                      <option value="<?= $value->albumid ?>"><?= $value->nama_album ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 ">
                            <a href="<?= base_url('foto') ?>" class="btn btn-warning"><i
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