<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />    <title>Generate Report Obox | Bank BKC</title>
        <link rel = "icon" href ="<?php echo base_url('assets/images/login_obox.jpg') ?>" type = "image/x-icon">
       <link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet" />
        <script src="<?php echo base_url('assets/js/all.min.js') ?>" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #fff"  >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                     <div style="background-image: url(../assets/images/login_obox.jpg);" class="card-header"><h3  class="text-center font-weight-light" style="margin-bottom: 1rem !important;color: #fff;padding-top: 130px"><b>Reset Password</b></h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                        <div id="infoMessage"><?php echo $message;?></div>
                                      <?php echo form_open("auth/forgot_password");?>
                                            <div class="form-group">
                                            	<label class="small mb-1" for="inputEmailAddress">Email</label>
                                            	<input class="form-control py-4" id="identity" name="identity" type="text" aria-describedby="emailHelp" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a class="small" href="<?php echo base_url() ?>">Return to login</a>
                                            	<button class="btn btn-danger" type="submit" >Reset Password</button>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="<?= base_url() ?>">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                          <div class="text-muted">Copyright © <?= date('Y');?> | PERUMDA BPR KABUPATEN CIREBON (BANK BKC) | All right reserved Team IT BKC</div>
                             <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
  <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js') ?>" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js') ?>" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('assets/js/scripts.js') ?>"></script>
    </body>
</html>