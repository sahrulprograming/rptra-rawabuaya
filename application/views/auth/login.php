<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0 text-uppercase">LOGIN RPTRA</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('notif'); ?>
                            <form role="form" class="text-start" action="<?= current_url(); ?>" method="post">
                                <div class="input-group input-group-static my-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="input-group input-group-static mb-3">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="-login" class="btn bg-gradient-primary w-100 my-4 mb-2">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $('#btn-login').on('click', function() {
        let email = $('#email').val();
        let password = $('#password').val();
        if (password && email) {
            $.ajax({
                url: '<?= base_url('auth/loginAct') ?>',
                data: {
                    email: email,
                    password: password,
                },
                type: 'post',
                async: true,
                dataType: 'JSON',
                success: function(output) {
                    console.log(output);
                }
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Email dan password wajib di isi!',
            })
        }
    })
</script>