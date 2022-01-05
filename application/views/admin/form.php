<?= $this->session->flashdata('notif'); ?>
<div class="card">
    <div class="card-body">
        <form action="<?= current_url(); ?>" method="POST" enctype="multipart/form-data">
            <?php $ke = 0;
            $o = 0;
            foreach ($label as $field) : ?>
                <?php if ($input[$ke] == 'normal') : ?>
                    <?php if ($type[$ke] == 'text' || $type[$ke] == 'email') : ?>
                        <div class="input-group input-group-static mb-4">
                            <label><?= $field; ?></label>
                            <input type="<?= $type[$ke]; ?>" name="<?= $name[$ke]; ?>" class="form-control" value="<?= isset($value) ? $value[$name[$ke]] : set_value($name[$ke]); ?>">
                            <?= form_error($name[$ke], '<small class="text-danger">', '</small>'); ?>
                        </div>
                    <?php elseif ($type[$ke] == 'file') : ?>
                        <?php if (isset($value) && $value[$name[$ke]]) : ?>
                            <div class="text-center">
                                <img src="<?= base_url('assets'); ?>/img/<?= $folder; ?>/<?= $value[$name[$ke]]; ?>" style="width:220px;">
                            </div>
                        <?php endif; ?>
                        <div class="mb-4">
                            <label class="form-label"><?= $field; ?></label>
                            <input type="<?= $type[$ke]; ?>" name="<?= $name[$ke]; ?>" class="form-control" id="formFile" accept="image/png, image/jpg, image/jpeg">
                        </div>
                    <?php endif ?>
                <?php elseif ($input[$ke] == 'textarea') : ?>
                    <div class="mb-3">
                        <textarea name="<?= $name[$ke]; ?>" id="editor" placeholder="Masukan content berita di sini"><?= isset($value) ? $value[$name[$ke]] : set_value($name[$ke]); ?></textarea>
                        <?= form_error($name[$ke], '<small class="text-danger">', '</small>'); ?>
                    </div>
                <?php elseif ($input[$ke] == 'option') : ?>
                    <div class="input-group input-group-static mb-4">
                        <label for="<?= $name[$ke]; ?>" class="ms-0"><?= $field; ?></label>
                        <select class="form-control" id="<?= $name[$ke]; ?>" name="<?= $name[$ke]; ?>">
                            <?php if ($tb_option[$o] != null) : ?>
                                <option value="<?= isset($value) ? $value[$name[$ke]] : set_value($name[$ke]); ?>"><?= isset($value) ? $this->CRUD->getTableByID($tb_option[$o], [$valueText[$o][0] => $value[$name[$ke]]], $valueText[$o][1]) : (set_value($name[$ke]) ? set_value($name[$ke]) : 'pilih'); ?></option>
                            <?php else : ?>
                                <option value="<?= isset($value) ? $value[$name[$ke]] : set_value($name[$ke]); ?>"><?= isset($value) ? $value[$name[$ke]] : (set_value($name[$ke]) ? set_value($name[$ke]) : 'pilih'); ?></option>
                            <?php endif ?>
                            <?php foreach ($options[$o] as $option) : ?>
                                <option value="<?= $option[$valueText[$o][0]]; ?>"><?= $option[$valueText[$o][1]]; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error($name[$ke], '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <?php $o++; ?>
                <?php endif ?>
            <?php $ke++;
            endforeach;  ?>
            <div class="text-center">
                <button type="submit" class="btn btn-primary"><?= $button; ?></button>
            </div>
        </form>
    </div>
</div>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '<?= base_url('assets/plugin'); ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
            },
            toolbar: {
                items: ['ckfinder', '|', 'heading', '|',
                    'bold', 'italic', 'Underline', 'link', 'bulletedlist', 'numberedlist', 'blockQuote', 'outdent', 'indent', '|',
                    'insertTable', 'mediaEmbed', '|', 'undo', 'redo'
                ]
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    },
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>