<style>
    div#footer-top {
        background: #536353;
        background-size: cover;
    }
</style>
<?php $rptra = $this->db->get('rptra')->result_array(); ?>
<div class="text-center text-white pt-4" id="footer-top">
    <div class="container py-4">
        <div class="row">
            <?php foreach ($rptra as $r) : ?>
                <div class="col">
                    <div class="cabang-rptra">
                        <img src="<?= base_url('assets'); ?>/img/logo/<?= $r['logo']; ?>" style="width: 150px; width:150px;">
                        <p class="my-0 fw-bold"><?= $r['nama']; ?></p>
                        <p class="my-0"><?= $r['alamat']; ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<footer class="text-center my-3">
    <p class="my-0" style="font-size: 13px;">rptrarawabuaya.com - Portal Resmi RPTRA RAWA BUAYA KOTA JAKARTA BARAT</p>
    <h6 class="my-0">&copyCopyright <?= date('Y'); ?></h6>
</footer>
</main>
<!-- Bootsrap 5 -->
<script src="<?= base_url('assets'); ?>/plugin/bootstrap5/js/bootstrap.min.js"></script>

<script>
    window.onscroll = function() {
        myFunction()
    };
    var navbar = document.getElementById("nav-desktop");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("fixed-top")
        } else {
            navbar.classList.remove("fixed-top");
        }
    }
</script>
</body>

</html>