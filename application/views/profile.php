<?= $this->session->flashdata('notif'); ?>
<div class="row row-cols-1 row-cols-lg-2">
    <div class="col col-lg-4">
        <div class="card shadow text-center mb-2">
            <div class="card-body d-flex align-items-center flex-column">
                <style>
                    #pen {
                        position: absolute;
                        color: white;
                        border-radius: 50%;
                        padding: 5px;
                        top: 7%;
                        left: 77%;
                        cursor: pointer;
                    }
                </style>
                <div class="foto position-relative" style="width:200px;">
                    <img src="<?= base_url('assets'); ?>/img/pengurus/default-L.png" alt="" width="200" class="rounded-circle border border-4 border-success">
                    <i class="material-icons bg-success" id="pen">edit</i>
                </div>
                <h4 class="card-title mb-0 mt-2"><?= $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'nama_lengkap'); ?></h4>
                <p class="card-text"><?= $this->M_rptra->getByID('jabatan', ['ID_jbtn' => $this->ID_jbtn], 'posisi'); ?></p>
            </div>
        </div>
    </div>
    <div class="col col-lg-8">
        <div class="card shadow">
            <form action="<?= base_url('rubah/profile'); ?>" method="POST">
                <div class="card-body">
                    <div class="input-group input-group-static mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?= $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'email'); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#rubah_password">Rubah Password</button>
                    </div>
                    <div class=" input-group input-group-static mb-3">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'nama_lengkap'); ?>">
                    </div>
                    <div class="input-group input-group-static mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="<?= $jenis_kelamin; ?>"><?= $jenis_kelamin; ?></option>
                            <?php if ($jenis_kelamin == 'Perempuan') : ?>
                                <option value="Laki - Laki">Laki - Laki</option>
                            <?php else : ?>
                                <option value="Perempuan">Perempuan</option>
                            <?php endif ?>
                        </select>
                    </div>
                    <div class="input-group input-group-static mb-3">
                        <label for="instagram">Instagram</label>
                        <input type="text" class="form-control" name="instagram" id="instagram" value="<?= $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'instagram'); ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rubah_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-static mb-3">
                    <label for="password_lama">Password Lama</label>
                    <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukan password lama anda">
                </div>
                <div class="input-group input-group-static mb-3">
                    <label for="password_baru">Password Baru</label>
                    <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukan password baru">
                </div>
                <div class="input-group input-group-static mb-3">
                    <label for="konfirmasi">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="konfirmasi" id="konfirmasi" placeholder="Ulangi password baru">
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-rubah">SImpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#btn-rubah').on('click', function() {
        var form_data = new FormData();
        form_data.append('password_lama', $('#password_lama').val());
        form_data.append('password_baru', $('#password_baru').val());
        form_data.append('konfirmasi', $('#konfirmasi').val());
        $.ajax({
            url: '<?= base_url('rubah/password'); ?>',
            type: 'POST',
            data: form_data,
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            success: function(output) {
                if (output.success) {
                    Swal.fire({
                        icon: output.icon,
                        title: output.title,
                        text: output.text,
                    }).then((ok) => {
                        if (ok) {
                            window.location.replace('<?= current_url(); ?>');
                        }
                    })
                } else {
                    Swal.fire({
                        icon: output.icon,
                        title: output.title,
                        text: output.text,
                    })
                }
            }
        })
    })
</script>