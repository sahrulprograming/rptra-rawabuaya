<link href='<?= base_url('assets'); ?>/css/calender/AdminLTE.min.css' rel='stylesheet' />
<?= $this->session->flashdata('notif'); ?>
<div class="row mt-3">
    <div class="col px-4">
        <div class="box box-success">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <label class="color-scheme-text">KETERANGAN WARNA:</label><br>
                        <div class="colors-div d-flex justify-content-center">
                            <div class="text-center mx-3">
                                <label class="color-text">LIBUR</label><br>
                                <input type="text" class="form-control" style="background:#FF0000;" required readonly>
                            </div>
                            <div class="text-center mx-3">
                                <label class="color-text">LAIN LAIN:</label><br>
                                <input type="text" class="form-control" style="background:#0071c5;" required readonly>
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-hover" style="margin-right:-10px">
                            <style>
                                .fc-day-grid-event .fc-content {
                                    white-space: pre-wrap !important;
                                }
                            </style>
                            <div id="calendar"></div>
                        </table>
                    </div>
                    <!--col end -->
                </div>
                <!--row end-->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col (right) -->

    <!-- /.row -->
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="form-horizontal" method="POST" action="<?= set_url('tambah'); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-static mb-3">
                            <label for="title">Title:</label>
                            <textarea rows="4" cols="10" id="title" class="form-control" placeholder="masukan keterangan" name="title" maxlength="300" value="" required></textarea>
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label for="color">Type</label>
                            <select class="form-control" id="color" name="color">
                                <option value="<?= set_value('color'); ?>"><?= set_value('color') == '#FF0000' ? 'LIBUR' : (set_value('color') ? 'LAIN - LAIN' : 'Pilih Type'); ?></option>
                                <option style="color:#FF0000;" value="#FF0000">&#9724; LIBUR</option>
                                <option style="color:#0071c5;" value="#0071c5">&#9724; LAIN - LAIN</option>
                            </select>
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label for="start">Date and Time</label>
                            <input type="text" name="start" class="form-control" id="start">
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label for="end">End date</label>
                            <input type="text" name="end" class="form-control" id="end">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="form-horizontal" method="POST" action="<?= set_url('rubah'); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group input-group-static mb-3">
                            <label for="title">Title:</label>
                            <textarea rows="4" cols="10" id="title" class="form-control" placeholder="masukan keterangan" name="title" maxlength="300" value="" required></textarea>
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label for="color">Type</label>
                            <select class="form-control" id="color" name="color">
                                <option value="<?= set_value('color'); ?>"><?= set_value('color') == '#FF0000' ? 'LIBUR' : (set_value('color') ? 'LAIN - LAIN' : 'Pilih Type'); ?></option>
                                <option style="color:#FF0000;" value="#FF0000">&#9724; LIBUR</option>
                                <option style="color:#0071c5;" value="#0071c5">&#9724; LAIN - LAIN</option>
                            </select>
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label for="start">Date and Time</label>
                            <input type="text" name="start" class="form-control" id="start">
                        </div>
                        <div class="input-group input-group-static mb-3">
                            <label for="end">End date</label>
                            <input type="text" name="end" class="form-control" id="end">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label class="text-danger"><input type="checkbox" name="delete"> Delete event</label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id" class="form-control" id="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src='<?= base_url('assets'); ?>/js/calender/moment.min.js'></script>
<script src='<?= base_url('assets'); ?>/js/calender/fullcalendarxx.min.js'></script>
<script src='<?= base_url('assets'); ?>/js/calender/sweetalert.min.js'></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'today,month,listWeek,listMonth',
            },
            views: {
                listDay: {
                    buttonText: 'List day'
                },
                listWeek: {
                    buttonText: 'List week'
                },
                listMonth: {
                    buttonText: 'List month'
                },
                month: {
                    buttonText: 'Month'
                },
                today: {
                    buttonText: 'Today'
                },
                agendaWeek: {
                    buttonText: 'Week'
                },
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            timeFormat: "HH:mm",
            defaultView: 'month',
            scrollTime: '08:00', // undo default 6am scrollTime
            eventOverlap: false,
            allDaySlot: false,
            select: function(start, end) {
                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },
            eventRender: function(event, element) {
                element.bind('dblclick', function() { //gawin mong CLICK yung parameter para maging single
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit #start').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalEdit #end').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalEdit').modal('show');
                });
            },
            eventMouseover: function(Event, jsEvent) {
                var tooltip = '<div class="tooltip" >' + '<b>WHAT :</b>&nbsp;' + Event.title + '<br><b>DURATION :</b>&nbsp;' + (moment(Event.start).format('HH:mma')) + '&nbsp;-&nbsp;' + (moment(Event.end).format('HH:mma')) + '</div>';
                var $tooltip = $(tooltip).appendTo('body');

                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $tooltip.fadeIn('500');
                    $tooltip.fadeTo('10', 1.9);
                }).mousemove(function(e) {
                    $tooltip.css('top', e.pageY + 10);
                    $tooltip.css('left', e.pageX + 20);
                });
            },

            eventMouseout: function(Event, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltip').remove();
            },

            events: [
                <?php foreach ($events as $event) : ?> {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $event['start']; ?>',
                        end: '<?php echo $event['end']; ?>',
                        color: '<?php echo $event['color']; ?>',
                    },
                <?php endforeach; ?>
            ]
        });
    });
</script>