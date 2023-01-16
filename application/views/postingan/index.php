<section class="container my-3" id="content" style="position:relative;">
    <div class="main-content shadow rounded my-3" id="berita">
        <div class="judul-content mt-0 py-2 px-4 rounded">
            <h2>Semua <?= $folder; ?></h2>
        </div>
        <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 mx-2" id="berita-lain">
            <?php foreach ($data as $d) : ?>
                <div class="col">
                    <div class="berita-lain card shadow my-2">
                        <div class="card-body p-0" id="<?= $d['created_at']; ?>">
                            <a href="<?= base_url($folder . '/' . $d['created_at']); ?>">
                                <div class="gambar position-relative text-center text-dark">
                                    <img src="<?= base_url('assets'); ?>/img/<?= $folder; ?>/<?= $d['gambar']; ?>" class="card-img-top">
                                    <div class="judul card-title position-absolute bottom-0 m-0 px-2" style="width: 100%;background: #00000080;">
                                        <h5 class="text-white"><?= substr($d['judul'], 0, 35); ?>...</h5>
                                    </div>
                                </div>
                            </a>
                            <div class="content-<?= $d['created_at'] ?> px-3 d-none">
                                <h5 class=""><?= $d['judul']; ?></h5>
                                <p class="card-text"><?= substr($d['content'], 0, 65); ?>...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $("#<?= $d['created_at']; ?>").hover(function() {
                        $('.content-<?= $d['created_at'] ?>').removeClass('d-none');
                    }, function() {
                        $('.content-<?= $d['created_at'] ?>').addClass('d-none');
                    });
                </script>
            <?php endforeach; ?>
        </div>
    </div>
    <?php $this->load->view('layouts/default/side-content'); ?>
</section>