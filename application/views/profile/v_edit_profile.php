

<div class="item-details-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>Halaman <em><?= $header ?></em>.</h2>
            <h2><em><i class="fa fa-arrow-right"></i> <a style="color: white;" href="<?= base_url('profile') ?>">Kembali</a> <i class="fa fa-arrow-left"></i></em></h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div id="contact">
          <?php echo form_open_multipart('profile/edit_profile') ?>

            <div class="row">
              <div class="col-lg-4">
                <fieldset>
                <label>Username</label>
                    <input type="text" name="username" placeholder="Masukan Username...." autocomplete="on" value="<?= $user->username ?>" required>
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset>
                <label>Password</label>
                    <input type="password" name="password" placeholder="Masukan Password...." autocomplete="on" value="<?= $user->password ?>" required>
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset>
                <label>Email</label>
                    <input type="email" name="email" placeholder="Masukan Email...." autocomplete="on" value="<?= $user->email ?>" required>
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset>
                <label>Nama</label>
                    <input type="text" name="nama_lengkap" placeholder="Masukan Nama...." autocomplete="on" value="<?= $user->nama_lengkap ?>" required>
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset>
                <label>Alamat</label>
                    <input type="text" name="alamat" placeholder="Masukan Alamat...." autocomplete="on" value="<?= $user->alamat ?>" required>
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset>
                <label>Gambar</label>
                <input type="file" name="image" id="preview_gambar" style="width: 100%;" />

                </fieldset>
              </div>

              <div class="col-lg-6">
                <fieldset>
                <img src="<?= base_url('assets/image_user/'. $user->image) ?>" id="gambar_load" style="width: 60%; border-radius:10px;">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">Edit Profile</button>
                </fieldset>
              </div>
            </div>
          </div>
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {
        $("#preview_gambar").change(function () {
            bacaGambar(this);
        });
    });
</script>