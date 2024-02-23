
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Halaman | <?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="<?= base_url() ?>assets/backend/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>assets/backend/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link rel="icon" href="<?= base_url() ?>assets/frontend/images/title.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>assets/backend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/backend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/backend/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/backend/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/backend/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/backend/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/backend/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>assets/backend/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun Anda</h5>
                    <p class="text-center small">Masukan data yang diperlukan untuk register.</p>
                    <div class="col-12">
                      <p class="small mb-0 text-center">Kembali | <a href="<?= base_url() ?>">Home</a></p>
                    </div>
                  </div>

               
                  <form class="row g-3 needs-validation" action="<?= base_url('login/register') ?>" method="post" enctype="multipart/form-data">
               
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text">@</span>
                        <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Ulangi Password</label>
                      <input type="password" name="ulangi_password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>" required>
                      <div class="invalid-feedback">Please enter your email!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Nama Lengkap</label>
                      <input type="text" name="nama_lengkap" class="form-control" value="<?= set_value('nama_lengkap') ?>" required>
                      <div class="invalid-feedback">Please enter your nama_lengkap!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Alamat</label>
                      <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat') ?>" required>
                      <div class="invalid-feedback">Please enter your alamat!</div>
                    </div>

                    <!-- <div class="col-12">
                      <label for="yourPassword" class="form-label">Foto</label>
                      <input type="file" name="image" class="form-control" value="<?= set_value('image') ?>" required>
                      <div class="invalid-feedback">Please enter your image!</div>
                    </div> -->

                    <br>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Register</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah punya akun? <a href="<?= base_url('login') ?>">Login</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url() ?>assets/backend/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/backend/vendor/chart.js/chart.umd.js"></script>
  <script src="<?= base_url() ?>assets/backend/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url() ?>assets/backend/vendor/quill/quill.min.js"></script>
  <script src="<?= base_url() ?>assets/backend/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url() ?>assets/backend/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url() ?>assets/backend/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url() ?>assets/backend/js/main.js"></script>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    <?php if($this->session->flashdata('swal')): ?>
        <?php if($this->session->flashdata('swal') == 'success'): ?>
            Swal.fire({
                title: 'Sukses!',
                text: '<?= $this->session->flashdata("pesan") ?>',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                timer: 2000 // Waktu dalam milidetik (5 detik)
            });
        <?php elseif($this->session->flashdata('swal') == 'error'): ?>
            Swal.fire({
                title: 'Error!',
                text: '<?= $this->session->flashdata("pesan") ?>',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                timer: 5000 // Waktu dalam milidetik (5 detik)
            });
        <?php endif; ?>
    <?php endif; ?>
</script>