

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Album</h5>

            <div class="card-body">
              <h5 class="card-title">Halaman Tambah Album</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= base_url('album/add') ?>" method="post" enctype="multipart/form-data">

                <div class="col-md-6">
                  <label class="form-label">Nama Album</label>
                  <input type="text" name="nama_album" class="form-control" value="<?= set_value('nama_album') ?>" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Cover</label>
                  <input type="file" name="cover" class="form-control" value="<?= set_value('cover') ?>" required>
                </div>
                  

                <div class="col-12">
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control" name="deskripsi" value="<?= set_value('deskripsi') ?>" id="floatingTextarea" style="height: 100px;"></textarea>
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
