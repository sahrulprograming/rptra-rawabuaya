<!-- Navbar Versi Dekstop -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-none d-sm-block" id="nav-desktop">
    <div class="container-fluid position-relative px-lg-5">
        <div class="logo-navbar">
            <a href="#"><img src="<?= base_url('assets'); ?>/img/logo fkp.jpg"></a>
        </div>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-bold" aria-current="page" href="<?= base_url('home'); ?>">BERANDA</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold" href="#" id="profile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        PROFILE
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profile">
                        <li><a class="dropdown-item" href="<?= base_url('lihat/tupoksi'); ?>">TUPOKSI</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('lihat/visi_misi'); ?>">Visi dan Misi</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('lihat/struktur'); ?>">STRUKTUR ORGANISASI</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        POKJA
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">POKJA I</a></li>
                        <li><a class="dropdown-item" href="#">POKJA II</a></li>
                        <li><a class="dropdown-item">POKJA III</a></li>
                        <li><a class="dropdown-item" href="#">POKJA IV</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ARTIKLE
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('blog'); ?>">BLOG</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('berita'); ?>">BERITA</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <?php if ($this->session->userdata('ID_role')) : ?>
                        <a class="nav-link fw-bold" href="<?= base_url('admin/home'); ?>">DASHBOARD</a>
                    <?php else : ?>
                        <a class="nav-link fw-bold" href="<?= base_url('login'); ?>">LOGIN</a>
                    <?php endif ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<nav class="d-block d-sm-none fixed-bottom" id="nav-mobile">
    <ul class="mobile-nav">
        <li class="nav-item-mobile pt-1">
            <a class="nav-link-mobile" aria-current="page" href="#">
                <i class="material-icons">
                    search
                </i>
            </a>
        </li>
        <li class="nav-item-mobile pt-1">
            <a class="nav-link-mobile" aria-current="page" href="#">
                <i class="material-icons">
                    window
                </i>
            </a>
        </li>
        <li class="nav-item-mobile pt-0" id="home">
            <a class="nav-link-mobile" aria-current="page" href="<?= base_url(); ?>">
                <i class="material-icons text-dark">
                    home
                </i>
            </a>
        </li>
        <li class="nav-item-mobile pt-1">
            <a class="nav-link-mobile" aria-current="page" href="#">
                <i class="material-icons">
                    business
                </i>
            </a>
        </li>
        <?php if ($this->session->userdata('ID_role')) : ?>
            <li class="nav-item-mobile pt-1">
                <a class="nav-link-mobile" aria-current="page" href="<?= base_url($this->M_rptra->getByID('role', ['ID_role' => $this->session->userdata('ID_role')], 'role') . '/home') ?>">
                    <img src="<?= base_url('assets'); ?>/img/pengurus/<?= $this->M_rptra->getByID('users', ['ID_user' => $this->session->userdata('ID_user')], 'foto'); ?>" alt="foto-profile" width="35" height="35" class="rounded-circle" style="object-fit:cover;">
                </a>
            </li>
        <?php else : ?>
            <li class="nav-item-mobile pt-1">
                <a class="nav-link-mobile" aria-current="page" href="<?= base_url('Authentication/login'); ?>">
                    <i class="material-icons">
                        login
                    </i>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>