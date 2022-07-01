
        <!-- Main content -->
        <?php $this->load->view('login_attempts/login_attempts_sweetalert') ?>
        <section class='content'>
          <div>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>LOGIN_ATTEMPTS LIST </h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
                <div class="table-header">
                  LOGIN_ATTEMPTS LIST
                </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Ip Address</th>
		    <th>Login</th>
		    <th>Time</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($login_attempts_data as $login_attempts)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $login_attempts->ip_address ?></td>
		    <td><?php echo $login_attempts->login ?></td>
		    <td><?php echo $login_attempts->time ?></td>
		    <td style="text-align:center" width="140px"> <div class="hidden-sm hidden-xs action-buttons">
			<?php 
			
			echo '<a class="red" title="delete" onclick="return hapuslogin_attempts('.$login_attempts->id.');"><i class="ace-icon fa fa-trash-o bigger-130"></i> </a>';
		  ?> </div> </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->