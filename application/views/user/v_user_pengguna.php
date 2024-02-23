<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Daftar <?= $title ?></h5>
                    <a class="btn btn-primary" href="<?= base_url('user/add') ?>">Tambah <i class="bi bi-person-plus-fill"></i></a>
                    <hr>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Nama Lengkap</th>
                                <th>Foto</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                foreach ($user_level_2 as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                </td>
                                <td>
                                    <?= $value->username ?>
                                </td>
                                <td>
                                    <?= $value->password ?>
                                </td>
                                <td>
                                    <?= $value->email ?>
                                </td>
                                <td>
                                    <?= $value->nama_lengkap ?>
                                </td>
                                <td>
                                <img src="<?= base_url('assets/image_user/' . $value->image) ?>" width="100px" style="border-radius: 10px; height: 10vh; object-fit: cover;" alt="">
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="<?= base_url('user/edit_pengguna/' . $value->userid) ?>"><i
                                    class="bi bi-pencil-square"></i></a>
                                    <button onclick="confirmDelete('<?= $value->userid ?>')" class="btn btn-danger"><i
                                            class="bx bxs-trash"></i></button>

                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function confirmDelete(userid) {
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
                window.location.href = '<?= base_url("user/delete/") ?>' + userid;
            }
        });
    }
</script>
