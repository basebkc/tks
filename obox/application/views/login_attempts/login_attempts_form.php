<!-- Main content -->
 <?php $this->load->view('login_attempts/login_attempts_sweetalert') ?>
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>

                  <h3 class='box-title'>LOGIN_ATTEMPTS</h3>
                  <div class="pesan" style="display: none;"></div>
                      <div class='box box-primary'>
        <form <?php if ($button=='Update') {
          echo 'class="update"';
        }else{
          echo 'class="simpan"';
        } ?>  action="<?php echo $action; ?>" method="post"><table class='table table-bordered'>
	    <tr><td>Ip Address <?php echo form_error('ip_address') ?></td>
            <td><input type="text" class="form-control" name="ip_address" id="ip_address" placeholder="Ip Address" value="<?php echo $ip_address; ?>" />
        </td>
	    <tr><td>Login <?php echo form_error('login') ?></td>
            <td><input type="text" class="form-control" name="login" id="login" placeholder="Login" value="<?php echo $login; ?>" />
        </td>
	    <tr><td>Time <?php echo form_error('time') ?></td>
            <td><input type="text" class="form-control" name="time" id="time" placeholder="Time" value="<?php echo $time; ?>" />
        </td>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary tombolsimpan"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('login_attempts') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->