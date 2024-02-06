

  <div class="item-details-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>Form Tambah <em><?= $header ?></em>.</h2>
            <h2><em><a href="<?= base_url('profile') ?>">Kembali</a></em>.</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div id="contact">
          <?php echo form_open_multipart('profile/add') ?>
            <div class="row">
              <div class="col-lg-4">
                <fieldset>
                <label>Judul</label>
                    <input type="text" name="judul" placeholder="Masukan Judul...." autocomplete="on" value="<?= set_value('judul') ?>" required>
                </fieldset>
              </div>
              <div class="col-lg-4">
                <fieldset>
                <label>Deskripsi</label>
                    <input type="text" name="deskripsi" placeholder="Masukan Deskripsi...." autocomplete="on" value="<?= set_value('deskripsi') ?>" required>
                </fieldset>
              </div>
              <div class="col-lg-4">
                  <fieldset>
                    <label for="album">Album</label>
                    <select id="album" name="albumid" required style="width: 100%;
    height: 46px;
    text-align: left;
    padding: 0px 15px;
    background-color: #282b2f;
    border: 1px solid #404245;
    margin-bottom: 30px;
    font-weight: 500;
    color: #afafaf;">
                      <option value="">Pilih Album</option>
                      <?php foreach ($album as $key => $value) { ?>
                      <option value="<?= $value->albumid ?>"><?= $value->nama_album ?></option>
                      <?php } ?>

                    </select>
                  </fieldset>
                </div>

              <div class="col-lg-4">
                <fieldset>
                <label>Gambar</label>
                    <input type="file" name="lokasi" multiple id="preview_gambar" style="width: 100%;" />
                </fieldset>
              </div>

              <div class="col-lg-4">
                <fieldset>
                <img src="<?= base_url('assets/image_tambahan/kosong.jpg') ?>" id="gambar_load" style="width: 60%; border-radius:10px;">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="orange-button">Unggah Postingan</button>
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