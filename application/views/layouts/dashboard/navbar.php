<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= $page; ?></li>
                </ol>
                <h6 class="font-weight-bolder mb-0"><?= $page; ?></h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <!-- <div class="input-group input-group-outline">
                        <label class="form-label">Type here...</label>
                        <input type="text" class="form-control">
                    </div> -->
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="dropdownMenuButton" data-bs-toggle="dropdown">
                            <?= $this->M_rptra->getByID('users', ['ID_user' => $this->ID_user], 'nama_lengkap'); ?> <i class="fa fa-user ms-sm-1"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="">
                                <a class="dropdown-item border-radius-md d-flex align-items-center" href="<?= base_url('lihat/profile'); ?>">
                                    <span class="material-icons me-2">
                                        manage_accounts
                                    </span>
                                    <span>manage profile</span>
                                </a>
                            </li>
                            <hr>
                            <li class="">
                                <a class="dropdown-item border-radius-md d-flex align-items-center" href="<?= base_url('authentication/logout'); ?>">
                                    <i class="material-icons opacity-10" style="transform: rotate(180deg);">logout</i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">