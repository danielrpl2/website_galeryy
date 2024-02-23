

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Background</h5>






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
              <h5 class="card-title">Halaman Edit Background</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= base_url('background/edit/' . $background->bghome) ?>" method="post" enctype="multipart/form-data">

                <div class="col-12">
                  <label class="form-label">Background</label>
                  <input type="file" name="bg" class="form-control" id="preview_gambar" style="width: 100%;">
                </div>


                <div class="col-3">
                <img src="<?= base_url('assets/image_bg/'. $background->bg) ?>" id="gambar_load" style="width: 80%; border-radius:10px;">
                </div>
                
                <div class="text-center">
                <a href="<?= base_url('background') ?>" class="btn btn-warning"><i
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
