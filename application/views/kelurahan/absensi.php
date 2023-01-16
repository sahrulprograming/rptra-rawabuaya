<?= $this->session->flashdata('notif'); ?>
<div class="card shadow my-3">
    <div class="my-4 px-4">
        <h3>History Absensi</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-3 mt-3">
        <div class="col text-center">
            <div class="input-group input-group-static mb-4 px-4">
                <label for="hari">Tanggal</label>
                <select class="form-control" id="hari" name="hari">
                    <option value="<?= set_value('hari') ? set_value('hari') : date('d'); ?>"><?= set_value('hari') ? set_value('hari') : date('d'); ?></option>
                </select>
            </div>
        </div>
        <div class="col text-center">
            <div class="input-group input-group-static mb-4 px-4">
                <label for="">Bulan</label>
                <select class="form-control" id="bulan" name="bulan">
                    <option value="<?= set_value('bulan') ? set_value('bulan') : date('m'); ?>"><?= set_value('bulan') ? set_value('bulan') : date('F'); ?></option>
                    <?php
                    for ($m = 1; $m <= 12; $m++) :
                        $bulan = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                    ?>
                        <option value="<?= $m; ?>"><?= $bulan ?></option>
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
    <div class="card px-3">
        <div class="table-responsive">
            <table class="table align-items-center mb-3 border border-top border-2 shadow">
                <thead>
                    <tr>
                        <th class="text-uppercase text-center text-dark text-xxs font-weight-bolder opacity-7 ps-2">tanggal</th>
                        <th class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Pengurus</th>
                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">keterangan</th>
                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">lokasi</th>
                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">AKSI</th>
                    </tr>
                </thead>
                <tbody id="data_absensi">
                </tbody>
            </table>
        </div>
        <div id="modal">

        </div>
    </div>
</div>

<script>
    let hari = $('#hari').val();
    let bulan = $('#bulan').val();
    let tahun = $('#tahun').val();
    data_absensi(hari, bulan, tahun);

    function data_absensi(hari, bulan, tahun) {
        $.ajax({
            url: '<?php echo base_url('kelurahan/ajax/data_absensi/' . $ID_rptra); ?>',
            data: {
                hari: hari,
                bulan: bulan,
                tahun: tahun,
            },
            type: 'POST',
            dataType: 'JSON',
            success: function(output) {
                $('#data_absensi').html(output.data);
                $('#modal').html(output.modal);
            }
        })
    }
    var getDaysInMonth = function(month, year) {
        return new Date(year, month, 0).getDate();
    };
    let jumlah_hari = getDaysInMonth(bulan, tahun)
    for (let day = 1; day <= jumlah_hari; day++) {
        if (day < 10) {
            day = '0' + day
        }
        $('#hari').append('<option value="' + day + '">' + day + '</option>')
    }
    $('select').on('change', function() {
        switch ($(this).attr('id')) {
            case 'hari':
                hari = $(this).val();
                break;
            case 'bulan':
                bulan = $(this).val();
                break
            default:
                tahun = $(this).val();
                break;
        }
        let jumlah_hari = getDaysInMonth(bulan, tahun)
        for (let day = 1; day <= jumlah_hari; day++) {
            if (day < 10) {
                day = '0' + day
            }
            $('#hari').append('<option value="' + day + '">' + day + '</option>')
        }
        data_absensi(hari, bulan, tahun);
    });
</script>