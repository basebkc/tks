
        <!-- Main content -->
        <?php $this->load->view('peran_pengguna/peran_pengguna_sweetalert') ?>
        <section class='content'>
          <div>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>DATA PERAN PENGGUNA <?php echo anchor('peran_pengguna/create/','Tambah Data',array('class'=>'btn btn-danger btn-sm'));?>
		<?php echo anchor(site_url('peran_pengguna/excel'), ' <i class="fa fa-file-excel-o"></i> Ex. Excel', 'class="btn btn-secondary btn-sm"'); ?>
		<?php //echo anchor(site_url('peran_pengguna/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
                <div class="table-header">
                  DATA MASTER PERAN PENGGUNA
                </div>
        <table style="font-size: 14px" class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No.</th>
		    <th>Nama Peran Pengguna</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($peran_pengguna_data as $peran_pengguna)
            {
                ?>
                <tr>
		    <td style="padding: 4px;"><?php echo ++$start ?></td>
		    <td style="padding: 4px;"><?php echo $peran_pengguna->nama ?></td>
		    <td style="padding: 4px;" style="text-align:center" width="140px"> <div class="hidden-sm hidden-xs action-buttons">
			<?php 
			echo anchor(site_url('peran_pengguna/read/'.$peran_pengguna->id),' <i class="ace-icon fa fa-search-plus bigger-120"></i>','class="blue"',array('title'=>'detail')); 
			echo '  '; 
			echo anchor(site_url('peran_pengguna/update/'.$peran_pengguna->id),'<i class="ace-icon fa fa-edit bigger-130"></i>','class="green"',array('title'=>'edit')); 
			echo '  '; 
			echo '<a class="red" href="#" title="delete" onclick="return hapusperan_pengguna('.$peran_pengguna->id.');"><i class="ace-icon fa fa-trash bigger-130"></i> </a>';
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