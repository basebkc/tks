         <div style="margin-top: 0.5%" class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Data Search</div>
                            <div class="card-body">
         <?php
            if (empty($data)) { ?>
              <div  >
              <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
              <h1 style="margin-left: 41.5%">Data Kosong</h1>
              </div>
           <?php }
            foreach ($data as $antrian)
            {
                ?>
                  <table style="margin-top: 15px;font-size: 13px" width="100%" class="table-bordered ">
                    <tr>
                      <td style="padding-left: 8px;border-right: 0" colspan="3"><?php echo username($antrian->id_user) ?> / <?php echo peran_pengguna_user($antrian->id_user) ?></td>
                      <td style="border-left: 0;padding-right: 8px"  align="right"><?php echo nama_kantor($antrian->id_kan )?></td>
                    </tr>
                    <tr style="background-color: #e3e6f06b;">
                      <td width="25%" style="padding-left: 8px">Kode Ref.</td>
                      <td style="padding-left: 8px">No Identitas</td>
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
                      <td style="background-color: #e3e6f06b;padding-left: 8px">Tanggal Upload</td>
                      <td style="padding-left: 8px" colspan="2"><?php echo tgl_indo($antrian->tgl_upload)  ?></td>
                      
                    </tr>
                  </table>
                  
                <?php } ?>
    </div>
</div>
             
   