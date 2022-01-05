<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <!-- Jquery -->
    <script src="<?= base_url('assets'); ?>/plugin/jquery/jquery-3.6.0.min.js"></script>
    <!-- Sweet Alert 2 -->
    <script src="<?= base_url('assets'); ?>/plugin/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugin/sweetalert2/dist/sweetalert2.min.css">

    <!-- Full Calendar -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/plugin/event-calendar-evo/css/evo-calendar.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/plugin/event-calendar-evo/css/evo-calendar.midnight-blue.css" />
    <script src="<?= base_url('assets'); ?>/plugin/event-calendar-evo/js/evo-calendar.js"></script>
    <script src="<?= base_url('assets'); ?>/js/calender/moment.min.js"></script>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugin/bootstrap5/css/bootstrap.min.css">
    <!-- Material icon -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/icon/font-awesome/css/all.css">
    <script src="<?= base_url('assets'); ?>/icon/font-awesome/js/all.min.js"></script>
    <!-- Iframe embed -->
    <script charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key=1fa2a3cd63b91de0273d25"></script>
    <!-- Owl Corasel -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugin/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugin/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <script src="<?= base_url('assets'); ?>/plugin/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <!-- CSS RPTRA -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/rptra.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/grid.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/calender.css">

    <link rel="shortcut icon" href="<?= base_url('assets'); ?>/img/icon2.png" type="image/x-icon">
</head>

<body>
    <main>
        <div class="d-none d-sm-block">
            <header class="d-flex justify-content-center align-items-center text-center position-relative">
                <div class="row position-absolute" style="width: 100%;top:10px;">
                    <div class="col-6 d-flex">
                        <i class="material-icons me-2 text-success">schedule</i>
                        <p class="fw-bold" id="jam"></p>
                    </div>
                    <div class="col-6 justify-content-end d-flex">
                        <i class="material-icons me-2 text-success">calendar_today</i>
                        <p class="fw-bold me-2"><?= ambil_hari(time()) . date(', d F Y'); ?></p>
                    </div>
                    <script>
                        let jam = document.getElementById('jam');
                        time()

                        function time() {
                            var d = new Date();
                            var s = d.getSeconds();
                            var m = d.getMinutes();
                            var h = d.getHours();
                            jam.textContent =
                                ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2) + ' WIB';
                        }

                        setInterval(time, 1000);
                    </script>
                    <div class="col">

                    </div>
                </div>
                <img src="<?= base_url('assets'); ?>/img/icon3.png" alt="header">
            </header>
        </div>
        <!-- Navbar -->