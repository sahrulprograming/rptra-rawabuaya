<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
<div class="hero" style="background-image: url(<?= base_url('assets/img/hero.jpg'); ?>);">
    <div class="heading d-flex align-items-center flex-column justify-content-center">
        <h1 class="display-1" style="font-family: 'Oswald', sans-serif;">RPTRA CEMPAKA</h1>
        <h3 class="display-3" style="font-family: poppins;">RAWABUAYA</h3>
    </div>
</div>
<section class="container my-3" id="content" style="position:relative;">
    <div class="main-content shadow rounded my-3" id="berita">
        <div class="judul-content mt-0 py-2 px-4 rounded">
            <h2>berita terbaru</h2>
        </div>
        <div class="berita px-4 py-2">
            <?php if ($berita_terbaru) : ?>
                <img src="<?= base_url('assets'); ?>/img/berita/<?= $berita_terbaru[0]['gambar']; ?>" alt="">
                <div class="judul-berita py-3 row row-cols-1 row-cols-lg-2 justify-content-between align-items-center">
                    <div class="col">
                        <h4 class="fw-bold" id="berita-terbaru" style="cursor: pointer;"><?= $berita_terbaru[0]['judul']; ?></h4>
                    </div>
                    <div class="col">
                        <div class="icon d-flex flex-column align-items-end justify-content-center">
                            <div class="created_by d-flex">
                                <span><?= $berita_terbaru[0]['nama_pembuat']; ?></span>
                                <i class="material-icons ms-2">
                                    person
                                </i>
                            </div>
                            <div class="created_at d-flex">
                                <span><?= format_tanggal($berita_terbaru[0]['created_at']); ?></span>
                                <i class="material-icons ms-2">
                                    event
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $('#berita-terbaru').on('click', function() {
                        window.location.replace('<?= base_url('lihat/postingan/berita/' . $berita_terbaru[0]['created_at']); ?>')
                    })
                </script>
                <p><?= substr($berita_terbaru[0]['content'], 0, 1000); ?>...</p>
            <?php else : ?>
                <div class="text-center">
                    <h3>Tidak Ada</h3>
                </div>
            <?php endif ?>
        </div>

        <?php if ($berita) : ?>
            <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 mx-2" id="berita-lain">
                <?php foreach ($berita as $b) : ?>
                    <div class="col">
                        <a href="<?= base_url('lihat/postingan/berita/' . $b['created_at']); ?>">
                            <div class="berita-lain card shadow my-2">
                                <img src="<?= base_url('assets'); ?>/img/berita/<?= $b['gambar']; ?>" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $b['judul']; ?></h5>
                                    <p class="card-text"><?= substr($b['content'], 0, 45); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif ?>
        <?php if ($pengurus) : ?>
            <div class="pengurus rounded my-3 position-relative" id="pengurus">
                <div class="judul-content text-center text-white mt-0 rounded">
                    <h3>DAFTAR PENGURUS</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="owl-carousel mx-2 mb-2" id="owl-carousel">
                        <?php foreach ($pengurus as $p) : ?>
                            <div class=" profile-pengurus card shadow my-2 text-center">
                                <img src="<?= base_url('assets'); ?>/img/pengurus/<?= $p['foto']; ?>" class="card-img-top foto" alt="pengurus">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $p['nama_lengkap']; ?></h5>
                                    <h6 class="card-title my-0" style="font-family:poppins;"><?= $p['posisi']; ?></h6>
                                    <div class="d-flex flex-column align-items-center my-1">
                                        <a href="https://www.instagram.com/<?= $p['instagram']; ?>/" target="_blank">
                                            <img src="<?= base_url('assets'); ?>/img/icon/instagram.png" style="width:12px !important;">
                                        </a>
                                        <a href="https://www.instagram.com/<?= $p['instagram']; ?>/" target="_blank">@<?= $p['instagram']; ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <script>
                    var owl = $('.owl-carousel');
                    if (window.matchMedia("(max-width: 576px)").matches) {
                        owl.owlCarousel({
                            items: 2,
                            loop: true,
                            margin: 10,
                            autoplay: true,
                            autoplayTimeout: 2000,
                            autoplayHoverPause: true
                        });
                    } else if (window.matchMedia("(min-width: 992px)").matches) {
                        owl.owlCarousel({
                            items: 6,
                            loop: true,
                            margin: 10,
                            autoplay: false,
                            autoplayTimeout: 2000,
                            autoplayHoverPause: true
                        });
                    } else {
                        owl.owlCarousel({
                            items: 4,
                            loop: true,
                            margin: 10,
                            autoplay: true,
                            autoplayTimeout: 2000,
                            autoplayHoverPause: true
                        });
                    }
                </script>
            </div>
        <?php endif ?>
    </div>
    <?php $this->load->view('layouts/default/side-content'); ?>
</section>