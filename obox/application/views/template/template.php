<?php
		$this->load->view('template/css');
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
 ?>	
                <!-- Begin Page Content -->
                <input id="cektemplate" type="hidden" value="1">
        <div id="template" style="margin-top: 6%;padding-left: 18%" class="container-fluid">

          <!-- Page Heading -->

	        	<?php
					echo $contents;
				?>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->			

<?php
		$this->load->view('template/footer');
		$this->load->view('template/javascript');
 ?>
