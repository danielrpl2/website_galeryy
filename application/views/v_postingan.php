<div class="page-heading">
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
                  style="max-width: 90%; height: 50vh; margin-left: 18px; border-radius: 20px; object-fit: cover;">
                <div class="hover-effect">
                  <div class="content">
                    <h4>
                      <?=$value->judul?>
                    </h4>
                    <span class="author">
                      <img src="<?=base_url('assets/image_user/' . $value->image)?>" alt=""
                        style="max-width: 50px; max-height: 50px; border-radius: 50%;">
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
          <h2>Postingan Semua <em>User</em>.</h2>
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


            <div class="col-lg-12">
              <div class="line-dec"></div>
              <div class="row">
                <div class="col-6">
                  <?php if ($level_user && $level_user <= 2): ?>
                  <!-- Letakkan di dalam loop foreach untuk setiap foto -->
                  <?php if ($this->session->userdata('userid')): ?>
                  <?php if ($this->m_like->isLiked($value->fotoid, $this->session->userdata('userid'))): ?>
                  <form action="<?=base_url('welcome/dislike_photo')?>" method="post">
                    <input type="hidden" name="fotoid" value="<?=$value->fotoid?>">
                    <button type="submit" style="background-color: transparent; border: none; color: white;">
                      <i class="fas fa-heart" style="color: red;"></i>
                      <p>
                        <?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?>
                      </p>
                    </button>
                  </form>
                  <?php else: ?>
                  <form action="<?=base_url('welcome/like_photo')?>" method="post">
                    <input type="hidden" name="fotoid" value="<?=$value->fotoid?>">
                    <button type="submit" style="background-color: transparent; border: none; color: white;">
                      <i class="fas fa-heart" style="color: white;"></i>
                      <p>
                        <?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?>
                      </p>
                    </button>
                  </form>
                  <?php endif;?>
                  <?php else: ?>
                  <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                    <i class="fas fa-heart" style="color: white;"></i>
                    <p><?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?>
                    </p>
                  </a>
                  <?php endif;?>
                  <?php else: ?>
                  <a href="<?=base_url('login')?>" style="text-decoration: none; color: white;">
                    <i class="fas fa-heart" style="color: white;"></i>
                    <p><?=isset($total_likes_per_fotoid[$value->fotoid]) ? $total_likes_per_fotoid[$value->fotoid] : 0?>
                    </p>
                  </a>
                  <?php endif;?>
                </div>
                <div class="col-6">
                  <span><i class="fas fa-comment"></i><a href="<?=base_url('welcome/detail/' . $value->fotoid)?>"
                      style="color: white;"> Komentar</a></span>
                      <span><button onclick="shareContent()"
                      style="background-color: transparent; border: none; color: white;"><i class="fa fa-paper-plane"
                        style="color: white; font-size: 12px; padding: 10px; text-align: center;">
                        Share</i></button></span>
                        
                  <!-- <?php if ($this->session->userdata('userid') && $level_user <= 3): ?>
                  <span><button onclick="shareContent()"
                      style="background-color: transparent; border: none; color: white;"><i class="fa fa-paper-plane"
                        style="color: white; font-size: 12px; padding: 10px; text-align: center;">
                        Share</i></button></span>
                  <?php endif;?> -->
                </div>
              </div>
            </div>


            <div class="col-lg-12">
              <div class="main-button">
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