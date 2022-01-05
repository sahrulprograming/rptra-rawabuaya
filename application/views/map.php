<?= $this->session->flashdata('notif'); ?>
<div class="text-center">
    <h3>Lokasi</h3>
</div>

<div class="card border-secondary">
    <div class="card-body">
        <style>
            iframe {
                width: 100%;
                height: 50vh !important;
            }
        </style>
        <div class="text-center">
            <a href="https://maps.google.com/maps?q=<?= $lat; ?>,<?= $lng; ?>&hl=es;z=14&amp" class="btn btn-primary" target="_blank">
                Lihat dengan g-maps
            </a>
        </div>
        <iframe frameborder="0" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?= $lat; ?>,<?= $lng; ?>&hl=es;z=14&amp;output=embed">
        </iframe>
        <br />
    </div>
</div>