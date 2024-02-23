

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Background</h5>

            <div class="card-body">
              <h5 class="card-title">Halaman Tambah Background</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= base_url('background/add') ?>" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                  <label class="form-label">Background</label>
                  <input type="file" name="bg" class="form-control" value="<?= set_value('bg') ?>" style="height: 50px;" required>
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
