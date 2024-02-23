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
        <!-- <h6>Liberty NFT Market</h6> -->
        <h2>Halaman Postingan Pengguna</h2>
        <span>Home > <a href="<?=base_url()?>">Postingan</a></span>
      </div>
    </div>
  </div>
  <div class="featured-explore">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-features owl-carousel">

            <?php foreach ($foto as $key => $value) {?>
            <div class="item">
              <div class="thumb">
                <img src="<?=base_url('assets/image_foto/' . $value->lokasi)?>" alt=""
                  style="max-width: 100%; margin-left: 18px; border-radius: 20px; object-fit: cover;">
                <div class="hover-effect">
                  <div class="content">
                    <h4>
                      <?=$value->judul?>
                    </h4>
                    <span class="author">
                      <img src="<?=base_url('assets/image_user/' . $value->image)?>" alt=""
                        style="max-width: 50px; max-height: 50px; border-radius: 50%; object-fit: cover;">
                      <h6>
                        <?=$value->nama_lengkap?><br><a href="<?= base_url('profile/view/' . $value->userid) ?>">@<?=$value->username?>
                        </a>
                      </h6>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>


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
          <h2>Postingan Semua <em>Pengguna</em>.</h2>
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

      <?php foreach ($foto as $key => $value) {?>
      <div class="col-lg-4">
        <div class="item">
          <div class="row">
            <div class="col-lg-12">
              <span class="author">
                <img src="<?=base_url('assets/image_user/' . $value->image)?>" alt=""
                  style="max-width: 50px; height: 48px; border-radius: 50%; object-fit: cover;">
              </span>
              <img src="<?=base_url('assets/image_foto/' . $value->lokasi)?>" alt="" style="border-radius: 20px; object-fit: cover;">
              <h4>
                <?=$value->judul?>
              </h4>
            </div>
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

            <div class="col-lg-12" id="photo-section">
              <div class="line-dec"></div>
              <div class="row">
              <div class="col-5">
                        <?php if ($level_user && $level_user <= 2): ?>
                        <!-- Letakkan di dalam loop foreach untuk setiap foto -->
                        <?php if ($this->session->userdata('userid')): ?>
                        <?php if ($this->m_like->isLiked($value->fotoid, $this->session->userdata('userid'))): ?>
                          <span>
                          <button id="dislike-button-<?= $value->fotoid ?>" onclick="dislikePhoto(<?= $value->fotoid ?>)" style="background-color: transparent; border: none; color: white; font-size: 20px;"> 
                          <i class="fas fa-heart" style="color: red; font-size: 20px;"></i>
                          <?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?><p>Like</p>
                        </button>
                        </span>
                        <?php else: ?>
                          <span>
                          <button id="like-button-<?= $value->fotoid ?>" onclick="likePhoto(<?= $value->fotoid ?>)" style="background-color: transparent; border: none; color: white; font-size: 20px;">
                          <i class="fas fa-heart" style="color: white; font-size: 20px;"></i>
                          <?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?><p>Like</p>
                        </button>
                        </span>

                        <?php endif;?>
                        <?php else: ?>
                          <span>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white; font-size: 20px;">
                          <i class="fas fa-heart" style="color: white;"></i>
                            <?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?>
                            <p>Like</p>
                        </a>
                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white; font-size: 20px;">
                          <i class="fas fa-heart" style="color: white;"></i>                          
                            <?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?>
                            <p>Like</p>
                        </a>
                        <?php endif;?>
                        </span>
                      </div>
                      <div class="col-5">
                        <span><a href="<?=base_url('welcome/detail/' . $value->fotoid)?>" style="color: white; padding: 20px; font-size: 20px;">
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
  margin-bottom: -15px;">
                <a href="<?=base_url('welcome/detail/' . $value->fotoid)?>">View Details</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php }?>
    </div>
  </div>
</div>

<script>
  function shareContent() {
    // URL yang ingin Anda bagikan
    var urlToShare = window.location.href;

    // Membuka dialog bagikan dengan URL yang dipilih
    if (navigator.share) {
      navigator.share({
        title: document.title,
        url: urlToShare
      })
        .then(() => console.log('Berbagi berhasil.')) // Hapus tanda koma di akhir sini
        .catch((error) => console.error('Error sharing:', error));

    } else {
      // Fallback jika browser tidak mendukung navigator.share
      alert('Browser Anda tidak mendukung fitur ini. Silakan bagikan secara manual.');
    }
  }
</script>


<!-- ada scrolnya -->
<script>
// Fungsi untuk menangani klik tombol "like" tanpa refresh
function likePhoto(fotoid) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= base_url('welcome/like_photo') ?>', true); // Ganti URL dengan endpoint yang sesuai
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Setelah like berhasil, lakukan redirect untuk memperbarui halaman
                    window.location.reload(true);
                    // Setelah like/dislike berhasil, scroll ke bawah secara smooth
                    var scrollTarget = document.getElementById('footer');
scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
    xhr.open('POST', '<?= base_url('welcome/dislike_photo') ?>', true); // Ganti URL dengan endpoint yang sesuai
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    // Setelah dislike berhasil, lakukan redirect untuk memperbarui halaman
                    window.location.reload(true);
                    // Setelah like/dislike berhasil, scroll ke bawah secara smooth
                    var scrollTarget = document.getElementById('footer');
scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'start' });
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
    var photoSection = document.getElementById('photo-section');
     // Ganti dengan ID sesuai bagian yang ingin diperbarui
    // Anda dapat menggunakan teknik lain seperti fetch, jQuery AJAX, atau library lainnya untuk memuat ulang bagian-bagian tertentu dari halaman.
    // Contoh: photoSection.innerHTML = "Content to refresh"; atau load dari server
}

</script>