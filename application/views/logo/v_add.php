

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Logo</h5>

            <div class="card-body">
              <h5 class="card-title">Halaman Tambah Logo</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= base_url('logo/add') ?>" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                  <label class="form-label">Logo</label>
                  <input type="file" name="logo" class="form-control" value="<?= set_value('logo') ?>"  required>
                </div>
                
                <div class="text-center">
                <a href="<?= base_url('logo') ?>" class="btn btn-warning"><i
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
