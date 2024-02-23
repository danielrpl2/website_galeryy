<?php foreach ($background as $bg) : ?>
<div class="page-heading normal-space" style="background-image: url(<?=base_url('assets/image_bg/' . $bg->bg)?>);
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  padding-top: 250px;
  text-align: center;
  background-color: #2a2a2a;">
  <?php endforeach; ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Detail</h6>
          <h2>Detail Profile <?=$user_data->username?> </h2>
          <span>Home > <a href="<?= base_url() ?>"><?=$user_data->nama_lengkap?></a></span>
          <div class="buttons">
            <!-- <div class="main-button">
              <a href="explore.html">Explore Our Items</a>
            </div>
            <div class="border-button">
              <a href="create.html">Create Your NFT</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="author-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="author">
          <?php if (!empty($user_data->image)): ?>
          <img src="<?=base_url('assets/image_user/' . $user_data->image)?>" alt=""
            style="border-radius: 50%; width: 50%; height: 45vh; object-fit: cover;">
          <?php endif;?>
          <h4><?=$user_data->nama_lengkap?> <br> <a
              href="<?=base_url('profile/view/' . $user_data->userid)?>">@<?=$user_data->username?></a></h4>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="right-info">
          <div class="row">
            <div class="col-12 text-center">
              <div class="info-item">
              <i class="fa-solid fa-image"></i>
                <h6>
                  <?= $total_postingan ?> <em>Postingan</em>
                </h6>
              </div>
            </div>
           
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h2>Postingan <em><?=$user_data->nama_lengkap?></em>.</h2>
        </div>
      </div>


      <?php if (empty($postingan)): ?>
      <div class="col-lg-12">
        <p>Belum ada foto.</p>
      </div>
      <?php else: ?>
      <?php foreach ($postingan as $postingan): ?>
      <div class="col-lg-3 col-md-6">
        <div class="item">
          <div class="row">
            <div class="col-lg-12">
              <span class="author">
              </span>
              <img src="<?=base_url('assets/image_foto/' . $postingan->lokasi)?>" alt="" style="border-radius: 20px;">
              <h4><?=$postingan->judul?></h4>
            </div>
            <div class="col-lg-12">
              <div class="line-dec"></div>
              <div class="row">
              <div class="col-6">
                        <?php if ($level_user && $level_user <= 2): ?>
                        <!-- Letakkan di dalam loop foreach untuk setiap foto -->
                        <?php if ($this->session->userdata('userid')): ?>
                        <?php if ($this->m_like->isLiked($postingan->fotoid, $this->session->userdata('userid'))): ?>
                          <button id="dislike-button-<?= $postingan->fotoid ?>" onclick="dislikePhoto(<?= $postingan->fotoid ?>)" style="background-color: transparent; border: none; color: white;"> 
                          <i class="fas fa-heart" style="color: red; font-size: 18px;"></i>
                          <p><?=isset($total_likes_per_fotoid[$postingan->fotoid]) ? $total_likes_per_fotoid[$postingan->fotoid] : 0?></p>
                        </button>
                        <?php else: ?>
                          <button id="like-button-<?= $postingan->fotoid ?>" onclick="likePhoto(<?= $postingan->fotoid ?>)" style="background-color: transparent; border: none; color: white;">
                          <i class="fas fa-heart" style="color: white; font-size: 18px;"></i>
                          <p><?=isset($total_likes_per_fotoid[$postingan->fotoid]) ? $total_likes_per_fotoid[$postingan->fotoid] : 0?></p>
                        </button>

                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$postingan->fotoid]) ? $total_likes_per_fotoid[$postingan->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$postingan->fotoid]) ? $total_likes_per_fotoid[$postingan->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
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
                      <?=$dayOfWeek . ", " . $dayOfMonth . " " . $month . " " . $year . ""?>
                    </small></span>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button">
                <a href="<?=base_url('welcome/detail/' . $postingan->fotoid)?>">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach;?>
      <?php endif;?>

    </div>
  </div>
</div>

<script>
// Fungsi untuk menangani klik tombol "like" tanpa refresh
function likePhoto(fotoid) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= base_url('profile/like_photo_profile_detail') ?>', true); // Ganti URL dengan endpoint yang sesuai
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Setelah like berhasil, lakukan redirect untuk memperbarui halaman
                    window.location.reload(true);
                } else {
                    console.error('Failed to like photo');
                }
            } else {
                console.error('Error occurred while sending request');
            }
        }
    };
    xhr.send('fotoid=' + fotoid);
}

// Fungsi untuk menangani klik tombol "dislike" tanpa refresh
function dislikePhoto(fotoid) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= base_url('profile/dislike_photo_profile_detail') ?>', true); // Ganti URL dengan endpoint yang sesuai
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Setelah dislike berhasil, lakukan redirect untuk memperbarui halaman
                    window.location.reload(true);
                } else {
                    console.error('Failed to dislike photo');
                }
            } else {
                console.error('Error occurred while sending request');
            }
        }
    };
    xhr.send('fotoid=' + fotoid);
}

function refreshPhotoSection() {
    // Di sini, Anda dapat memperbarui bagian-bagian tertentu dari halaman, misalnya, bagian yang menampilkan foto-foto
    // Misalnya:
    var photoSection = document.getElementById('photo-section'); // Ganti dengan ID sesuai bagian yang ingin diperbarui
    // Anda dapat menggunakan teknik lain seperti fetch, jQuery AJAX, atau library lainnya untuk memuat ulang bagian-bagian tertentu dari halaman.
    // Contoh: photoSection.innerHTML = "Content to refresh"; atau load dari server
}

</script>