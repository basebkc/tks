<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Generate Report OBOX | BANK BKC</title>
        <link rel = "icon" href ="<?php echo base_url('assets/images/icons/favicon.png') ?>" type = "image/x-icon"> 

        <link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet" />
        <script src="<?php echo base_url('assets/js/all.min.js') ?>" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #ffe1e1;" >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div style="background-image: url(../assets/images/login_obox.jpg);" class="card-header"><h3  class="text-center font-weight-light" style="margin-bottom: 1rem !important;color: #fff;padding-top: 130px"><b>USER LOGIN</b></h3></div>
                                    <div style="margin-top: 10px" align="center" id="infoMessage"><b><?php echo $message;?></b></div>
                                    <div class="card-body">
                                        <?php echo form_open("auth/login");?>
                                        <table width="100%">
                                            <tr>
                                                <td>Email</td>
                                                <td colspan="2">
                                                    <input style="border-top: 0px;border-left: 0px;border-right: 0px" class="form-control py-4" id="identity" type="text" name="identity" placeholder="Enter email address" value="<?php $this->form_validation->set_value('identity') ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><p style="color: transparent;font-size: 1px">a</p></td>
                                            </tr>
                                            <tr>
                                                <td>Password</td>
                                                <td colspan="2">
                                                     <input style="border-top: 0px;border-left: 0px;border-right: 0px" class="form-control py-4" id="password" type="password" name="password" placeholder="Enter password" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"></td>
                                                <td> 
                                                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                                                  <label >Remember password</label>
                                              </td>
                                              <td style="text-align: right;">
                                                  <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
                                              </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"></td>
                                                <td> <button style="background-color: #9e1e21;color: #fff;padding-left: 40px;padding-right: 40px" class="btn" type="submit">Login</button></td>
                                            </tr>
                                        </table>
                                          
                                       <?php echo form_close();?>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="<?= base_url() ?>"></a></div>
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
                           <div class="text-muted">Copyright © <?= date('Y');?> PERUMDA BPR KABUPATEN CIREBON (BANK BKC) | All right reserved Team IT BKC</div>
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