<div class="page-heading normal-space">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Profile Akun</h6>
          <h2>Detail Profile  <?= $this->session->userdata('nama_lengkap'); ?></h2>
          <span>Home > <a href="<?= base_url('profile') ?>"><?= $this->session->userdata('username'); ?></a></span>
          <!-- <div class="buttons">
            <div class="main-button">
              <a href="explore.html">Explore Our Items</a>
            </div>
            <div class="border-button">
              <a href="create.html">Create Your NFT</a>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>

<div class="author-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="author">
          <?php if ($this->session->userdata('image')) : ?>
          <img src="<?= base_url('assets/image_user/' . $this->session->userdata('image')) ?>" alt=""
            style="border-radius: 50%; max-width: 50%; max-height: 45vh; object-fit: cover;">
          <?php endif;?>
          <h4>
            <?= $this->session->userdata('nama_lengkap'); ?> <a href=""><i class="fa fa-cog" aria-hidden="true"></i>
        </a> <br>
             <a
              href="<?= base_url('profile/view/' . $user_data->userid) ?>">@<?= $this->session->userdata('username'); ?>
            </a>
          </h4>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="right-info">
          <div class="row">
            <div class="col-6">
              <div class="info-item">
                <i class="fa fa-heart"></i>
                <h6>
                  <?= $total_like ?> <em>Likes</em>
                </h6>
              </div>
            </div>
            <div class="col-6">
              <div class="info-item">
                <i class="fa fa-comment"></i>
                <h6>
                  <?= $total_komentar ?> <em>Komentar</em>
                </h6>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-lg-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h2>
            <?= $this->session->userdata('nama_lengkap'); ?> <em>Postingan</em>.
          </h2>
          <br>
          <h3>
          <a href="<?= base_url('profile/add') ?>" style="background-color: #7453fc;
    padding: 12px 30px;
    display: inline-block;
    border-radius: 25px;
    color: white;"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Postingan</a>
          </h3>
        </div>
      </div>

      <?php if (empty($postingan)) : ?>
      <div class="col-lg-12">
        <p>Belum ada foto.</p>
      </div>
      <?php else : ?>
      <?php foreach ($postingan as $postingan) : ?>
      <div class="col-lg-3 col-md-6">
        <div class="item">
          <div class="row">
            <div class="col-lg-12">
              <span class="author">
              </span>
              <img src="<?= base_url('assets/image_foto/' . $postingan->lokasi) ?>" alt="" style="border-radius: 20px;">
              <h4>
                <?= $postingan->judul ?> 
              </h4>
              
              <button onclick="confirmDelete('<?= $postingan->fotoid ?>')" class="ellipsis" style="position: absolute; top: 10px; left: 10px; color: white; font-size: 15px; background-color: transparent; border: none;"><i class="fa fa-trash" aria-hidden="true"></i>
            </button>

            <a href="<?=base_url('profile/edit/' . $postingan->fotoid)?>" style="position: absolute; top: 10px; right: 10px; color: white; font-size: 15px; background-color: transparent; border: none;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </div>
            <div class="col-lg-12">
              <div class="line-dec"></div>
              <div class="row">
                <div class="col-6">
                  <span>Total Like : <br> <strong> <i class="fas fa-heart"></i>
                      <?=isset($total_likes_per_fotoid[$postingan->fotoid]) ? $total_likes_per_fotoid[$postingan->fotoid] : 0?></strong></span>
                </div>
                <div class="col-6">
                  <?php
                      $days = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                      $months = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                      $timestamp = strtotime($postingan->tanggal);
                      $dayOfWeek = $days[date('w', $timestamp)];
                      $dayOfMonth = date('j', $timestamp);
                      $month = $months[date('n', $timestamp)];
                      $year = date('Y', $timestamp);
                      $time = date('H:i', $timestamp);
                  ?>
                  <span>Tanggal Up : <br> <small>
                      <?= $dayOfWeek . ", " . $dayOfMonth . " " . $month . " " . $year .""?>
                    </small></span>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button">
                <a href="<?= base_url('welcome/detail/' . $postingan->fotoid) ?>">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function confirmDelete(fotoid) {
        Swal.fire({
            title: 'Anda yakin ingin menghapus data ini?',
            text: "Aksi ini tidak dapat dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengkonfirmasi penghapusan
                window.location.href = '<?=base_url("profile/delete/")?>' + fotoid;
            }
        });
    }
</script>