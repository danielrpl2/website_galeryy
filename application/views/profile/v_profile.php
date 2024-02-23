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
            <?= $this->session->userdata('nama_lengkap'); ?>
             <a href="<?= base_url('profile/edit_profile') ?>" style="color: white; padding: 10px;"><i class="fa fa-pencil" aria-hidden="true"></i>
        </a> <br>
             <a
              href="<?= base_url('profile/view/' . $user_data->userid) ?>">@<?= $this->session->userdata('username'); ?>
            </a>
          </h4>
        </div>
        <br>
        <?php if ($this->session->userdata('level_user') == 1): ?>
    <a href="<?= base_url('dashboard') ?>" style="color: white; font-size: 20px;">[ Halaman Admin <i class="fa fa-chart-pie" aria-hidden="true"></i> ]</a>
<?php endif; ?>
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


      <div class="col-lg-12" id="photo-section">
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
              
             

            <button onclick="showModal('<?= $postingan->fotoid ?>')" class="ellipsis" style="position: absolute; top: 10px; right: 10px; color: white; font-size: 15px; background-color: transparent; border: none;">
        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
    </button>

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

<script>
    function showModal(fotoid) {
        var modal = document.getElementById('myModal');
        modal.style.display = "block";

        var deleteBtn = document.getElementById('deleteBtn');
        deleteBtn.onclick = function() {
            confirmDelete(fotoid);
            modal.style.display = "none";
        }

        var editBtn = document.getElementById('editBtn');
        editBtn.href = "<?= base_url('profile/edit/') ?>" + fotoid;
    }

    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = "none";
    }
</script>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 style="text-align: center;">Apakah Anda ingin ?</h3>
        <div style="color: white; text-align: center; padding: 15px;">
        <a id="deleteBtn"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a> | Atau | <a id="editBtn" style="color: white;"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
        </div>
      
    </div>
</div>
<script>
// Fungsi untuk menangani klik tombol "like" tanpa refresh
function likePhoto(fotoid) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= base_url('profile/like_photo_profile') ?>', true); // Ganti URL dengan endpoint yang sesuai
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
    xhr.open('POST', '<?= base_url('profile/dislike_photo_profile') ?>', true); // Ganti URL dengan endpoint yang sesuai
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
  /* Modal */
.modal {
    display: none; 
    position: fixed; 
    z-index: 100; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0,0,0,0.4); 
}

/* Modal Content */
.modal-content {
    background-color: black;
    margin: 15% auto; 
    padding: 20px;
    top: 10%;

    border: 1px solid #888;
    width: 60%; 
    max-width: 600px; /* Set max width of the modal */
}

.modal-content a{
  color: black;
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Media Query for Responsive Layout */
@media screen and (max-width: 768px) {
    .modal-content {
        margin: 10% auto;
        width: 80%; /* Adjust modal width for smaller screens */
    }
}

</style>
