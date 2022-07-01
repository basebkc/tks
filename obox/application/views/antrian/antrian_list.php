<?php if (!isset($daftar_visible)) {
  $daftar_visible=null;
} ?>
<?php $this->load->view('antrian/antrian_sweetalert') ?>
    <div align="right">
      <table>
        <tr>
          <td >

             <div class="input-group">
              <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..." aria-label="Search" name="search_text" id="search_text" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-danger" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </td>
          <td><p style="color: transparent;">a</p></td>
           <?php if (user_level()=="1") {
                    $dis1="";
                  }else{
                    $dis1="hidden";
                  } ?>
          <td  <?= $dis1; ?>>
               <button  class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-download fa-sm text-white-50"></i>
                      Export File
                    </button>
                    <div  class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -104px, 0px);">

                    <a class="dropdown-item" href="<?= site_url('antrian/excel') ?>"><i class="fa fa-file-excel"></i> Excel</a>
                    <a class="dropdown-item" href="<?= site_url('antrian/word') ?>"><i class="fa fa-file-word"></i>  Word</a>
                    </div>
          </td>
        </tr>
      </table>
    </div>

 <div style="margin-top: 5px;margin-bottom: 5px" class="table-header">DATA HASIL PERMINTAAN KODE REFERENSI</div>
      <div class=" toolbar clearfix">
          <div>
            <a onclick="data_ref()" href="#" data-target="#login-box" class="btn btn-danger" type="submit" >X</a>

            <a onclick="data_rek()" href="#" data-target="#forgot-box" class="btn btn-secondary" type="submit" >Filter Data</a>
            <a onclick="data_rek()" href="#" data-target="#batch-box" class="btn btn-secondary" type="submit" >Filter Batch</a>
          </div>

    </div>
<div class="login-layout">


         <div id="result"></div>
      <div style="clear:both"></div>

      <div class="position-relative">
                <div id="login-box" class="login-box visible  widget-box no-border">
                  <div class="widget-body">


                  </div><!-- /.widget-body -->
                </div><!-- /.login-box -->

                <div id="batch-box" class="batch-box <?= $daftar_visible ?>  widget-box no-border">
                  <div class="widget-body">
                    <div class="row">
                      <!-- Earnings (Monthly) Card Example -->
                      <div class="col-xl-12 col-md-6 mb-4">
                        <div class="card border-left-secondary shadow h-100 py-2">
                          <div class="card-body" style="padding-top: 0px;padding-bottom: 0px;padding-right: 0px;padding-left: 5px;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                  <form method="post" action="<?= site_url('antrian/rekap_batch') ?>">
                                    <div class="form-row">
                                  <div class="col-md-3">
                                   <div class="form-group">
                                     <label class="small mb-1" for="inputConfirmPassword">Berdasarkan Kantor</label>
                                    <select class="form-control " name="id_group" id="id_group">
                                      <option value="">"Pilih File"</option>

                                      <?php
                                            if (user_level() != "1") {
                                              $this->db->where('id_kan',get_id_kan($this->session->userdata('user_id')));
                                            }
                                            $this->db->where_not_in('id_group',0);
                                            $this->db->group_by('id_group');
                                      $data=$this->db->get('antrian')->result();
                                      foreach ($data as $k) {
                                         echo "<option value='$k->id_group'>$k->id_group</option>";
                                       } ?>
                                       <!--<option value="">Semua Kantor</option>-->
                                    </select>
                                   </div>
                                  </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                      <label class="small mb-1" for="inputConfirmPassword"></label><br>
                                      <button style="margin-top:7px" class="btn btn-danger btn-sm" type="submit">Cek Data</button>
                                    </div>
                                </div>
                                </div>
                                  </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div><!-- /.widget-body -->
                </div><!-- /.login-box -->


                <div id="forgot-box" class="forgot-box <?= $daftar_visible ?> widget-box no-border">
                  <div class="widget-body">
                    <div id="hidd3">
                        <div class="row">
                          <!-- Earnings (Monthly) Card Example -->
                          <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                              <div class="card-body" style="padding-top: 0px;padding-bottom: 0px;padding-right: 0px;padding-left: 5px;">
                                <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                      <form method="post" action="<?= site_url('antrian/rekap_data') ?>">
                                    <div class="form-row">
                                      <div class="col-md-3">
                                          <div class="form-group"><label class="small mb-1" for="inputFirstName">Dari Tanggal</label>
                                            <div class="dates">
                                            <input required type="text" name="tgl_awal" autocomplete="off" id="tgl_awal" class="form-control" placeholder="yyyy-mm-dd"   onchange="rekap();" value="<?= empty($tgl_awal)?null:$tgl_awal; ?>">

                                          </div>
                                          </div>
                                      </div>
                                      <div class="col-md-3 ">
                                          <div class="form-group"><label class="small mb-1" for="inputLastName">Sampai Tanggal</label>
                                          <div class="dates">
                                            <div class="dates">
                                            <input required type="text" name="tgl_akhir" autocomplete="off" id="tgl_akhir" class="form-control" placeholder="yyyy-mm-dd"   onchange="rekap();" value="<?= empty($tgl_akhir)?null:$tgl_akhir; ?>">
                                            </div>
                                              </div>
                                          </div>
                                      </div>
                                      <?php if (user_level()=="1") {
                                        $dis="";
                                      }else{
                                        $dis="disabled  required";
                                      } ?>
                                      <div class="col-md-3">
                                       <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Berdasarkan Kantor</label>
                                        <select <?= $dis; ?> onchange="rekap();" class="form-control " name="company" id="company">
                                          <option value="<?= empty($company)?null:$company; ?>"><?= empty($company)?"Pilih Kantor":$company_nama; ?></option>
                                          <?php $data=$this->db->get('tbl_kantor')->result();
                                          foreach ($data as $k) {
                                             echo "<option value='$k->id_kan'>$k->n_kan</option>";
                                           } ?>
                                           <!--<option value="">Semua Kantor</option>-->
                                        </select>
                                       </div>
                                      </div>

                                      <div class="col-md-3">
                                       <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Berdasarkan Users</label>
                                        <select <?= $dis; ?> onchange="rekap();" class="form-control " name="users" id="users">
                                          <option value="<?= empty($users)?null:$users; ?>"><?= empty($users)?"Pilih Users":$users_nama; ?></option>
                                          <?php $data=$this->db->get('users')->result();
                                          foreach ($data as $k) {
                                            if ($k->id=='1') {
                                              # code...
                                            }else{
                                             echo "<option value='$k->id'>".username($k->id)."</option>";
                                            }
                                           } ?>
                                           <!--<option value="">Semua User</option>-->

                                        </select>
                                       </div>
                                      </div>
                                    &nbsp;&nbsp;
                                    <?php if (!isset($cetak)) {
                                      $cetak=null;
                                    }else{
                                      echo $cetak;
                                    } ?>
                                    <button class="btn btn-danger btn-sm" type="submit">Cek Data</button>

                                    </div>
                                     </form>
                                    <div id="btn_export">

                                     </div>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div id="rekap"></div>
                    <div style="clear:both"></div>

                  </div><!-- /.widget-body -->
                </div><!-- /.forgot-box -->


  </div><!-- /.position-relative -->
      <div style="margin-top: 0.5%" class="card mb-4">
       <?php if (!isset($tot)){
          $tot=null;
       }else{ ?>
          <h1>Total Data <?= $tot ?></h1>
      <?php } ?>
        <div style="padding-left: 10px;padding-right: 10px" id="hidd">

            <?php
            if (empty($antrian_data)) { ?>
              <div  >
              <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
              <h1 style="margin-left: 41.5%">Data Kosong</h1>
              </div>
           <?php }
            foreach ($antrian_data as $antrian)
            {
                ?>
                  <table style="margin-top: 15px;font-size: 13px" width="100%" class="table-bordered ">
                    <tr>
                      <td style="padding-left: 8px;border-right: 0" colspan="3"><?php echo username($antrian->id_user) ?> / <?php echo peran_pengguna_user($antrian->id_user) ?></td>
                      <td style="border-left: 0;padding-right: 8px"  align="right"><?php echo nama_kantor($antrian->id_kan )?></td>
                    </tr>
                    <tr style="background-color: #e3e6f06b;">
                      <td width="25%" style="padding-left: 8px">Kode Ref.</td>
                      <td style="padding-left: 8px">No. Identitas</td>
                      <td style="padding-left: 8px">Nama Lengkap  </td>
                      <td style="padding-left: 8px">Tempat Lahir</td>
                    </tr>
                    <tr>
                      <td style="padding-left: 8px;padding-top: 5px;padding-bottom: 5px"><b><?= $antrian->no_antrian; ?></b></td>
                      <td style="padding-left: 8px;padding-top: 5px;padding-bottom: 5px"><?php echo $antrian->no_ktp; ?></td>
                      <td style="padding-left: 8px;padding-top: 5px;padding-bottom: 5px"><?php echo $antrian->nama ?></td>
                      <td style="padding-left: 8px;padding-top: 5px;padding-bottom: 5px"><?php echo $antrian->tempat_lahir ?></td>
                    </tr>
                    <tr>
                      <td style="background-color: #e3e6f06b;padding-left: 8px">Tanggal Lahir</td>
                      <td style="padding-left: 8px" colspan="2"><?php echo tgl_indo($antrian->tgl_lahir) ?></td>
                      <td rowspan="2" width="25%" style="background-color: #e3e6f06b" align="center">
                          <div style="padding: 5px" class="hidden-sm hidden-xs action-buttons">
                              <?php if ($antrian->file=="https://drive.google.com/file/d//view"){ ?>

                              <?php }else{ ?>


                             <a style="padding-top: 0px;padding-bottom: 0px;padding-right: 15px;padding-left: 15px;" target="_blank" href="<?= $antrian->file ?>" class="btn btn-warning  btn-sm" title="Lihat" >
                                <i class="fas fa-download"></i></a>
                          <?php } ?>

                             <a style="padding-top: 0px;padding-bottom: 0px;padding-right: 15px;padding-left: 15px;" href="<?= site_url('antrian/read/'.$antrian->id_antrian); ?>" class="btn btn-info  btn-sm" title="Lihat" >
                                <i class="fas fa-search-plus"></i></a>
                             <a style="padding-top: 0px;padding-bottom: 0px;padding-right: 15px;padding-left: 15px;" href="<?= site_url('antrian/update/'.$antrian->id_antrian); ?>" class="btn btn-success  btn-sm" title="Edit" >
                                <i class="fas fa-edit"></i></a>

                             <a style="padding-top: 0px;padding-bottom: 0px;padding-right: 15px;padding-left: 15px;" href="#" class="btn btn-danger  btn-sm" title="Hapus" onclick="return hapusantrian(<?= $antrian->id_antrian ?>);">
                                <i class="fas fa-trash"></i></a>
                            </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="background-color: #e3e6f06b;padding-left: 8px">Tanggal Permintaan</td>
                      <td style="padding-left: 8px" colspan="2"><?php echo tgl_indo($antrian->tgl_upload)  ?></td>

                    </tr>
                  </table>

                <?php } ?>

        <div style="margin: 10px" id="hidd2">
            <?php  echo $pagination; ?>
        </div>
    </div>
</div>


</div>



<script>
$(document).ready(function(){

  function load_data(query)
  {
    document.getElementById('hidd').style.display='none';
    document.getElementById('hidd3').style.display='none';

    $.ajax({
      url:"<?php echo site_url('antrian/search'); ?>",
      method:"POST",
      data:{query:query},
      success:function(data){
        $('#result').html(data);

      }
    })
  }

  $('#search_text').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
      load_data(search);
      document.getElementById('result').style.display='block';
    }else{
      document.getElementById('hidd').style.display='block';
      document.getElementById('hidd3').style.display='block';
      document.getElementById('result').style.display='none';
    }
  });
});
  function data_ref(){
     document.getElementById('hidd').style.display='block';
     document.getElementById('rekap').style.display='none';
     document.getElementById('tgl_awal').value="";
     document.getElementById('tgl_akhir').value="";
     document.getElementById('company').value="";
  }
    function data_rek(){
     document.getElementById('tgl_awal').value="";
     document.getElementById('tgl_akhir').value="";
     document.getElementById('company').value="";
  }


</script>
