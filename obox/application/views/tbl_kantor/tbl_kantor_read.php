
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>Tbl_kantor Read</h3>
        <table class="table table-bordered">
	    <tr><td>Kd Kan</td><td><?php echo $kd_kan; ?></td></tr>
	    <tr><td>Kd Jenis Ljk</td><td><?php echo kode_ljk($id_ljk ) ?></td></tr>
	    <tr><td>N Kan</td><td><?php echo $n_kan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_kantor') ?>" class="btn btn-secondary">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->