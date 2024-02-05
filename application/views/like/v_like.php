<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Daftar Like</h5>
                    <a class="btn btn-primary" href="<?= base_url('like/add') ?>">Tambah <i
                            class="bx bx-plus-medical"></i></a>
                    <hr>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fotoid</th>
                                <th>Userid</th>
                                <th>Tanggal</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                foreach ($like as $key => $value) { ?>
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
                                    <?= $value->tanggal ?>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="<?=base_url('like/edit/' . $value->likeid)?>"><i
                                    class="bi bi-pencil-square"></i></a>
                                    <button onclick="confirmDelete('<?=$value->likeid?>')" class="btn btn-danger"><i
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
    function confirmDelete(likeid) {
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
                window.location.href = '<?=base_url("like/delete/")?>' + likeid;
            }
        });
    }
</script>