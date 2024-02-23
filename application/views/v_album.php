
<?php foreach ($background as $bg) : ?>
<div class="page-heading" style="background-image: url(<?=base_url('assets/image_bg/' . $bg->bg)?>);
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
        <h2><?= $title ?></h2>
        <span>Home > <a href="<?=base_url()?>">Album</a></span>
        </div>
      </div>
    </div>
    <div class="featured-explore">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="owl-features owl-carousel">

            <?php foreach ($foto as $foto_item) : ?>
              <div class="item">
                <div class="thumb">
                  <img src="<?=base_url('assets/image_foto/' . $foto_item->lokasi)?>" alt="" style="border-radius: 20px; object-fit: cover;">
                  <div class="hover-effect">
                    <div class="content">
                      <h4><?= $foto_item->judul ?></h4>
                      <span class="author">
                        <?php
                        // Cari pengguna yang sesuai dengan ID pengguna pada foto saat ini
                        $user = null;
                        foreach ($users as $user_item) {
                            if ($user_item->userid == $foto_item->userid) {
                                $user = $user_item;
                                break;
                            }
                        }
                        ?>
                        <?php if ($user) : ?>
                            <img src="<?= base_url('assets/image_user/' . $user->image) ?>" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%; object-fit: cover;">
                            <h6><?= $user->nama_lengkap ?><br><a href="<?= base_url('profile/view/' . $user->userid) ?>">@<?= $user->username ?></a></h6>
                        <?php endif; ?>
                    </span>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
<div class="discover-items">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>Foto <em><?= $title ?></em>.</h2>
          </div>
        </div>
        <div class="col-lg-7">
          <form id="search-form" name="gs" method="submit" role="search" action="#">
          <div class="row">
          
          <div class="col-lg-4">
           
          </div>
          <div class="col-lg-6">
            <fieldset>
              <input type="text" name="keyword" class="searchText" placeholder="Cari Foto..." autocomplete="on"
                required>
            </fieldset>
          </div>
          <div class="col-lg-2">
            <fieldset>
              <button class="main-button">Search</button>
            </fieldset>
          </div>
        </div>
          </form>
        </div>


        <?php if (empty($user)) : ?>
    <div class="col-lg-12 text-center">
        <h3>Tidak ada foto dalam album ini</h3>
    </div>
<?php else : ?>
        <?php foreach ($foto as $foto_item) : ?>
    <div class="col-lg-4">
        <div class="item">
            <div class="row">
                <div class="col-lg-12">
                    <span class="author">
                    <?php
                        // Cari pengguna yang sesuai dengan ID pengguna pada foto saat ini
                        $user = null;
                        foreach ($users as $user_item) {
                            if ($user_item->userid == $foto_item->userid) {
                                $user = $user_item;
                                break;
                            }
                        }
                        ?>
                        <?php if ($user) : ?>
                            <img src="<?= base_url('assets/image_user/' . $user->image) ?>" alt="" style="max-width: 50px; max-height: 50px; border-radius: 50%; object-fit: cover;">
                            <?php endif; ?>

                    </span>
                    <img src="<?=base_url('assets/image_foto/' . $foto_item->lokasi)?>" alt="" style="border-radius: 20px;">
                    <h4><?= $foto_item->judul ?></h4> 
                </div>
                <div class="col-lg-12">
                    <div class="line-dec"></div>
                    <div class="row">
                    <div class="col-5">
                        <?php if ($level_user && $level_user <= 2): ?>
                        <!-- Letakkan di dalam loop foreach untuk setiap foto -->
                        <?php if ($this->session->userdata('userid')): ?>
                        <?php if ($this->m_like->isLiked($foto_item->fotoid, $this->session->userdata('userid'))): ?>
                          <span>
                          <button id="dislike-button-<?= $foto_item->fotoid ?>" onclick="dislikePhoto(<?= $foto_item->fotoid ?>)" style="background-color: transparent; border: none; color: white; font-size: 20px;"> 
                          <i class="fas fa-heart" style="color: red; font-size: 20px;"></i>
                          <?=isset($total_likes_per_fotoid[$foto_item->fotoid]) ? $total_likes_per_fotoid[$foto_item->fotoid] : 0?><p>Like</p>
                        </button>
                        <?php else: ?>
                          <button id="like-button-<?= $foto_item->fotoid ?>" onclick="likePhoto(<?= $foto_item->fotoid ?>)" style="background-color: transparent; border: none; color: white; font-size: 20px;">
                          <i class="fas fa-heart" style="color: white; font-size: 20px;"></i>
                          <?=isset($total_likes_per_fotoid[$foto_item->fotoid]) ? $total_likes_per_fotoid[$foto_item->fotoid] : 0?><p>Like</p>
                        </button>

                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white; font-size: 20px;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$foto_item->fotoid]) ? $total_likes_per_fotoid[$foto_item->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white; font-size: 20px;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$foto_item->fotoid]) ? $total_likes_per_fotoid[$foto_item->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                        </span>
                      </div>
                      <div class="col-5">
                        <span><a href="<?=base_url('welcome/detail/' . $foto_item->fotoid)?>" style="color: white; padding: 20px; font-size: 20px;">
                        <i class="fas fa-comment" style="color: white;"></i><p>Komentar</p></a>
                          </span>
                        </div>
                        <div class="col-1">
                        <span><button onclick="shareContent()"
                            style="background-color: transparent; border: none; color: white;"><i
                              class="fa fa-paper-plane"
                              style="color: white; font-size: 20px; padding: 10px; text-align: center;">
                             </i></button> Share
                            </span>
                      </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="main-button" style=" margin-top: 20px;
  margin-bottom: -10px;">
                        <a href="<?= base_url('welcome/detail/' . $foto_item->fotoid) ?>">View Details</a> 
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


  <script>
// Fungsi untuk menangani klik tombol "like" tanpa refresh
function likePhoto(fotoid) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= base_url('welcome/like_photo_album') ?>', true); // Ganti URL dengan endpoint yang sesuai
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
    xhr.open('POST', '<?= base_url('welcome/dislike_photo_album') ?>', true); // Ganti URL dengan endpoint yang sesuai
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


<style>
  /* CSS untuk efek hover pada item */
.item{
  box-shadow: 4px 8px 8px rgba(0, 0, 0, 5);
  border-radius: 20px;
  margin-bottom: 20px; 
  overflow: hidden;
  transition: box-shadow 0.3s ease;
}

/* Style tambahan untuk mengatur tampilan saat di-hover */
.item:hover {
  box-shadow: 0px 8px 16px rgba(255, 255, 255, 0.5); /* Efek box shadow putih saat di-hover */
}

</style>