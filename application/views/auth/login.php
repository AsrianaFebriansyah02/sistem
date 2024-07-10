<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Minton - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/'); ?>images\logo.png">
    <!-- App css -->
    <link href="<?php echo base_url('public/assets/'); ?>css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/'); ?>css\icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/'); ?>css\app.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <a href="index.html">
                                    <span><img src="<?php echo base_url('public/assets/'); ?>images\logo.png" alt="" height="60"></span>
                                </a>
                                <h4 class="text-muted mb-4 mt-3">Yayasan Miftahul Ihsan</h4>
                            </div>
                            <?php if ($this->session->flashdata('alert')) : ?>
                                <!-- Menampilkan pemberitahuan -->
                                <div id="alert">
                                    <?php echo $this->session->flashdata('alert'); ?>
                                </div>
                                <!-- Script untuk menghapus pemberitahuan setelah beberapa detik -->
                                <script>
                                    setTimeout(function() {
                                        document.getElementById("alert").remove();
                                    }, <?php echo $this->session->flashdata('alert_timeout'); ?>);
                                </script>
                            <?php endif; ?>

                            <form action="<?php echo base_url('Auth/proses_login') ?>" method="POST">
                                <?php echo form_error('username') ?>
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input class="form-control" type="text" id="username" name="username" required="" placeholder="Enter your username">
                                </div>
                                <?php echo form_error('password') ?>
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                </div>

                            </form>



                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <footer class="footer footer-alt">
        2024-2025 &copy; Pencatatan by <a href="" class="text-muted">Asriana Febriansyah</a>
    </footer>
    <!-- Vendor js -->
    <script src="<?php echo base_url('public/auth/'); ?>js\vendor.min.js"></script>
    <!-- App js -->
    <script src="<?php echo base_url('public/auth/'); ?>js\app.min.js"></script>

</body>

</html>