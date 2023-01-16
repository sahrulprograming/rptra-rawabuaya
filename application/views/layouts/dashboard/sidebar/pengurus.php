<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= base_url(); ?>">
            <img src="<?= base_url('assets'); ?>/img/logo fkp.jpg" class="navbar-brand-img h-100 rounded-circle" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white"><?= nama_web(); ?></span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white <?= cek_active('pengurus/home'); ?>" href="<?= base_url('pengurus/home'); ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">event_available</i>
                    </div>
                    <span class="nav-link-text ms-1">Absen</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= cek_active('authentication/logout'); ?>" href="<?= base_url('authentication/logout'); ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10" style="transform: rotate(180deg);">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>