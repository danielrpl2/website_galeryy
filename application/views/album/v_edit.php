

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Album</h5>






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


            <div class="card-body">
              <h5 class="card-title">Halaman Edit Album</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= base_url('album/edit/' . $album->albumid) ?>" method="post" enctype="multipart/form-data">

                <div class="col-md-6">
                  <label class="form-label">Nama Album</label>
                  <input type="text" name="nama_album" value="<?= $album->nama_album ?>"
                                class="form-control" />
                </div>
                <div class="col-6">
                  <label class="form-label">Cover</label>
                  <input type="file" name="cover" class="form-control" id="preview_gambar" style="width: 100%;">
                </div>


                <div class="col-3">
                <img src="<?= base_url('assets/image_cover/'. $album->cover) ?>" id="gambar_load" style="width: 80%; border-radius:10px;">
                </div>

                <div class="col-8">
                  <label class="form-label">Alamat</label>
                  <textarea class="form-control" name="deskripsi" placeholder="Address" id="floatingTextarea" style="height: 100px;"><?= $album->deskripsi ?></textarea>
                </div>
                
                <div class="text-center">
                <a href="<?= base_url('album') ?>" class="btn btn-warning"><i
                                    class="bx bx-arrow-back"></i>Kembali</a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form><!-- End Multi Columns Form -->

            </div>
          </div>





</div>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#togglePassword').on('click', function() {
            const passwordField = $('#password');
            const passwordFieldType = passwordField.attr('type');
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $('#togglePassword i').removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $('#togglePassword i').removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
    });
</script>
