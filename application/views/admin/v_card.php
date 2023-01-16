<?= $this->session->flashdata('notif'); ?>
<div class="">
    <a href="<?= set_url('tambah'); ?>" class="btn btn-success">Tambah</a>
</div>
<?php if ($data) : ?>
    <div class="row row-cols-lg-3 mb-4">
        <?php foreach ($data as $d) : ?>
            <div class="col mb-3">
                <div class="card" id="<?= $d[$card['ID']]; ?>">
                    <div class="card-body p-2 position-relative">
                        <a href="<?= base_url($folder . '/' . $d[$card['ID']]); ?>">
                            <img src="/assets/img/<?= $folder; ?>/<?= $d[$card['gambar']]; ?>" style="width:100%;height:220px;object-fit:cover;">
                            <div class="judul position-absolute px-2 text-center text-white" style="bottom:0;left: 0;width: 100%;background: #00000080;">
                                <h4 class="text-white"><?= $d[$card['judul']]; ?></h4>
                                <div class="deskripsi-singkat-<?= $d[$card['ID']]; ?> d-none">
                                    <p><?= strip_tags(substr($d[$card['content']], 0, 128)); ?>...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card-footer d-flex justify-content-between mx-5 py-2">
                        <a class="btn btn-info mb-0" href="<?= set_url('rubah') . '/' . $d[$card['ID']]; ?>">Rubah</a>
                        <button class="btn btn-danger mb-0" id="btn-hapus-<?= $d[$card['ID']]; ?>" type="button">Hapus</button>
                    </div>
                </div>
            </div>
            <script>
                $("#<?= $d[$card['ID']]; ?>").hover(function() {
                    $('.deskripsi-singkat-<?= $d[$card['ID']]; ?>').removeClass('d-none');
                }, function() {
                    $('.deskripsi-singkat-<?= $d[$card['ID']]; ?>').addClass('d-none');
                });
                $('#btn-hapus-<?= $d[$card['ID']]; ?>').on('click', function() {
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Ingin menghapus ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Hapus ini!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.replace('<?= set_url('hapus') . '/' . $d[$card['ID']]; ?>')
                        }
                    })
                })
            </script>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="card">
        <div class="card-body">
            <div class="my-3 text-center">
                <h4>Tidak ada</h4>
            </div>
        </div>
    </div>
<?php endif; ?>