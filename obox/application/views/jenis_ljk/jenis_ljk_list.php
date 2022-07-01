
        <!-- Main content -->
        <?php $this->load->view('jenis_ljk/jenis_ljk_sweetalert') ?>
        <section class='content'>
          <div >
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                  <h3 class='box-title'>DATA JENIS LJK <?php echo anchor('jenis_ljk/create/','Tambah Data',array('class'=>'btn btn-danger btn-sm'));?>
		<?php echo anchor(site_url('jenis_ljk/excel'), ' <i class="fa fa-file-excel-o"></i> Ex. Excel', 'class="btn btn-secondary btn-sm"'); ?>
		<?php //echo anchor(site_url('jenis_ljk/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-primary btn-sm"'); ?></h3>
                </div><!-- /.box-header -->
                <div class='box-body'>
                <div class="table-header">
                  DATA MASTER JENIS LJK (Lembaga Jasa Keuangan)
                </div>
        <table style="font-size: 14px" class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No.</th>
		    <th>Kode LJK</th>
		    <th>Nama LJK</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($jenis_ljk_data as $jenis_ljk)
            {
                ?>
                <tr>
		    <td style="padding: 4px;"><?php echo ++$start ?></td>
		    <td style="padding: 4px;"><?php echo $jenis_ljk->kode ?></td>
		    <td style="padding: 4px;"><?php echo $jenis_ljk->nama_ljk ?></td>
		    <td style="padding: 4px;" style="text-align:center" width="140px"> <div class="hidden-sm hidden-xs action-buttons">
			<?php 
			echo anchor(site_url('jenis_ljk/read/'.$jenis_ljk->id),' <i class="ace-icon fa fa-search-plus bigger-120"></i>','class="blue"',array('title'=>'detail')); 
			echo '  '; 
			echo anchor(site_url('jenis_ljk/update/'.$jenis_ljk->id),'<i class="ace-icon fa fa-edit bigger-130"></i>','class="green"',array('title'=>'edit')); 
			echo '  '; 
			echo '<a class="red" href="#" title="delete" onclick="return hapusjenis_ljk('.$jenis_ljk->id.');"><i class="ace-icon fa fa-trash bigger-130"></i> </a>';
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