<div class="item-details-page">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h2>View Details <em>For Item</em> Here.</h2>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="left-image">
          <img src="<?= base_url('assets/image_foto/' . $foto->lokasi) ?>" alt=""
            style="border-radius: 20px; object-fit: cover;">
        </div>
      </div>
      <div class="col-lg-5 align-self-center">
        <h4>
          <?= $foto->judul ?>
        </h4>
        <span class="author">
          <img src="<?= base_url('assets/image_user/' . $foto->image) ?>" alt=""
            style="max-width: 50px; border-radius: 50%;">
          <h6>
            <?= $foto->nama_lengkap ?><br><a href="<?= base_url('profile/view/' . $foto->userid) ?>">@<?= $foto->username ?>
            </a>
          </h6>
        </span>
        <p>
          <?= $foto->deskripsi ?>
        </p>

        <div class="row">
          <div class="col-12">
            <div style="max-height: 300px; overflow-y: auto;">
              <!-- Daftar Komentar -->
              <div class="comments-section">
                <!-- Komentar 1 -->
                <h4>Kolom Komentar</h4>
                <?php foreach ($comments as $comment): ?>
                <div class="comment" style="display: flex; align-items: flex-start;">
                  <div class="comment-meta mr-3">
                    <img src="<?= base_url('assets/image_user/' . $comment->image) ?>"
                      style="width: 50px; border-radius: 50%; height: 50px; object-fit: cover;" alt="Profile Picture">
                  </div>
                  <div class="comment-content">
                    <div class="author-info">
                      <strong style="color: white; margin-left: 10px;">
                        <?= $comment->nama_lengkap ?>
                      </strong>
                      <small style="color: white; font-size: 12px;">-
                        <?= $comment->tanggal ?>
                      </small>
                      <p style="color: white; padding: 5px;">
                        <?= $comment->komentar ?>
                      </p>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Formulir untuk menambahkan komentar baru -->
            <form action="<?= base_url('welcome/add_comment') ?>" method="post">
              <input type="hidden" name="fotoid" value="<?= $foto->fotoid ?>">

              <textarea class="form-control" rows="4" placeholder="Tulis komentar Anda di sini..."
                name="komentar" required></textarea>

              <div class="justify-content-between align-items-center mt-3">
                <?php if ($level_user == 1 || $level_user == 2) : ?>
                <?php if ($is_liked) : ?>
                <div style="background-color: transparent; border: none; color: white;">
                  <a href="<?= base_url('welcome/remove_like/' . $foto->fotoid) ?>"><i class="fas fa-heart"
                      style="color: red; font-size: 15px; padding: 5px; text-align: center;">
                      <p>
                        <?= isset($total_likes_per_fotoid) ? $total_likes_per_fotoid : 0 ?>
                      </p>
                    </i></a>
                  <a href="<?= base_url('share/' . $foto->fotoid) ?>"><i class="fa fa-paper-plane"
                      style="color: white; font-size: 15px; padding: 10px; text-align: center;">
                      <p>Share</p>
                    </i></a>
                </div>
                <?php else : ?>
                <div style="background-color: transparent; border: none; color: white;">
                  <a href="<?= base_url('welcome/add_like/' . $foto->fotoid) ?>"><i class="fas fa-heart"
                      style="color: white; font-size: 15px; padding: 10px; text-align: center;">
                      <p>
                        <?= isset($total_likes_per_fotoid) ? $total_likes_per_fotoid : 0 ?>
                      </p>
                    </i></a>
                    <a href="<?= base_url('share/' . $foto->fotoid) ?>"><i class="fa fa-paper-plane"
                      style="color: white; font-size: 15px; padding: 10px; text-align: center;">
                      <p>Share</p>
                    </i></a>
                </div>
                <?php endif; ?>
                <?php else : ?>
                <!-- Bagian Share Tanpa Login -->
                <a style="margin-left: 50px" href="<?= base_url('login') ?>"><i class="fas fa-heart"
                    style="color: white; font-size: 15px; padding: 10px; text-align: center;">
                    <p>
                      <?= isset($total_likes_per_fotoid) ? $total_likes_per_fotoid : 0 ?>
                    </p>
                  </i></a>
                  <a href="<?= base_url('share/' . $foto->fotoid) ?>"><i class="fa fa-paper-plane"
                      style="color: white; font-size: 15px; padding: 10px; text-align: center;">
                      <p>Share</p>
                    </i></a>
                <?php endif; ?>

                <button type="submit" style=" margin-left: 20px;" class="btn btn-primary">Kirim Komentar</button>
              </div>
            </form>



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
                .then(() => console.log('Berbagi berhasil.'));
                .catch ((error) => console.error('Error sharing:', error));
            } else {
              // Fallback jika browser tidak mendukung navigator.share
              alert('Browser Anda tidak mendukung fitur ini. Silakan bagikan secara manual.');
            }
          }
        </script>


        <form action="submit">
          <label for="quantity-text">Kategori :
            <?= $foto->nama_album ?>
          </label>

        </form>
      </div>
      <div class="col-lg-12">
        <div class="current-bid">
          <div class="row">
            <div class="col-lg-6">
              <div class="mini-heading">
                <h4>Rekomendasi Dari Album
                  <?= $foto->nama_album ?>
                </h4>
              </div>
            </div>
            <div class="col-lg-6">
             
            </div>

            <?php foreach ($rekomendasi_foto as $key => $value) { ?>
            <div class="col-lg-4 col-md-6">
              <div class="item">
                <div class="left-img">
                  <img src="<?= base_url('assets/image_foto/' . $value->lokasi) ?>" alt="" style="object-fit: cover;">
                </div>
                <div class="right-content">
                  <h4>
                    <?= $value->nama_lengkap ?>
                  </h4>
                  <a href="<?= base_url('profile/view/' . $foto->userid) ?>">@<?= $value->username ?></a>
                  <div class="line-dec"></div>

                  <?php
                      $days = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                      $months = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                      $timestamp = strtotime($value->tanggal);
                      $dayOfWeek = $days[date('w', $timestamp)];
                      $dayOfMonth = date('j', $timestamp);
                      $month = $months[date('n', $timestamp)];
                      $year = date('Y', $timestamp);
                      $time = date('H:i', $timestamp);
                  ?>
                  <span class="date">
                    <?= $dayOfWeek . ", " . $dayOfMonth . " " . $month . " " . $year . ", "?>
                    <a href="<?= base_url('welcome/detail/' . $value->fotoid) ?>" style="color: white;">View Details</a>
                  </span>

                </div>
              </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>