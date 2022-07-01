<!-- Main content -->
 <?php $this->load->view('peran_pengguna/peran_pengguna_sweetalert') ?>
        <section class='content'>
          <div>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>

                  <h3 class='box-title'>PERAN PENGGUNA</h3>
                  <div class="pesan" style="display: none;"></div>
                      <div class='box box-primary'>
        <form <?php if ($button=='Update') {
          echo 'class="update"';
        }else{
          echo 'class="simpan"';
        } ?>  action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Nama <?php echo form_error('nama') ?></td>
            <td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </td>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-danger tombolsimpan"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('peran_pengguna') ?>" class="btn btn-secondary">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->