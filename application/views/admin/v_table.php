<?= $this->session->flashdata('notif'); ?>
<div class="row mb-4">
    <div class="col mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6><?= $page; ?></h6>
                    </div>
                </div>
            </div>
            <div class="card-body px-3 pb-2">
                <div class="tambah">
                    <a href="<?= set_url('tambah'); ?>" class="btn btn-sm btn-success">Tambah</a>
                </div>
                <?php if (!$data) : ?>
                    <div class="text-center text-secondary py-5" style="border-top: 1px solid #000">
                        <h4>Tidak ada</h4>
                    </div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-5">No</th>
                                    <?php foreach ($ths as $th) : ?>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?= $th; ?></th>
                                    <?php endforeach; ?>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $d) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no; ?></td>
                                        <?php foreach ($fields as $field) : ?>
                                            <?php if ($field == 'foto') : ?>
                                                <td class="text-center"><img src="<?= base_url('assets'); ?>/img/pengurus/<?= htmlentities($d[$field]); ?>" alt="" width="50" height="50" style="object-fit:cover;"></td>
                                            <?php elseif ($field == 'logo') : ?>
                                                <td class="text-center"><img src="<?= base_url('assets'); ?>/img/logo/<?= htmlentities($d[$field]); ?>" alt="" width="50" height="50" style="object-fit:cover;"></td>
                                            <?php else : ?>
                                                <?php if ($field == 'alamat') : ?>
                                                    <td class="text-center"><?= $d[$field]; ?></td>
                                                <?php else : ?>
                                                    <td class="text-center"><?= htmlentities($d[$field]); ?></td>
                                                <?php endif; ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <td class="text-center">
                                            <a href="<?= set_url('rubah') . "/$d[$ID]" ?>" class="btn btn-sm btn-info">Ubah</a>
                                            <button type="button" id="btn-hapus-<?= $d[$ID] ?>" class="btn btn-sm btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <script>
                                        $('#btn-hapus-<?= $d[$ID] ?>').on('click', function() {
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
                                                    window.location.replace('<?= set_url('hapus') . "/$d[$ID]" ?>')
                                                }
                                            })
                                        })
                                    </script>
                                <?php
                                    $no++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>