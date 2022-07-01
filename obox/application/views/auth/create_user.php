
      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>IDEB</title>
         <link href="<?php echo base_url('assets/css/styles.css') ?>" rel="stylesheet" />
        <script src="<?php echo base_url('assets/js/all.min.js') ?>" crossorigin="anonymous"></script>
     </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div id="infoMessage"><?php echo $message;?></div>
                                    <div class="card-body">
                                       <?php echo form_open("auth/create_user");?>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label><input class="form-control py-4" name="first_name" id="first_name" type="text" placeholder="Enter first name" value="<?= $this->form_validation->set_value('first_name') ?>" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label><input class="form-control py-4" name="last_name" id="last_name" type="text" placeholder="Enter last name" value="<?= $this->form_validation->set_value('last_name') ?>" /></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Nomor Telepon</label><input class="form-control py-4" name="phone" id="phone" type="text" placeholder="Enter phone" value="<?= $this->form_validation->set_value('phone') ?>" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">NIP</label><input class="form-control py-4" name="nip" id="nip" type="text" placeholder="Nomor Induk Pegawai" value="<?= $this->form_validation->set_value('nip') ?>" /></div>
                                                </div>
                                            </div>
                                             <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Peran Pengguna</label>
                                              <select class="form-control " name="peran_pengguna" id="peran_pengguna">
                                                <option value="<?=  $this->form_validation->set_value('peran_pengguna') ?>">Pilih Peran Pengguna</option>
                                                <?php $data=$this->db->get('peran_pengguna')->result(); 
                                                foreach ($data as $k) {
                                                   echo "<option value='$k->id'>$k->nama</option>";
                                                 } ?>
                                                
                                              </select>
                                            </div>

                                             <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Kantor</label>
                                              <select class="form-control " name="company" id="company">
                                                <option value="<?=  $this->form_validation->set_value('company') ?>">Pilih Kantor</option>
                                                <?php $data=$this->db->get('tbl_kantor')->result(); 
                                                foreach ($data as $k) {
                                                   echo "<option value='$k->id_kan'>$k->n_kan</option>";
                                                 } ?>
                                                
                                              </select>
                                            </div>

                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Login ID/Email</label><input class="form-control py-4" name="email" id="email" type="text" aria-describedby="emailHelp" placeholder="Enter email address" value="<?=  $this->form_validation->set_value('email') ?>" /></div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" name="password" id="password" type="password" placeholder="Enter password" value="<?= $this->form_validation->set_value('password') ?>" /></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" name="password_confirm" id="password_confirm" type="password" placeholder="Confirm password" value="<?= $this->form_validation->set_value('password_confirm') ?>" /></div>
                                                </div>
                                            </div>
                                                 
                                            <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block">Create Account</button></div>
                                        <?php echo form_close();?>
                                    </div>
                                   <!--  <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Have an account? Go to login</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
          <!--   <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div> -->
        </div>
           <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js') ?>" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js') ?>" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('assets/js/scripts.js') ?>"></script>
    </body>
</html>
