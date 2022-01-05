<?= $this->session->flashdata('notif'); ?>
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">pengunjung</p>
                    <h4 class="mb-0"><?= $this->db->count_all_results('pengunjung');; ?></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-secondary shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">people</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Pengurus</p>
                    <h4 class="mb-0"><?= $this->M_rptra->total('users', ['ID_role' => 2]); ?></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">event_available</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Hadir Hari ini</p>
                    <h4 class="mb-0"><?= $this->M_rptra->total_absen('hadir'); ?></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">event_note</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Izin Hari ini</p>
                    <h4 class="mb-0"><?= $this->M_rptra->total_absen('izin'); ?></h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col my-4">
        <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 "> Statistic Pengunjung Tiap Bulan </h6>
            </div>
        </div>
    </div>
</div>