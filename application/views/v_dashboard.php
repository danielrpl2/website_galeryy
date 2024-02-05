<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Revenue Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Album </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-collection-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $total_album ?></h6>
                      <span class="text-success small pt-1 fw-bold"><a href="<?= base_url('album') ?>">Detail <i class="bi bi-cursor-fill"></i></a></span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-6 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">User</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?= $total_user ?></h6>
                      <span class="text-danger small pt-1 fw-bold"><a href="<?= base_url('user') ?>">Detail <i class="bi bi-cursor-fill"></i></a></span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

          </div>
        </div><!-- End Left side columns -->

    

      </div>
    </section>