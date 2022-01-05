<section class="container my-3" id="content" style="position:relative;">
    <div class="main-content shadow rounded my-3" id="berita">
        <div class="judul-content mt-0 py-2 px-4 rounded">
            <h2>Baca <?= $folder; ?></h2>
        </div>
        <div class="berita px-4 py-2">
            <div class="judul-berita py-3 row row-cols-1 row-cols-lg-2 justify-content-between align-items-center">
                <div class="col">
                    <h4 class="fw-bold"><?= $data['judul']; ?></h4>
                </div>
                <div class="col">
                    <div class="icon d-flex flex-column align-items-end justify-content-center">
                        <div class="created_by d-flex">
                            <span><?= $data['nama_pembuat']; ?></span>
                            <i class="material-icons ms-2">
                                person
                            </i>
                        </div>
                        <div class="created_at d-flex">
                            <span><?= format_tanggal($data['created_at']); ?></span>
                            <i class="material-icons ms-2">
                                event
                            </i>
                        </div>
                    </div>
                </div>
            </div>
            <img src="<?= base_url('assets'); ?>/img/<?= $folder; ?>/<?= $data['gambar']; ?>" alt="">
            <p><?= $data['content']; ?></p>
            <script>
                document.querySelectorAll('oembed[url]').forEach(element => {
                    iframely.load(element, element.attributes.url.value);
                })
            </script>
        </div>
    </div>
    <?php $this->load->view('layouts/default/side-content'); ?>
</section>