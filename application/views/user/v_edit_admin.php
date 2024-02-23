
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Data User</h5>

                    <!-- General Form Elements -->

                    <?php echo form_open_multipart('user/edit/' . $user->userid) ?>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" value="<?= $user->username ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" value="<?= $user->password ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" value="<?= $user->email ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_lengkap" value="<?= $user->nama_lengkap ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" value="<?= $user->image ?>"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" class="form-control"
                                style="height: 100px"><?= $user->alamat ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Level User</label>
                        <div class="col-sm-10">
                            <select name="level_user" class="form-select">
                                <option value="1" <?= ($user->level_user == '1') ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= ($user->level_user == '2') ? 'selected' : '' ?>>2</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-10 ">
                            <a href="<?= base_url('user') ?>" class="btn btn-warning"><i class="bx bx-arrow-back"></i>Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                    <?php echo form_close() ?>

                </div>
            </div>

        </div>
    </div>
</section>