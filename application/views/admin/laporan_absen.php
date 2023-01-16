<div class="card m-5">
    <div class="card-header text-center">
        <h3>Laporan Bulan <?= date('F', mktime(0, 0, 0, $bulan)) . " $tahun"; ?></h3>
    </div>
    <div class="card-body" style="overflow-x: scroll;">
        <table class="table table-bordered" id="absen">
            <thead>
                <tr class="text-center">
                    <th colspan="<?= (int)cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun) + 2; ?>">
                        Absensi <?= $nama_rptra; ?>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2" scope="col" style="vertical-align: middle">No</th>
                    <th rowspan="2" scope="col w-10" style="vertical-align: middle">Nama Pengelola</th>
                    <?php for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); $i++) : ?>
                        <td colspan="2" class="text-center"><?= $i; ?></td>
                    <?php endfor ?>
                </tr>
                <tr class="text-center">
                    <?php for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); $i++) : ?>
                        <td>Masuk</td>
                        <td>Keluar</td>
                    <?php endfor ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $user->nama_lengkap; ?></td>
                        <?php for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); $i++) : ?>
                            <?php $absen = $this->M_rptra->cek_absen($user->ID_user, "$i-" . date('F', mktime(0, 0, 0, $bulan)) . "-$tahun");
                            if ($absen) {
                                echo '<td>' . format_jam($absen->created_at) . '</td>';
                                if ($absen->jam_pulang) {
                                    echo '<td>' . format_jam($absen->jam_pulang) . '</td>';
                                } else {
                                    echo '<td></td>';
                                }
                            } else {
                                echo '<td></td>';
                                echo '<td></td>';
                            } ?>
                        <?php endfor ?>
                    </tr>
                <?php $no++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<script src="<?= base_url('assets'); ?>/plugin/export-excel/shim.min.js"></script>
<script src="<?= base_url('assets'); ?>/plugin/export-excel/xlsx.mini.min.js"></script>
<script>
    let data = document.getElementById('absen')
    let file = XLSX.utils.table_to_book(data, {
        sheet: '<?= date('F', mktime(0, 0, 0, $bulan)); ?> <?= $tahun; ?>.xlsx'
    });
    XLSX.write(file, {
        bookType: 'xlsx',
        bookSST: true,
        type: 'base64'
    });
    XLSX.writeFile(file, 'absensi <?= $nama_rptra; ?> <?= date('F', mktime(0, 0, 0, $bulan)) . " $tahun"; ?>.xlsx');
</script>