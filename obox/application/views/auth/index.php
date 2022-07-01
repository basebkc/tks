<script src="<?php echo base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
   <script src="<?php echo base_url() ?>assets/sweetalert/jquery.min.js"></script>
<script>
  function hapusantrian(kode) {
      swal({
          title: "Hapus Data",
          text: "Yakin data dengan kode "+kode+" akan dihapus?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, Hapus",
          cancelButtonText: "Tidak, Batalkan",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            var nilaicsrf='<?php echo $this->security->get_csrf_hash() ?>';
            var datanya = "&kode="+kode+"&token_klinik="+nilaicsrf;
             $.ajax({
              url :"<?php echo site_url('auth/delete') ?>",
              data : datanya,
              type : 'post',
              dataType : 'json',
              cache : false,
              error:function(e){
                swal('error',e,'error');
              },
              success: function(data){
                if (data.sukses) {
                  swal({
                      title: "Hapus Data",
                      text: "data.sukses",
                      type: "success",
                      showCancelButton: false,
                      closeOnConfirm: false,
                      showLoaderOnConfirm: true,
                    },
                    function(){
                      setTimeout(function(){
                        window.location.reload();
                      }, 1000);
                    });
                }
              }
            })
          } else {
            swal("Batal", "Data batal dihapus", "error");
          }
        });
       
    }

</script>



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Users</h1>
             <div class="toolbar clearfix">
                    <div>
                      <a style="margin-right: 5px" href="#" data-target="#login-box" class="btn btn-secondary" type="submit" >Data Users</a>

                      <a href="#" data-target="#forgot-box" class="btn btn-danger" type="submit" >Tambah Data User</a>
                    </div>
              </div>
    </div>
     <div id="infoMessage"><?php echo $message;?></div>
            <div class="login-layout">
             

              <div class="space-6"></div>
                <?php if (!isset($data_users_visible)) {
                  $data_users_visible=null;
                } ?>
              <div class="position-relative">
                <div id="login-box" class="login-box <?= $data_users_visible ?>  widget-box no-border">
                  <div class="widget-body">
                    <div >
                    
                      <div class="card mb-4">
                        <table style="font-size: 14px" width="100%" class="table-bordered table-striped" id="mytable">
                          <thead>
                            <tr>
                              <td  align="center"><i>History</i></td>
                              <td>Username</td>
                              <td>NIP</td>
                              <td>Peran Pengguna</td>
                              <td>Kantor</td>
                              <td>No. Telepon</td>
                              <td align="center">Status</td>
                              <td align="center">Aksi</td>
                            </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($users as $user):?>
                              
                                <tr  <?php if($user->email=="admin@admin.com"){
                              echo"hidden";
                              } ?>>
                                  <td align="center"> <a style="margin-right: 3px;padding-left: 4px;padding-right: 4px;padding-bottom: 2px;padding-top: 2px;" class="btn btn-secondary" href="<?= site_url('antrian/histori/'.$user->id) ?>">
                                    <span>
                                <i class="fa fa-history" aria-hidden="true"></i>
                                Histori
                              </span></a>
                                </td>
                                  <td style="padding: 5px"><b><?php echo $user->first_name;?> <?php echo $user->last_name;?></b></td>
                                  <td style="padding: 5px"><?php echo $user->nip;?></td>
                                  <td style="padding: 5px"><?php echo peran_pengguna($user->id_peran_pengguna);?></td>
                                  <td style="padding: 5px"><?php echo cabang($user->company);?></td>
                                  <td style="padding: 5px"><?php echo $user->phone;?></td>
                                  <td align="center">
                                    <?php if ($user->active=="1") { ?>

                                            <?php echo form_open("auth/deactivate/".$user->id);?>
                                              <input type="hidden" name="confirm" value="yes" />
                                              <?php echo form_hidden($csrf); ?>
                                              <?php echo form_hidden(array('id'=>$user->id)); ?>
                                              <button class="btn btn-sm btn-danger" type="submit">Deactivate</button>
                                            <?php echo form_close();?>


                                    <?php }else{ ?>
                                            <a class="btn btn-sm btn-success" style="color: #fff;text-decoration: none;" href="<?php echo site_url('auth/activate/'. $user->id) ?>">Activate</a>
                                    <?php } ?>
                                  </td>
                                  <td  align="center">
                                      <div style="background-color: transparent;" class="toolbar clearfix">
                                          <a style="margin-right: 3px;padding-left: 4px;padding-right: 4px;padding-bottom: 2px;padding-top: 2px;" class="btn btn-warning" href="#" data-target="#<?= $user->id ?>">
                                          <span>
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                            Edit
                                          </span>
                                          </a>
                                        <a style="padding-left: 4px;padding-right: 4px;padding-bottom: 2px;padding-top: 2px;" class="btn btn-danger" href="#" onclick="return hapusantrian(<?= $user->id ?>);">
                                          <span>
                                          <i class="fa fa-trash" aria-hidden="true"></i>
                                          Hapus
                                          </span></a>
                                      </div>
                                  </td>
                                </tr>
                                
                            <?php endforeach;?>
                          </tbody>
                        </table>
                      </div>
                    </div><!-- /.widget-main -->                    
                  </div><!-- /.widget-body -->
                </div><!-- /.login-box -->

                <?php if (!isset($daftar_visible)) {
                  $daftar_visible=null;
                } ?>
                <div id="forgot-box" class="forgot-box <?= $daftar_visible ?> widget-box no-border">
                  <div class="widget-body">

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card ">
                                  <h4 align="center" style="padding-top: 1.5%;padding-bottom: 1.5%;background-color: #d5e3ef;margin-top: 0px;margin-bottom: 0px;" class="header blue lighter bigger">
                        <i class="ace-icon fa fa-add green"></i>
                        <b>Tambah Users / Pengguna</b>
                      </h4>

                      <div class="space-6"></div>
                            
                                    <div class="card-body">
                                       <?php echo form_open("auth/create_user");?>

                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">Nama Depan</label><input class="form-control " name="first_name" id="first_name" type="text" placeholder="Nama awal" value="<?= $this->form_validation->set_value('first_name') ?>" /></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Nama Belakang</label><input class="form-control " name="last_name" id="last_name" type="text" placeholder="Nama akhir" value="<?= $this->form_validation->set_value('last_name') ?>" /></div>
                                                </div>
                                                  <div class="col-md-6">
                                                   <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">NIP</label><input class="form-control " name="nip" id="nip" type="text" placeholder="Nomor Induk Pegawai" value="<?= $this->form_validation->set_value('nip') ?>" /></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Nomor Telepon</label><input class="form-control " name="phone" id="phone" type="text" placeholder="Nomor Hp/WhatsApp" value="<?= $this->form_validation->set_value('phone') ?>" /></div>
                                                </div>
                                                <div class="col-md-3">
                                                   <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Peran Pengguna</label>
                                              <select class="form-control  " name="peran_pengguna" id="peran_pengguna" >
                                                <option value="<?=  $this->form_validation->set_value('peran_pengguna') ?>">Pilih Peran Pengguna</option>
                                                <?php $data=$this->db->get('peran_pengguna')->result(); 
                                                foreach ($data as $k) {
                                                   echo "<option value='$k->id'>$k->nama</option>";
                                                 } ?>
                                                
                                              </select>
                                            </div>
                                                </div>
                                              <div class="col-md-3">
                                                 <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Kantor</label>
                                              <select class="form-control " name="company" id="company">
                                                <option value="<?=  $this->form_validation->set_value('company') ?>">Pilih Kantor</option>
                                                <?php $data=$this->db->get('tbl_kantor')->result(); 
                                                foreach ($data as $k) {
                                                   echo "<option value='$k->id_kan'>$k->n_kan</option>";
                                                 } ?>
                                                
                                              </select>
                                            </div>
                                              </div>
                                            </div>
                                             
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Login ID/Email</label><input class="form-control " name="email" id="email" type="text" aria-describedby="emailHelp" placeholder="Alamat email" value="<?=  $this->form_validation->set_value('email') ?>" /></div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputEmailAddress">User Level</label>
                                                      <select class="form-control " name="groups" id="groups">
                                                        <option value="<?=  $this->form_validation->set_value('groups') ?>">Pilih Level</option>
                                                        <?php $data=$this->db->get('groups')->result(); 
                                                        foreach ($data as $k) {
                                                           echo "<option value='$k->id'>$k->name</option>";
                                                         } ?>
                                                        
                                                      </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control " name="password" id="password" type="password" placeholder="Minimal 8 karakter" value="<?= $this->form_validation->set_value('password') ?>" /></div>
                                                </div>

                                                 <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Konfirmasi Pas	sword</label><input class="form-control " name="password_confirm" id="password_confirm" type="password" placeholder="Confirm password" value="<?= $this->form_validation->set_value('password_confirm') ?>" /></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mt-4 mb-0 row">
                                             <div class="col-md-6">
                                                   <div style="background-color: transparent;padding-top: 0px;padding-left: 0px;padding-bottom: 0px;padding-right: 0px;border-top-width: 0px;" class="toolbar ">
                                                          <div>
                                                            <a href="#" data-target="#login-box" class="btn btn-secondary btn-block" type="submit" >Cancel</a>
                                                          </div>
                                                    </div>          
                                              </div>
                                                 
                                             <div class="col-md-6">
                                              <button type="submit" class="btn btn-danger btn-block">Simpan</button>
                                                 </div>
                                               </div>
                                        <?php echo form_close();?>
                                    </div>
                                   <!--  <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Have an account? Go to login</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
               

                  </div><!-- /.widget-body -->
                </div><!-- /.forgot-box -->

                <?php $data=$this->db->get('users')->result();
                    foreach ($data as $key) { ?>
                    
                   
                 <div id="<?= $key->id ?>" class="forgot-box <?= $daftar_visible ?> widget-box no-border">
                  <div class="widget-body">

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card ">
                                         <h4 align="center" style="padding-top: 1.5%;padding-bottom: 1.5%;background-color: #efd5d5f5;margin-top: 0px;margin-bottom: 0px;" class="header blue lighter bigger">
                        <i class="ace-icon fa fa-add green"></i>
                        <b>Edit Users / Pengguna</b>
                      </h4>

                      <div class="space-6"></div>
                            
                                    <div class="card-body">
                                       <?php echo form_open("auth/edit_user/".$key->id);?>
<input hidden  name="id"  type="text"  value="<?= $key->id;?>" />

      <?php echo form_hidden($csrf); ?>
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">Nama Depan</label>
                                                      <input class="form-control " name="first_name" id="first_name" type="text" placeholder="Enter first name" value="<?= $key->first_name;?>" /></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Nama Belakang</label><input class="form-control " name="last_name" id="last_name" type="text" placeholder="Enter last name" value="<?= $key->last_name;?>" /></div>
                                                </div>
                                                  <div class="col-md-6">
                                                   <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">NIP</label><input class="form-control " name="nip" id="nip" type="text" placeholder="Nomor Induk Pegawai" value="<?= $key->nip;?>" /></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Nomor Telepon</label><input class="form-control " name="phone" id="phone" type="text" placeholder="Enter phone" value="<?= $key->phone;?>" /></div>
                                                </div>
                                                <div class="col-md-3">
                                                   <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Peran Pengguna</label>
                                              <select class="form-control  " name="peran_pengguna" id="peran_pengguna" >
                                                <option value="<?= $key->id_peran_pengguna;?>"><?= peran_pengguna($key->id_peran_pengguna);?></option>
                                                <?php $data=$this->db->get('peran_pengguna')->result(); 
                                                foreach ($data as $k) {
                                                   echo "<option value='$k->id'>$k->nama</option>";
                                                 } ?>
                                                
                                              </select>
                                            </div>
                                                </div>
                                              <div class="col-md-3">
                                                 <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Kantor</label>
                                              <select class="form-control " name="company" id="company">
                                                <option value="<?= $key->company;?>"><?= nama_kantor($key->company);?></option>
                                                <?php $data=$this->db->get('tbl_kantor')->result(); 
                                                foreach ($data as $k) {
                                                   echo "<option value='$k->id_kan'>$k->n_kan</option>";
                                                 } ?>
                                                
                                              </select>
                                            </div>
                                              </div>
                                            </div>
                                             
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Login ID/Email</label><input class="form-control " name="email" id="email" type="text" aria-describedby="emailHelp" placeholder="Enter email address" value="<?= $key->email;?>" /></div>
                                                </div>
                                                  <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputEmailAddress">User Level</label>
                                                        <?php $A=$this->db->get('users_groups')->result();
                                                          foreach ($A as $B) { ?>
                                                             <?php if ($B->user_id==$key->id): ?>
                                                              <?php $id_gr= $B->group_id; ?>
                                                             <?php endif ?>
                                                           <?php } ?>
                                                      <select class="form-control " name="groups[]" id="groups">
                                                        
                                                        <?php $data=$this->db->get('groups')->result(); 
                                                        foreach ($data as $k) { ?>
                                                        <option <?php if ($k->id==$id_gr){ echo"selected"; } ?> value='<?= $k->id; ?>'><?= $k->name; ?></option>
                                                        <?php } ?>
                                                        
                                                      </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control " name="password" id="password" type="password" placeholder="Enter password" value="<?= $this->form_validation->set_value('password') ?>" /></div>
                                                </div>

                                                 <div class="col-md-3">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Konfirmasi Password</label><input class="form-control " name="password_confirm" id="password_confirm" type="password" placeholder="Confirm password" value="<?= $this->form_validation->set_value('password_confirm') ?>" /></div>
                                                </div>
                                            </div>
                                            
                                                 
                                            <div class="form-group mt-4 mb-0 row">
                                              <div class="col-md-6">
                                                   <div style="background-color: transparent;padding-top: 0px;padding-left: 0px;padding-bottom: 0px;padding-right: 0px;border-top-width: 0px;" class="toolbar ">
                                                          <div>
                                                            <a href="#" data-target="#login-box" class="btn btn-secondary btn-block" type="submit" >Cancel</a>
                                                          </div>
                                                    </div>          
                                              </div>
                                              <div class="col-md-6">
                                              <button type="submit" class="btn btn-danger btn-block">Update</button>
                                              </div>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                   <!--  <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Have an account? Go to login</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
               

                  </div><!-- /.widget-body -->
                </div><!-- /.forgot-box -->

                <?php  } ?>
  </div><!-- /.position-relative -->
</div>