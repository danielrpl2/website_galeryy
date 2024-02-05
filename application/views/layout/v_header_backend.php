<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">NiceAdmin</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <?php if ($this->session->userdata('image')) : ?>
          <img src="<?= base_url('assets/image_user/' . $this->session->userdata('image')) ?>" alt="Profile" class="rounded-circle">
          <?php endif;?>
          <span class="d-none d-md-block dropdown-toggle ps-2"><?= $this->session->userdata('nama_lengkap'); ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?= $this->session->userdata('nama_lengkap'); ?></h6>
            <span>     <?php 
                                    $level_user = 1;
                                    if ($level_user == 1) {
                                        echo "Admin";
                                    } else if ($level_user == 2) {
                                        echo "User";
                                    } else {
                                        echo "Level user tidak valid";
                                    }
                                ?> </span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('login/logout_user') ?>">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-heading">Dashboard</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('dashboard') ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('user') ?>">
        <i class="bi bi-person-fill"></i>
        <span>User</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('album') ?>">
        <i class="bi bi-collection-fill"></i>
        <span>Album</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('foto') ?>">
        <i class="bi bi-card-image"></i>
        <span>Foto</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('like') ?>">
        <i class="bi bi-heart-fill"></i>
        <span>Like</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('komentar') ?>">
        <i class="bi bi-chat-right-text-fill"></i>
        <span>Komentar</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('login/logout_user') ?>">
        <i class="bi bi-box-arrow-in-left"></i>
        <span>Logout</span>
      </a>
    </li>


  </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>

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
