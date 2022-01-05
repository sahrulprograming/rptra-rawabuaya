<?php $events = $this->db->get('events_calender')->result_array(); ?>

<div class="side-content mt-3 ps-4 shadow justify-content-center" id="">
    <div class="px-2 text-center">
        <h4 class="text-uppercase text-bold fw-bold my-3">follow <span class="text-instagram">instagram</span></h4>
        <div class="row row-cols-2">
            <div class="col mb-3">
                <img src="<?= base_url('assets'); ?>/img/logo/DPPAP.jpg" alt="dppap" width="50" class="rounded-circle border border-success">
                <div class="instagram">
                    <a href="https://www.instagram.com/dppappdki/" class="link-instagram" target="_blank">@dppappdki</a>
                </div>
            </div>
            <div class="col mb-3">
                <img src="<?= base_url('assets'); ?>/img/logo/PKK Jakarta.jpg" alt="dppap" width="50" class="rounded-circle border border-success">
                <div class="instagram">
                    <a href="https://www.instagram.com/pkkjakarta/" class="link-instagram" target="_blank">@pkkjakarta</a>
                </div>
            </div>
            <div class="col mb-3">
                <img src="<?= base_url('assets'); ?>/img/logo/ppapp.jakbar.jpg" alt="dppap" width="50" class="rounded-circle border border-success">
                <div class="instagram">
                    <a href="https://www.instagram.com/ppapp.jakbar/" class="link-instagram" target="_blank">@ppapp.jakbar</a>
                </div>
            </div>
            <div class="col mb-3">
                <img src="<?= base_url('assets'); ?>/img/logo/PKK Jakbar.jpg" alt="dppap" width="50" class="rounded-circle border border-success">
                <div class="instagram">
                    <a href="https://www.instagram.com/pkkjakbar/" class="link-instagram" target="_blank">@pkkjakbar</a>
                </div>
            </div>
        </div>
    </div>
    <div id="calendar" class=" mt-3"></div>
    <div class="populer pe-4">
        <h5>berita poppuler</h5>
        <ul>
            <li><a href="">Berita 1</a></li>
            <li><a href="">Berita 2</a></li>
            <li><a href="">Berita 3</a></li>
        </ul>
    </div>
</div>
<script>
    let today = new Date();
    console.log();
    // initialize your calendar, once the page's DOM is ready
    $(document).ready(function() {
        $('#calendar').evoCalendar({
            todayHighlight: true,
            sidebarDisplayDefault: false,
            // eventDisplayDefault: false,
            sidebarToggler: false,
            // eventListToggler: false,
            calendarEvents: [{
                    id: 'newyear1', // Event's ID (required)
                    name: "Tahun Baru", // Event name (required)
                    date: "January/1/2020", // Event date (required)
                    type: "holiday", // Event type (required)
                    everyYear: true, // Same event every year (optional)
                    color: "#FF0000" // Event custom color (optional)
                },
                <?php $events = $this->db->get('events_calender')->result_array(); ?>
                <?php foreach ($events as $event) :
                ?> {
                        id: '<?php echo $event['id']; ?>',
                        name: '<?php echo $event['title']; ?>',
                        date: ['<?= $event['start']; ?>', '<?= $event['end']; ?>'],
                        type: 'holiday',
                        color: '<?php echo $event['color']; ?>',
                    },
                <?php endforeach; ?>
            ]
        })
    })
</script>