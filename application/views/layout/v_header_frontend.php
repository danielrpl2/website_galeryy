 <!-- ***** Preloader Start ***** -->
 <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="<?= base_url() ?>" class="logo">
                        <img src="<?= base_url() ?>assets/frontend/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="<?= base_url() ?>" class="active">Home</a></li>
                        <li><a href="<?= base_url('welcome/postingan') ?>">Postingan</a></li>
                        <?php if ($this->session->userdata('username') == "") { ?>
                          <li><a href="<?= base_url('login') ?>">Login</a></li>
                          <?php } else{ ?>
                            <li><a href="<?= base_url('profile') ?>">Profile</a></li>
                          <li><a href="<?= base_url('login/logout_user') ?>">Logout</a></li>

                          <?php } ?>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

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
