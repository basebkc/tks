
        <!-- Main content -->
        <?php $this->load->view('tbl_kantor/tbl_kantor_sweetalert') ?>
        <section class='content'>
          <div>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>DATA KANTOR <?php echo anchor('tbl_kantor/create/','Tambah Data',array('class'=>'btn btn-danger btn-sm'));?>
		<?php echo anchor(site_url('tbl_kantor/excel'), ' <i class="fa fa-file-excel-o"></i> Ex. Excel', 'class="btn btn-secondary btn-sm"'); ?>
		<?php //echo anchor(site_url('tbl_kantor/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
                <div class="table-header">
                  DATA MASTER KANTOR CABANG
                </div>
        <table style="font-size: 14px" class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No.</th>
		    <th>Kode Kantor</th>
		    <th>Kode Jenis LJK</th>
		    <th>Nama Kantor</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($tbl_kantor_data as $tbl_kantor)
            {
                ?>
                <tr>
		    <td style="padding: 4px;"><?php echo ++$start ?></td>
		    <td style="padding: 4px;"><?php echo $tbl_kantor->kd_kan ?></td>
		    <td style="padding: 4px;"><?php echo kode_ljk($tbl_kantor->id_ljk )?></td>
		    <td style="padding: 4px;"><?php echo $tbl_kantor->n_kan ?></td>
		    <td style="padding: 4px;" style="text-align:center" width="140px"> <div class="hidden-sm hidden-xs action-buttons">
			<?php 
			echo anchor(site_url('tbl_kantor/read/'.$tbl_kantor->id_kan),' <i class="ace-icon fa fa-search-plus bigger-120"></i>','class="blue"',array('title'=>'detail')); 
			echo '  '; 
			echo anchor(site_url('tbl_kantor/update/'.$tbl_kantor->id_kan),'<i class="ace-icon fa fa-edit bigger-130"></i>','class="green"',array('title'=>'edit')); 
			echo '  '; 
			echo '<a href="#" class="red" title="delete" onclick="return hapustbl_kantor('.$tbl_kantor->id_kan.');"><i class="ace-icon fa fa-trash bigger-130"></i> </a>';
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