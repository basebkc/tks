<!-- Main content -->
 <?php $this->load->view('jenis_ljk/jenis_ljk_sweetalert') ?>
        <section class='content'>
          <div>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>

                  <h3 class='box-title'>JENIS LJK</h3>
                  <div class="pesan" style="display: none;"></div>
                      <div class='box box-primary'>
        <form <?php if ($button=='Update') {
          echo 'class="update"';
        }else{
          echo 'class="simpan"';
        } ?>  action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Kode LJK <?php echo form_error('kode') ?></td>
            <td><input type="text" class="form-control" name="kode" id="kode" placeholder="Kode LJK" value="<?php echo $kode; ?>" />
        </td>
	    <tr><td>Nama LJK <?php echo form_error('nama_ljk') ?></td>
            <td><input type="text" class="form-control" name="nama_ljk" id="nama_ljk" placeholder="Nama LJK" value="<?php echo $nama_ljk; ?>" />
        </td>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-danger tombolsimpan"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jenis_ljk') ?>" class="btn btn-secondary">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->