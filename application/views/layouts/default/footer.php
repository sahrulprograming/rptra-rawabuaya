<style>
    div#footer-top {
        background: url('<?= base_url('assets/img/hero.jpg'); ?>') no-repeat center center;
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
    }
</style>

<div class="text-center text-white pt-4" id="footer-top">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-1 text-start mb-2">
                <img src="<?= base_url('assets'); ?>/img/logo/jaya raya.png" alt="jaya raya" height="80">
            </div>
            <div class="col-lg-4 text-start">
                <h4 class="fw-bold">RPTRA CEMPAKA RAWA BUAYA <br> JAKARTA BARAT</h4>
                <p>Jl. Klingkit I No.2 RT. 003/012, RT.3/RW.12, Rw. Buaya, Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11740</p>
                <div class="social-media d-flex">
                    <a href="https://www.instagram.com/rptracempaka/" target="_blank" class="bg-white p-2 me-3 rounded-circle" style="text-decoration: none;">
                        <i class="fab fa-instagram text-dark fs-5"></i>
                    </a>
                    <a href="#" target="_blank" class="bg-white p-2 me-3 rounded-circle" style="text-decoration: none;">
                        <i class="fab fa-facebook text-dark fs-5"></i>
                    </a>
                    <a href="#" target="_blank" class="bg-white p-2 me-3 rounded-circle" style="text-decoration: none;">
                        <i class="fab fa-youtube text-dark fs-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="text-center my-3">
    <p class="my-0" style="font-size: 13px;">rptracempaka.com - Portal Resmi RPTRA CEMPAKA RAWA BUAYA KOTA JAKARTA BARAT</p>
    <h6 class="my-0">&copyCopyright 2021 @rptracempaka</h6>
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