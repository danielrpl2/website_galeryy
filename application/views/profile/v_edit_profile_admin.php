<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Profile</h5>






  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function () {
        $("#preview_gambar").change(function () {
            bacaGambar(this);
        });
    });
</script>


            <div class="card-body">
              <h5 class="card-title">Halaman Edit Profile</h5>

              <!-- Multi Columns Form -->
              <form class="row g-3" action="<?= base_url('profile/edit_profile_admin') ?>" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukan Username...." value="<?= $user->username ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" placeholder="Masukan Email...." class="form-control" value="<?= $user->email ?>" required>
                </div>
                <div class="col-md-6">
    <label class="form-label">Password</label>
    <div class="input-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Password...." autocomplete="on" value="<?= $user->password ?>" required>
        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="bi bi-eye"></i>
        </button>
    </div>
</div>

                <div class="col-6">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan Nama...." autocomplete="on" value="<?= $user->nama_lengkap ?>" required>
                </div>
                <div class="col-6">
                  <label class="form-label">Profile</label>
                  <input type="file" name="image" class="form-control" id="preview_gambar" style="width: 100%;">
                </div>


                <div class="col-3">
                <img src="<?= base_url('assets/image_user/'. $user->image) ?>" id="gambar_load" style="width: 80%; border-radius:10px;">
                </div>

                <div class="col-8">
                  <label class="form-label">Alamat</label>
                  <textarea class="form-control" name="alamat" placeholder="Address" id="floatingTextarea" style="height: 100px;"><?= $user->alamat ?></textarea>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form><!-- End Multi Columns Form -->

            </div>
          </div>





</div>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#togglePassword').on('click', function() {
            const passwordField = $('#password');
            const passwordFieldType = passwordField.attr('type');
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $('#togglePassword i').removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $('#togglePassword i').removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
    });
</script>
