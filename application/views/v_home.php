<?php foreach ($background as $bg) : ?>
<div class="main-banner" style="background-image: url(<?=base_url('assets/image_bg/' . $bg->bg)?>);
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  padding-top: 290px;
  padding-bottom: 240px;
  background-color: #2a2a2a;">
   <?php endforeach; ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="header-text">
          <h6>Regar</h6>
          <h2>Walpaper &amp; Foto.</h2>
          <p>Selamat datang di Regar tempat mencari foto ataupun walpaper keren kekinian.</p>
          <div class="buttons">
           
          </div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <div class="owl-banner owl-carousel">
        <?php foreach ($foto as $key => $value) {?>
          <div class="item">
            <img src="<?=base_url('assets/image_foto/' . $value->lokasi)?>" alt="" style="border-radius: 20px;">
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<div class="categories-collections">
  <div class="container">
    <div class="row">

    <!-- Kategori -->
      <div class="col-lg-12">
        <div class="categories">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-heading">
                <div class="line-dec"></div>
                <h2>Cari <em>Kategori</em> Disini.</h2>
              </div>
            </div>

            <?php foreach ($album as $kategori) : ?>
            <div class="col-lg-2 col-sm-6 mb-4">
              <a href="<?= base_url('welcome/album/' . $kategori->albumid) ?>">
              <div class="item">
                <div class="icon" style="width: 62px;
  height: 62px;
  display: inline-block;
  text-align: center;
  line-height: 62px;
  background-color: transparent;
  border-radius: 50%;">
                  <img src="<?=base_url('assets/image_cover/' . $kategori->cover)?>" alt="" style="max-width: 100%; border-radius: 50%;">
                </div>
                <h4><?= $kategori->nama_album ?></h4>
                <div class="icon-button">
                
                </div>
              </div>
            </a>
            </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>

      <!-- Postingan Terbaru -->
      <div class="col-lg-12">
        <div class="categories">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-heading">
                <div class="line-dec"></div>
                <br>
                <br>
                <br>
                <h2>Postingan <em>Terbaru</em> Disini.</h2>
              </div>
            </div>

            <?php foreach ($foto_baru as $key => $value) {?>
            <div class="col-lg-4 col-sm-4" id="photo-section">
              <div class="item" style="margin: 10px;">
                <div class="row">
                  <div class="col-lg-12">
                    <span class="author">
                      <img src="<?=base_url('assets/image_user/' . $value->image)?>" alt=""
                        style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                    </span>
                    <br>
                    <br>
                    <img src="<?=base_url('assets/image_foto/' . $value->lokasi)?>" alt="" style="border-radius: 20px;">
                    <h4><?= $value->judul ?></h4>
                  </div>
                  <hr>
                  <div class="col-lg-12">
                    <div class="line-dec"></div>
                    <div class="row">
                      <div class="col-6">
                        <?php if ($level_user && $level_user <= 2): ?>
                        <!-- Letakkan di dalam loop foreach untuk setiap foto -->
                        <?php if ($this->session->userdata('userid')): ?>
                        <?php if ($this->m_like->isLiked($value->fotoid, $this->session->userdata('userid'))): ?>
                          <button id="dislike-button-<?= $value->fotoid ?>" onclick="dislikePhoto(<?= $value->fotoid ?>)" style="background-color: transparent; border: none; color: white;"> 
                          <i class="fas fa-heart" style="color: red; font-size: 18px;"></i>
                          <p><?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?></p>
                        </button>
                        <?php else: ?>
                          <button id="like-button-<?= $value->fotoid ?>" onclick="likePhoto(<?= $value->fotoid ?>)" style="background-color: transparent; border: none; color: white;">
                          <i class="fas fa-heart" style="color: white; font-size: 18px;"></i>
                          <p><?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?></p>
                        </button>

                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                      </div>
                      <div class="col-6">
                        <span><i class="fas fa-comment" style="color: white;"></i><a
                            href="<?=base_url('welcome/detail/' . $value->fotoid)?>" style="color: white;">
                            Komentar</a></span>
                        <span><button onclick="shareContent()"
                            style="background-color: transparent; border: none; color: white;"><i
                              class="fa fa-paper-plane"
                              style="color: white; font-size: 12px; padding: 10px; text-align: center;">
                              Share</i></button></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="main-button">
                      <a href="<?= base_url('welcome/detail/' . $value->fotoid) ?>">View Details</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>



          </div>
        </div>
      </div>

      <!-- Paling Banyak Dilike -->
      <div class="col-lg-12">
        <div class="categories">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-heading">
                <div class="line-dec"></div>
                <br>
                <br>
                <br>
                <h2>Postingan <em>Paling Banyak</em> Dilike.</h2>
              </div>
            </div>

            <?php foreach ($most_liked_photos as $liked_photo) : ?>
            <?php $photo_detail = $this->m_foto->get_data($liked_photo->fotoid); ?>
            <div class="col-lg-4 col-sm-4">
              <div class="item" style="margin: 10px;">
                <div class="row">
                  <div class="col-lg-12">
                    <span class="author">
                      <img src="<?=base_url('assets/image_user/' . $photo_detail->image)?>" alt=""
                        style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                    </span>
                    <br>
                    <br>
                    <img src="<?=base_url('assets/image_foto/' . $photo_detail->lokasi)?>" alt=""
                      style="border-radius: 20px;">
                    <h4><?= $photo_detail->judul ?></h4>
                  </div>
                  <hr>
                  <div class="col-lg-12">
                    <div class="line-dec"></div>
                    <div class="row">
                       <div class="col-6">
                        <?php if ($level_user && $level_user <= 2): ?>
                        <!-- Letakkan di dalam loop foreach untuk setiap foto -->
                        <?php if ($this->session->userdata('userid')): ?>
                        <?php if ($this->m_like->isLiked($liked_photo->fotoid, $this->session->userdata('userid'))): ?>
                          <button id="dislike-button-<?= $liked_photo->fotoid ?>" onclick="dislikePhoto(<?= $liked_photo->fotoid ?>)" style="background-color: transparent; border: none; color: white;"> 
                          <i class="fas fa-heart" style="color: red; font-size: 18px;"></i>
                          <p><?=isset($total_likes_per_fotoid[$liked_photo->fotoid]) ? $total_likes_per_fotoid[$liked_photo->fotoid] : 0?></p>
                        </button>
                        <?php else: ?>
                          <button id="like-button-<?= $liked_photo->fotoid ?>" onclick="likePhoto(<?= $liked_photo->fotoid ?>)" style="background-color: transparent; border: none; color: white;">
                          <i class="fas fa-heart" style="color: white; font-size: 18px;"></i>
                          <p><?=isset($total_likes_per_fotoid[$liked_photo->fotoid]) ? $total_likes_per_fotoid[$liked_photo->fotoid] : 0?></p>
                        </button>

                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$liked_photo->fotoid]) ? $total_likes_per_fotoid[$liked_photo->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$liked_photo->fotoid]) ? $total_likes_per_fotoid[$liked_photo->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                      </div>
                      <div class="col-6">
                        <span><i class="fas fa-comment" style="color: white;"></i><a
                            href="<?=base_url('welcome/detail/' . $liked_photo->fotoid)?>" style="color: white;">
                            Komentar</a></span>
                        <span><button onclick="shareContent()"
                            style="background-color: transparent; border: none; color: white;"><i
                              class="fa fa-paper-plane"
                              style="color: white; font-size: 12px; padding: 10px; text-align: center;">
                              Share</i></button></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="main-button">
                      <a href="<?= base_url('welcome/detail/' . $liked_photo->fotoid) ?>">View Details</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>



          </div>
        </div>
      </div>

      <!-- Paling Banyak Dikomentari -->
      <div class="col-lg-12">
        <div class="categories">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-heading">
                <div class="line-dec"></div>
                <br>
                <br>
                <br>
                <h2>Postingan <em>Paling Banyak</em> Dikomentari.</h2>
              </div>
            </div>

            <?php foreach ($most_coment_photos as $coment_photo) : ?>
            <?php $photo_detail = $this->m_foto->get_data($coment_photo->fotoid); ?>
            <div class="col-lg-4 col-sm-4">
              <div class="item" style="margin: 10px;">
                <div class="row">
                  <div class="col-lg-12">
                    <span class="author">
                      <img src="<?=base_url('assets/image_user/' . $photo_detail->image)?>" alt=""
                        style="max-width: 50px; max-height: 50px; border-radius: 50%;">
                    </span>
                    <br>
                    <br>
                    <img src="<?=base_url('assets/image_foto/' . $photo_detail->lokasi)?>" alt=""
                      style="border-radius: 20px;">
                    <h4><?= $photo_detail->judul ?></h4>
                  </div>
                  <hr>
                  <div class="col-lg-12">
                    <div class="line-dec"></div>
                    <div class="row">
                    <div class="col-6">
                        <?php if ($level_user && $level_user <= 2): ?>
                        <!-- Letakkan di dalam loop foreach untuk setiap foto -->
                        <?php if ($this->session->userdata('userid')): ?>
                        <?php if ($this->m_like->isLiked($coment_photo->fotoid, $this->session->userdata('userid'))): ?>
                          <button id="dislike-button-<?= $coment_photo->fotoid ?>" onclick="dislikePhoto(<?= $coment_photo->fotoid ?>)" style="background-color: transparent; border: none; color: white;"> 
                          <i class="fas fa-heart" style="color: red; font-size: 18px;"></i>
                          <p><?=isset($total_likes_per_fotoid[$coment_photo->fotoid]) ? $total_likes_per_fotoid[$coment_photo->fotoid] : 0?></p>
                        </button>
                        <?php else: ?>
                          <button id="like-button-<?= $coment_photo->fotoid ?>" onclick="likePhoto(<?= $coment_photo->fotoid ?>)" style="background-color: transparent; border: none; color: white;">
                          <i class="fas fa-heart" style="color: white; font-size: 18px;"></i>
                          <p><?=isset($total_likes_per_fotoid[$coment_photo->fotoid]) ? $total_likes_per_fotoid[$coment_photo->fotoid] : 0?></p>
                        </button>

                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$coment_photo->fotoid]) ? $total_likes_per_fotoid[$coment_photo->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                        <?php else: ?>
                        <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                          <i class="fas fa-heart" style="color: white;"></i>
                          <p>
                            <?=isset($total_likes_per_fotoid[$coment_photo->fotoid]) ? $total_likes_per_fotoid[$coment_photo->fotoid] : 0?>
                          </p>
                        </a>
                        <?php endif;?>
                      </div>
                      <div class="col-6">
                      <span><i class="fas fa-comment" style="color: white;"></i><a
                            href="<?=base_url('welcome/detail/' . $photo_detail->fotoid)?>" style="color: white;">
                            Komentar</a></span>
                        <span><button onclick="shareContent()"
                            style="background-color: transparent; border: none; color: white;"><i
                              class="fa fa-paper-plane"
                              style="color: white; font-size: 12px; padding: 10px; text-align: center;">
                              Share</i></button></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="main-button">
                      <a href="<?= base_url('welcome/detail/' . $photo_detail->fotoid) ?>">View Details</a>
                    </div>
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


<script>
// Fungsi untuk menangani klik tombol "like" tanpa refresh
function likePhoto(fotoid) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= base_url('welcome/like_photo_home') ?>', true); // Ganti URL dengan endpoint yang sesuai
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
    xhr.open('POST', '<?= base_url('welcome/dislike_photo_home') ?>', true); // Ganti URL dengan endpoint yang sesuai
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