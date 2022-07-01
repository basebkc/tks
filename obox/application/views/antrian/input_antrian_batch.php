<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<?php
  if (!isset($error)) {
   $error=null;
  }

  if (!isset($val_no_ktp)) {
   $val_no_ktp=null;
  }
?>
<font size="6">Addons iDeb</font>
<div align="left"><font size="3" color="#666">Permintaan Kode Referensi Pengguna</font></div>
<br />
<div class="row">
    <div class="col-lg-6">
        <div style="padding-left: 10%;padding-right: 10%" class="contact1-form validate-form ">
			       <form method="post" action="<?= site_url('antrian/create_batch_action') ?>">


                <!-- Buat tombol untuk menabah form data -->
                <button type="button" class="btn btn-danger clas" id="btn-tambah-form">Tambah Data Form</button>
                <button onclick="document.getElementById('no_ktp').value = ''" type="button" class="btn btn-danger clas" id="btn-reset-form">Reset Form</button><br><br>
                <label>Nomor Identitas 1</label> &nbsp;<b style="font-size: 13px;color: #ff0000"><?php // $val_no_ktp; ?></b>
                  <div class="row">
                    <div class="col-md-10">
                      <div style="margin-bottom: 2%" class="wrap-input1 validate-input">
                        <input id="no_ktp" class="form-control " type="text" name="no_ktp[]" placeholder="Nomor KTP/Paspor" required value="<?= empty($no_ktp)?null:$no_ktp; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                        <button disabled type='button' name='remove' id='"+nextform+"' class='btn btn-danger btn_remove'><i class='fas fa-fw fa-trash'></i></button>
                    </div>
                  </div>


                <div id="insert-form"></div>

                <hr style="background-color: #9e1e21">
                <div  align="center" class="container-contact1-form-btn">
                  <button type="submit" class="btn btn-danger clas" value="Simpan">
                    <span>
                      <?= empty($button)?"Bikin Kode Referensi":"Update"; ?>
                      <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </span>
                  </button>
                </div>

	           </form>

               <!-- Kita buat textbox untuk menampung jumlah data form -->
               <input type="hidden" id="jumlah-form" value="1">
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


  <script>
  function deleteTable0(r)
{
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("0").deleteRow(i);
}
  $(document).ready(function(){ // Ketika halaman sudah diload dan siap
    $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
      var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
      var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya

      // Kita akan menambahkan form dengan menggunakan append
      // pada sebuah tag div yg kita beri id insert-form
      $("#insert-form").append("<div id='row"+nextform+"'>"+
        "<label>Nomor Identitas "+nextform+"</label> &nbsp;<b style='font-size: 13px;color: #ff0000'></b>"+
          "<div class='row'>"+
            "<div class='col-md-10'>"+
              "<div style='margin-bottom: 2%' class='wrap-input1 validate-input'>"+
                "<input id='no_ktp' class='form-control ' type='text' name='no_ktp[]' placeholder='Nomor KTP/Paspor' required>"+
              "</div>"+
            "</div>"+
            "<div class='col-md-2'>"+
                "<button type='button' name='remove' id='"+nextform+"' class='btn btn-danger btn_remove'><i class='fas fa-fw fa-trash'></i></button>"+
            "</div>"+
          "</div>"+
          "</div>");

      $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
    });

    $(document).on('click', '.btn_remove', function(){
         var button_id = $(this).attr("id");
         $('#row'+button_id+'').remove();
    });
    // Buat fungsi untuk mereset form ke semula
    $("#btn-reset-form").click(function(){
      $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
      $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
    });
  });
  </script>
