<?= $this->session->flashdata('notif'); ?>
<div class="card shadow">
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-2 justify-content-center">
            <div class="col mb-3">
                <div class="border rounded shadow p-3 text-capitalize">
                    <h5>tanggal</h5>
                    <p><?= format_tanggal(time()); ?></p>
                </div>
            </div>
            <div class="col mb-3">
                <div class="border rounded shadow p-3 text-capitalize">
                    <h5>Batas Absen</h5>
                    <p>19.10 WIB</p>
                </div>
            </div>
            <div class="col mb-3">
                <?php if ($libur) : ?>
                    <div class="border rounded shadow p-3 text-center">
                        <h5><?= $libur['title']; ?></h5>
                        <button class="btn btn-danger btn-sm">LIBUR</button>
                    </div>
                <?php else : ?>
                    <?php if ($sudah_absen) : ?>
                        <?php if ($sudah_absen['status'] == 'hadir') : ?>
                            <div class="border rounded shadow p-3 text-center">
                                <h5>Anda Sudah Absen</h5>
                                <button type="button" class="btn btn-success btn-sm">HADIR</button>
                            </div>
                        <?php else : ?>
                            <div class="border rounded shadow p-3 text-center">
                                <h5>Anda izin hari ini</h5>
                                <button type="button" class="btn btn-primary btn-sm">IZIN</button>
                            </div>
                        <?php endif ?>
                    <?php else : ?>
                        <?php if (date('H:i') < '06:30') : ?>
                            <div class="border rounded shadow p-3 text-center">
                                <h5>Absen di buka pada 06:30</h5>
                                <button type="button" class="btn btn-warning btn-sm">Belum mulai</button>
                            </div>
                        <?php elseif (date('H:i') >= '19:10') : ?>
                            <div class="border rounded shadow p-3 text-center">
                                <h5>Absen telah ditutup pada 19:10 WIB</h5>
                                <button type="button" class="btn btn-danger btn-sm">Selesai</button>
                            </div>
                        <?php else : ?>
                            <div class="border rounded shadow p-3 text-center">
                                <h5>Click Untuk Absen</h5>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#absen">ABSEN</button>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#izin">IZIN</button>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                    <!-- Modal Absen -->
                    <div class="modal fade" id="absen" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="<?= base_url('pengurus/home/absen'); ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bukti Absen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="foto">FOTO SELFIE</label>
                                            <input type="file" class="form-control" name="foto" id="foto" accept="image/png, image/jpg, image.jpeg" capture>
                                            <small id="fileHelpId" class="form-text text-danger">Pilih foto selfie saat ini</small>
                                        </div>
                                        <input type="hidden" name="lat" id="lat">
                                        <input type="hidden" name="lng" id="lng">
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Izin -->
                    <div class="modal fade" id="izin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="<?= base_url('pengurus/home/izin'); ?>" method="post" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bukti Izin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="foto">FOTO SELFIE</label>
                                            <input type="file" class="form-control" name="foto" id="foto" accept="image/png, image/jpg, image.jpeg" capture>
                                            <small id="fileHelpId" class="form-text text-danger">Pilih foto selfie saat ini</small>
                                        </div>
                                        <div class="mb-3 input-group input-group-static">
                                            <label for="foto">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" cols="30" rows="4" class="form-control" placeholder="Masukan keterangan izin"></textarea>
                                        </div>
                                        <input type="hidden" name="lat" id="lat1">
                                        <input type="hidden" name="lng" id="lng1">
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<div class="card shadow my-3">
    <div class="my-4 px-4">
        <h3>History Absensi</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-2 mt-3">
        <div class="col text-center">
            <div class="input-group input-group-static mb-4 px-4">
                <label for="">Bulan</label>
                <select class="form-control" id="bulan" name="bulan">
                    <option value="<?= set_value('bulan') ? set_value('bulan') : getMonth(time()); ?>"><?= set_value('bulan') ? set_value('bulan') : getMonth(time()); ?></option>
                    <?php
                    for ($m = 1; $m <= 12; $m++) :
                        $bulan = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                    ?>
                        <option value="<?= $bulan; ?>"><?= $bulan ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="col text-center">
            <div class="input-group input-group-static mb-4 px-4">
                <label for="">Tahun</label>
                <select class="form-control" id="tahun" name="tahun">
                    <option value="<?= set_value('bulan') ? set_value('bulan') : date('Y'); ?>"><?= set_value('bulan') ? set_value('bulan') : date('Y'); ?></option>
                    <?php
                    $tahun = date('Y');
                    for ($y = 1; $y <= 12; $y++) :
                    ?>
                        <option value="<?= $tahun; ?>"><?= $tahun ?></option>
                    <?php
                        $tahun--;
                    endfor; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="card px-3" id="data_absensi">

    </div>
</div>

<script>
    var x = document.getElementById("demo");

    navigator.geolocation.getCurrentPosition(showPosition);

    function showPosition(position) {
        $('#lat').val(position.coords.latitude);
        $('#lng').val(position.coords.longitude);
        $('#lat1').val(position.coords.latitude);
        $('#lng1').val(position.coords.longitude);
    }

    $('form').submit(function(e) {
        if ($('#lat').val() == '' && $('#lng').val() == '') {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Opss..',
                text: 'Anda wajib memberikan akses lokasi pada rptracempaka.com',
            }).then((ok) => {
                location.reload();
            })
        }
    })
    let bulan = $('#bulan').val();
    let tahun = $('#tahun').val();
    data_absensi(bulan, tahun);

    function data_absensi(bulan, tahun) {
        $.ajax({
            url: '<?php echo base_url('pengurus/home/data_absensi'); ?>',
            data: {
                bulan: bulan,
                tahun: tahun,
            },
            type: 'POST',
            success: function(output) {
                $('#data_absensi').html(output);
            }
        })
    }

    $('select').on('change', function() {
        if ($(this).attr('id') == 'bulan') {
            bulan = $(this).val();
        } else {
            tahun = $(this).val();
        }
        data_absensi(bulan, tahun);
    });
</script>