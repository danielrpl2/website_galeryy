<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Daftar Komentar</h5>
                    <a class="btn btn-primary" href="<?= base_url('komentar/add') ?>">Tambah <i
                            class="bx bx-plus-medical"></i></a>
                            <?php if ($jumlah_komentar > 0): ?>
    <button onclick="confirmDeleteAll()" class="btn btn-danger">Hapus Semua Data</button>
<?php endif; ?>
                    <hr>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Komentarid</th>
                                <th>Fotoid</th>
                                <th>Userid</th>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                foreach ($komentar as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?= $no++; ?>
                                </td>
                                <td>
                                    <?= $value->fotoid ?>
                                </td>
                                <td>
                                    <?= $value->userid ?>
                                </td>
                                <td>
                                    <?= $value->komentar ?>
                                </td>
                                <td>
                                    <?= $value->tanggal ?>
                                </td>
                                <td>
                                    <a class="btn btn-warning"
                                        href="<?=base_url('komentar/edit/' . $value->komentarid)?>"><i
                                        class="bi bi-pencil-square"></i></a>
                                    <button onclick="confirmDelete('<?=$value->komentarid?>')" class="btn btn-danger"><i
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
    function confirmDeleteAll() {
        // Menggunakan SweetAlert2 untuk konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menghapus semua data komentar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus semua data!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna menekan tombol "Ya", maka arahkan ke URL delete_all
                window.location = "<?= base_url('komentar/delete_all') ?>";
            }
        });
    }
</script>



<script>
    function confirmDelete(komentarid) {
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
                window.location.href = '<?=base_url("komentar/delete/")?>' + komentarid;
            }
        });
    }
</script>