<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Data User</h5>

                    <!-- General Form Elements -->

                    <?php echo form_open_multipart('user/add') ?>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" value="<?= set_value('username') ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" value="<?= set_value('password') ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" value="<?= set_value('email') ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_lengkap" value="<?= set_value('nama_lengkap') ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" value="<?= set_value('alamat') ?>" class="form-control"
                                style="height: 100px"><?= set_value('alamat') ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                          <input type="file" name="image" value="<?= set_value('image') ?>" class="form-control" />

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 ">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('user') ?>" class="btn btn-warning"><i
                                    class="bx bx-arrow-back"></i>Kembali</a>
                        </div>
                    </div>

                    <?php echo form_close() ?>

                </div>
            </div>

        </div>
    </div>
</section>
