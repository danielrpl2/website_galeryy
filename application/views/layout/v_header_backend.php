<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="<?= base_url() ?>" class="logo d-flex align-items-center">
      <img src="<?= base_url() ?>assets/backend/img/title.png" alt="" style="width: 40px; max-width: 50%;">
      <span class="d-none d-lg-block">ReGar</span>
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
            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('profile') ?>">
              <i class="bi bi-house"></i>
              <span>Home</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('profile/profile_admin') ?>">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('profile/edit_profile_admin') ?>">
              <i class="bi bi-gear"></i>
              <span>Pengaturan Akun</span>
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
        <i class="bi bi-grid-fill"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-heading">Menu</li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#admin" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>Akun</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="admin" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('user') ?>">
            <i class="bi bi-person-circle" style="font-size: 15px;"></i><span>Admin</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('user/pengguna') ?>">
              <i class="bi bi-person-square" style="font-size: 15px;"></i><span>Pengguna</span>
            </a>
          </li>
        </ul>
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

    <li class="nav-heading">Pengaturan</li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-fill"></i><span>Pengaturan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('background') ?>">
            <i class="bi bi-image-alt" style="font-size: 15px;"></i><span>Background</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('logo') ?>">
              <i class="bi bi-image-fill" style="font-size: 15px;"></i><span>Logo</span>
            </a>
          </li>
        </ul>
      </li>

    <!-- <li class="nav-item">
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
    </li> -->

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
