<!-- <div class="page-heading normal-space">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h6>Detail</h6>
          <h2>View Details For Author</h2>
          <span>Home > <a href="#">Author</a></span>
          <div class="buttons">
            <div class="main-button">
              <a href="explore.html">Explore Our Items</a>
            </div>
            <div class="border-button">
              <a href="create.html">Create Your NFT</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
<div class="mt-2"></div>
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
            <div class="col-6">
              <div class="info-item">
                <i class="fa fa-heart"></i>
                <h6>
                  <?=$total_like?> <em>Likes</em>
                </h6>
              </div>
            </div>
            <div class="col-6">
              <div class="info-item">
                <i class="fa fa-comment"></i>
                <h6>
                  <?=$total_komentar?> <em>Komentar</em>
                </h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h2><?=$user_data->nama_lengkap?> <em>Postingan</em>.</h2>
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