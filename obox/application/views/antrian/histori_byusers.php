<?php $this->load->view('antrian/antrian_sweetalert') ?>
    	<?php 
      $this->db->where(array('id' => $id_user ));
      $user=$this->db->get('users')->row();
       ?>
    
      <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Detail Users</div>
                      <div class=" mb-0 font-weight text-gray-800">
                          <p style="color: #858796">
                           Nama &nbsp;&nbsp;&nbsp;: <?= $user->first_name; ?> <?= $user->last_name; ?> <br>
                           Kantor &nbsp; : <?= cabang($user->company); ?> <br>
                           Email &nbsp;&nbsp;&nbsp; : <?= $user->email; ?><br>
                           Peran &nbsp;&nbsp; : <?= peran_pengguna($user->id_peran_pengguna); ?>
                           </p>
                      </div>
                    </div>
                    <div class="col-auto">
					  <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <div class="col-xl-6 col-md-6 mb-4">
              <div >
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div align="center" class="col mr-2">
					  <div align="left">
                      <img  width="75%" src="<?= base_url('assets/images/ideb2.png') ?>">
					  </div>
                       <div class="input-group">
                        <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..." aria-label="Search" name="search_text" id="search_text" aria-describedby="basic-addon2">
                        <input type="hidden" name="id_users" id="id_users" value="<?php echo $id_user ?>">
                        <div class="input-group-append">
                          <button class="btn btn-danger" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>

<div style="margin-top: 0.5%" class="card mb-4">
      <div id="result"></div>
      <div style="clear:both"></div>
<div style="padding-left: 10px;padding-right: 10px"  id="hidd" >
            <?php
            if (empty($antrian_data)) { ?>
              <div  >
              <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
              <h1 style="margin-left: 41.5%">Data Kosong</h1>
              </div>
           <?php }
            foreach ($antrian_data as $antrian) { ?>
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
        <script>
$(document).ready(function(){

  function load_data(query)
  {
    document.getElementById('hidd').style.visibility='hidden';  
    var where = document.getElementById("id_users").value;
    $.ajax({
      url:"<?php echo base_url(); ?>index.php/antrian/search/"+where,
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
      document.getElementById('hidd').style.visibility='visible';
      document.getElementById('result').style.display='none';
    }
  });
});
</script>