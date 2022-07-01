<font size="6">Addons iDeb</font>
<div align="left"><font size="3" color="#666">Permintaan Kode Referensi Pengguna</font></div>         
<br />
<table  width="100%">
	<tr>
		<td width="48%" style="padding-left: 10%">
		
		</td>
			
	</tr>
</table>

<div class="row">

            <div class="col-lg-6">
              <!-- Circle Buttons -->
              	<div style="padding-left: 10%;padding-right: 10%" class="contact1-form validate-form ">
			<form method="post" action="<?= site_url(empty($button)?'antrian/create_action':'antrian/update_action') ?>">
				<input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
				<input type="hidden" id="LINK" name="LINK">
			 <?php 
			 if (!isset($error)) {
			 	$error=null;
			 } 
			 if (!isset($val_nama)) {
			 	$val_nama=null;
			 }
			 if (!isset($val_no_ktp)) {
			 	$val_no_ktp=null;
			 }
			 if (!isset($val_tempat_lahir)) {
			 	$val_tempat_lahir=null;
			 }
			 if (!isset($val_tgl_lahir)) {
			 	$val_tgl_lahir=null;
			 }
			 ?>
       
       			<?php if (!empty($no_antrian)): ?>
					<input hidden class="form-control py-4" type="text" name="id_antrian" placeholder="id_antrian" value="<?= empty($id_antrian)?null:$id_antrian; ?>">	
					<input hidden class="form-control py-4" type="text" name="no_antrian" placeholder="no_antrian" value="<?= empty($no_antrian)?null:$no_antrian; ?>">	
       			<?php endif ?>

				<div style="margin-bottom: 2%" class="wrap-input1 validate-input">
					<label>Nama</label> &nbsp;<b style="font-size: 13px;color: #ff0000"><?= $val_nama; ?></b>
					<input id="nama" onkeyup="cek()" class="form-control " type="text" name="nama" placeholder="Lengkap sesuai identitas" value="<?= empty($nama)?null:$nama; ?>">	
				</div>

				<div style="margin-bottom: 2%" class="wrap-input1 validate-input">
					<label>Nomor Identitas</label> &nbsp;<b style="font-size: 13px;color: #ff0000"><?php // $val_no_ktp; ?></b>
					<input id="no_ktp" onkeyup="cek()" class="form-control " type="text" name="no_ktp" placeholder="Nomor KTP/Paspor" value="<?= empty($no_ktp)?null:$no_ktp; ?>">
				</div>
				<div style="margin-bottom: 2%" class="wrap-input1 validate-input">
					<label>Tempat Lahir</label> &nbsp;<b style="font-size: 13px;color: #ff0000"><?= $val_tempat_lahir; ?></b>
					<input id="tempat_lahir" onkeyup="cek()" class="form-control " type="text" name="tempat_lahir" placeholder="Kabupaten apa?" value="<?= empty($tempat_lahir)?null:$tempat_lahir; ?>" />
				</div>

				<div style="margin-bottom: 2%" class="wrap-input1 validate-input">
					<table>
						<tr><td colspan="2">Tanggal Lahir <a style="font-size:13px">(DDMMYYYY)</a> &nbsp;<b style="font-size: 13px;color: #ff0000"><?= $val_tgl_lahir; ?></b></td></tr>
						<tr>
							<td>
								<div>	
								<input hidden  type="text" name="tgl_lahir"  id="datepkr"  value="<?= empty($tgl_lahir)?null:$tgl_lahir; ?>">
								<input   type="text" id="datepkr2" class="form-control"  onchange="get_age(); cek()" placeholder="Contoh: 17031972" value="<?= empty($tgl_lahir_v)?null:$tgl_lahir_v; ?>">
									</div>
							</td>
							<td>
								<input class="form-control " type="text" name="umur" id="umur" placeholder="Umur Nasabah" value="<?= empty($age)?null:$age; ?>" data-date-format="yyyy-mm-dd" required readonly="readonly">
									
							</td>
						</tr>
					</table>
				</div>
					 <div style="margin-bottom: 5%" class="wrap-input1 validate-input" >

    <p>  
        <input type="radio" name="option" id="premium" onchange="dengan_file()" checked> 
            Dengan File
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		<input type="radio" name="option" id="free" onchange="tanpa_file()" > 
            Tanpa File

    </p> 
      

</div>		
				<div style="margin-bottom: 5%" class="wrap-input1 validate-input" >

					<input  <?= empty($button)?"disabled":null; ?> required onclick="run()" name="file" id="uploadfile" type="file" />
					<input  type="hidden" name="file_lama" value="<?= empty($file)?null:$file; ?>">
  					<div style="background: #9ed3ff" id="progress"></div>
					<input hidden class="form-control "  type="text" name="getRes" id="getRes">
    				<!-- <div id="btn-sub"></div> -->
				</div>
				<hr style="background-color: #9e1e21">
				<div  align="center" class="container-contact1-form-btn">
					<button id="myBtn" disabled class="btn btn-danger clas">
						<span>
							<?= empty($button)?"Bikin Kode Referensi":"Update"; ?>
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>

			</form>
			</div>
             

            </div>

            <div  class="col-lg-6 vertikal_center">

            
           <table style="height: 462px;width: 100%;" >
           	<tr>
           		   <td <?php if (!empty($sukses)|| !empty($button)){ ?>
						<?php if ($button=="Update"){ ?>
							class="bg2"
						<?php }else{ ?>
							class="bg1"
						<?php } ?>
				<?php } ?>>
				<?php if (!empty($sukses)|| !empty($button)){ ?>
					<div class="pp2" ><br />
					<font face="Arial Black" >KODE REFERENSI ANDA</font>
					</div>
					<div align="center" >
					<img width="7%"  src="<?= base_url('assets/images/panah.png') ?>" alt="IMG">
					</div>
					<div align="center">
					<p id="mykode" class="pp" ><font face="Arial Black" ><?= empty($button)?$sukses:$no_antrian; ?></font></p>

						<button onclick="copyToClipboard('#mykode')" class="btn btn-danger">COPY CLIPBOARD</button>
					</div>
				<?php }else{  
					if ($error=="") { ?>
						<div align="center" >
					<img width="100%" src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
				</div>
				<?php }else{ 
					echo $error;
					?>

				<?php } } ?>
			</td>
           	</tr>
           </table>


            </div>

</div>