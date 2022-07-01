<!-- Main content -->
 <?php $this->load->view('tbl_kantor/tbl_kantor_sweetalert') ?>
        <section class='content'>
          <div >
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>

                  <h3 class='box-title'>KANTOR</h3>
                  <div class="pesan" style="display: none;"></div>
                      <div class='box box-primary'>
        <form <?php if ($button=='Update') {
          echo 'class="update"';
        }else{
          echo 'class="simpan"';
        } ?>  action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Kode Kantor <?php echo form_error('kd_kan') ?></td>
            <td><input type="text" class="form-control" name="kd_kan" id="kd_kan" placeholder="Kode Kantor" value="<?php echo $kd_kan; ?>" />
        </td>
	    <tr><td>Jenis LJK <?php echo form_error('id_ljk') ?></td>
            <td>
              <select class="form-control" name="id_ljk" id="id_ljk">
                <option value="<?php echo $id_ljk; ?>"><?= kode_ljk($id_ljk)?></option>
                <?php $data=$this->db->get('jenis_ljk')->result();
                      foreach ($data as $key) { ?>
                <option value="<?php echo $key->id; ?>"><?php echo $key->nama_ljk ?></option>
                <?php } ?>
              </select>
              
            </td>
	    <tr><td>Nama Kantor <?php echo form_error('n_kan') ?></td>
            <td><input type="text" class="form-control" name="n_kan" id="n_kan" placeholder="Nama Kantor" value="<?php echo $n_kan; ?>" />
        </td>
	    <input type="hidden" name="id_kan" value="<?php echo $id_kan; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-danger tombolsimpan"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_kantor') ?>" class="btn btn-secondary">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->