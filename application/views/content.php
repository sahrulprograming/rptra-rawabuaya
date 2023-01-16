<section class="container my-2" id="content" style="position:relative;">
    <style>
        .ck.ck-editor {
            width: 100%;
        }
    </style>
    <div class="main-content shadow rounded my-3 p-3 d-flex align-items-center flex-column" id="content">
        <?php if ($this->session->userdata('ID_role') == '1') : ?>
            <textarea id="editor" class="content" name="content" placeholder="masukan content"><?= isset($data) ? $data->content : ''; ?></textarea>
            <button type="button" id="simpan" class="btn btn-primary mt-3">SIMPAN</button>
        <?php else : ?>
            <div class="card" style="width:100%;">
                <div class="card-header">
                    <h4><?= ucwords($page); ?></h4>
                </div>
                <div class="card-body">
                    <?= isset($data) ? $data->content : 'Tidak ada'; ?>
                </div>
            </div>
        <?php endif ?>
    </div>
    <?php $this->load->view('layouts/default/side-content'); ?>
</section>

<!-- CKeditor5 -->
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: '<?= base_url('assets/plugin'); ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
            },
            toolbar: {
                viewportTopOffset: 60,
                items: ['ckfinder', '|', 'heading', '|',
                    'alignment', 'bold', 'italic', 'Underline', 'link', 'bulletedlist', 'numberedlist', 'blockQuote', 'outdent', 'indent', '|',
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
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    $('#simpan').on('click', function() {
        var form_data = new FormData();
        form_data.append('content', editor.getData());
        form_data.append('page', '<?= $page; ?>');
        $.ajax({
            url: '<?= base_url('admin/tambah/content'); ?>',
            type: 'POST',
            data: form_data,
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            success: function(output) {
                if (output.success) {
                    Swal.fire({
                        icon: output.icon,
                        title: output.title,
                        text: output.text,
                    })
                } else {
                    Swal.fire({
                        icon: output.icon,
                        title: output.title,
                        text: output.text,
                    })
                }
            }
        })
    })
</script>