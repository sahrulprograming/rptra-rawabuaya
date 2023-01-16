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
                <a class="nav-link text-white <?= cek_active('admin/home'); ?>" href="<?= base_url('admin/home'); ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" class="nav-link text-white <?= cek_active('master'); ?>" href="#master" role="button">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">collections_bookmark</i>
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">master</span>
                </a>
                <div class="collapse" id="master">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lihat/master/rptra'); ?>" class="nav-link text-white <?= cek_active('master/rptra'); ?>">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">arrow_forward</i>
                                </div>
                                <span class="nav-link-text ms-1 text-capitalize">daftar rptra</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lihat/master/jabatan'); ?>" class="nav-link text-white <?= cek_active('master/jabatan'); ?>">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">arrow_forward</i>
                                </div>
                                <span class="nav-link-text ms-1 text-capitalize">jabatan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lihat/master/pengurus'); ?>" class="nav-link text-white <?= cek_active('master/pengurus'); ?>">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">arrow_forward</i>
                                </div>
                                <span class="nav-link-text ms-1 text-capitalize">pengurus</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" class="nav-link text-white <?= cek_active('berita'); ?>" href="#berita" role="button">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">newspaper</i>
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">berita</span>
                </a>
                <div class="collapse" id="berita">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lihat/postingan/berita'); ?>" class="nav-link text-white <?= cek_active('postingan/berita'); ?>">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">arrow_forward</i>
                                </div>
                                <span class="nav-link-text ms-1 text-capitalize">Daftar berita</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lihat/kategori/berita'); ?>" class="nav-link text-white <?= cek_active('kategori/berita'); ?>">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">arrow_forward</i>
                                </div>
                                <span class="nav-link-text ms-1 text-capitalize">kategori berita</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" class="nav-link text-white <?= cek_active('blog'); ?>" href="#blog" role="button">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">article</i>
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">blog</span>
                </a>
                <div class="collapse" id="blog">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lihat/postingan/blog'); ?>" class="nav-link text-white <?= cek_active('postingan/blog'); ?>">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">arrow_forward</i>
                                </div>
                                <span class="nav-link-text ms-1 text-capitalize">Daftar blog</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/lihat/kategori/blog'); ?>" class="nav-link text-white <?= cek_active('kategori/blog'); ?>">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">arrow_forward</i>
                                </div>
                                <span class="nav-link-text ms-1 text-capitalize">kategori blog</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" class="nav-link text-white <?= base_url('admin/lihat/absensi'); ?>" href="#absensi" role="button">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">event_available</i>
                    </div>
                    <span class="nav-link-text ms-1 text-capitalize">Absensi</span>
                </a>
                <div class="collapse" id="absensi">
                    <?php $rptra = $this->CRUD->tb_rptra(); ?>
                    <ul class="nav">
                        <?php foreach ($rptra as $rp) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/lihat/absensi/' . $rp->ID_rptra); ?>" class="nav-link text-white <?= cek_active('absensi/' . $rp->ID_rptra); ?>">
                                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="material-icons opacity-10">arrow_forward</i>
                                    </div>
                                    <span class="nav-link-text ms-1 text-capitalize"><?= $rp->nama; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= cek_active('admin/lihat/calender'); ?>" href="<?= base_url('admin/lihat/calender'); ?>">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">event_note</i>
                    </div>
                    <span class="nav-link-text ms-1">Calender</span>
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