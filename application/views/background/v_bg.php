<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Background</h5>
                    <!-- <a class="btn btn-primary" href="<?=base_url('background/add')?>">Tambah <i
                            class="bx bx-plus-medical"></i> </a> -->
                    <hr>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peringatan</th>
                                <th>Background</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                                foreach ($background as $key => $value) {?>
                            <tr>
                                <td>
                                    <?=$no++;?>
                                </td>
                                <td>
                                !! <small>Masukan Gambar Berukuran 16:9</small> !!
                                </td>
                                <td>
                                    <img src="<?= base_url('assets/image_bg/' . $value->bg) ?>"
                                        style="border-radius: 10px; width: 70px; text-align: center;" alt="">
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="<?=base_url('background/edit/' . $value->bghome)?>"><i
                                    class="bi bi-pencil-square"></i></a>
                                    <button onclick="confirmDelete('<?=$value->bghome?>')" class="btn btn-danger"><i
                                            class="bx bxs-trash"></i></button>


                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>


<script>
    function confirmDelete(bghome) {
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
                window.location.href = '<?=base_url("background/delete/")?>' + bghome;
            }
        });
    }
</script>