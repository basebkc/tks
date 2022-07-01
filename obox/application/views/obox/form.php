<style>
.nav-tabs-wrapper {
    display: block;
    overflow: hidden;
    height: calc(1.5rem + 1rem + 2px); /** 1.5 is font-size, 1 is padding top and bottom, 2 is border width top and bottom */
    position: relative;
    z-index: 1;
    margin-bottom: -1px;
    .nav-tabs {
        overflow-x: auto;
        flex-wrap: nowrap;
        border-bottom: 0;
    }
    .nav-item {
        margin-bottom: 0;
        &:first-child {
            padding-left: 15px;
        }
        &:last-child {
            padding-right: 15px;
        }
    }
    .nav-link {
        white-space: nowrap;
    }
    .dragscroll:active,
    .dragscroll:active a {
        cursor: -webkit-grabbing;
    }
}

.nav-tabs-wrapper-border {
    display: block;
    width: 100%;
    border-top: 1px solid #ddd;
}

.tab-pane {
    padding: 1rem;
}

</style>

<?php if (!isset($daftar_visible)) {
  $daftar_visible=null;
} ?>
<?php $this->load->view('antrian/antrian_sweetalert') ?>
    

 <div style="margin-top: 5px;margin-bottom: 5px" class="table-header">GENERATE OBOX</div>
      <div class=" toolbar clearfix"></div>
<div class="login-layout">
    <div id="result"></div>
    <div style="clear:both"></div>
        <div class="position-relative">
            <div id="login-box" class="login-box visible  widget-box no-border">
                <div class="widget-body">
                          <!-- Earnings (Monthly) Card Example -->
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body" style="padding-top: 0px;padding-bottom: 0px;padding-right: 0px;padding-left: 5px;">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                
                                    <div class="form-row">

                                        <input class="form-control" type="hidden" value="<?php echo $data[0]['id'] ?>" id="id_inisial">
                                        <input class="form-control" type="hidden" value="<?php echo $data[0]['tgllaporan'] ?>" id="tgllaporan">
                                        <div class="col-md-3">
                                            <div class="form-group"><label class="small mb-1" for="inputFirstName">Tanggal Laporan</label>
                                            <div class="dates">
                                                <label  name="lbl"  readonly class="form-control"  ><?php echo date('Y-m-d') ?></label>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group"><label class="small mb-1" for="inputLastName">Tanggal Periode Batas Sebelum</label>
                                                <div class="dates">
                                                    <input type="text" name="periodebatassebelum" id="periodebatassebelum" autocomplete="off" readonly class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $data[0]['periodebatassebelum']?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="form-group"><label class="small mb-1" for="inputLastName">Dari Tanggal</label>
                                                <div class="dates">
                                                    <input type="text" name="daritgl" id="daritgl" autocomplete="off" readonly class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $data[0]['daritgl']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="form-group"><label class="small mb-1" for="inputLastName">Sampai Tanggal</label>
                                                <div class="dates">
                                                    <input type="text" name="sampaitgl" id="sampaitgl" autocomplete="off" readonly class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $data[0]['sampaitgl']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.widget-body -->
            </div><!-- /.login-box -->
    </div>
    <div style="margin-top: 0.5%" class="card mb-4">
        <div style="padding-left: 10px;padding-right: 10px" id="hidd">
             
        <br>
        <!-- Start Tabs -->
        <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs dragscroll horizontal">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabA">CR006-A</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabB">CR007-A</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabC">CR008-A</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabD">CR009-A</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabE">OP001-A</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabF">OP002-A</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabG">OP003-A</a></li> -->
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabH">LQ003-A</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabI">LQ004-A</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabJ">LQ005-A</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabK">LQ006-A</a></li>
            </ul>
        </div>
        <span class="nav-tabs-wrapper-border" role="presentation"></span>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tabA">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h4 class="h3 mb-0 text-gray-800"> Resiko Kredit : Debitur Baru Plafond Terbesar</h4>
                           
                            
                            <div class="toolbar clearfix">
                                <a id="getCR006" style="margin-right: 5px; color:white;"   class=" btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/excelcr006/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtcr006/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilCR006"></div>
                            
                            
                        </div>
                        
                </div>
                <div class="tab-pane fade" id="tabB">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Resiko Kredit : Debitur Top-Up Plafond Terbesar</h1>
                            <div class="toolbar clearfix">
                                <a id="getCR007" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/txtcr007/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>

                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                            
                            
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilCR007"></div>
                        </div>
                </div>
                <div class="tab-pane fade" id="tabC">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Resiko Kredit : Debitur Penurunan Baki DebetTerbesar</h1>
                            <div class="toolbar clearfix">
                                <a id="getCR008" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/txtcr008/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtcr008/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                           
                            
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilCR008"></div>
                        </div>
                         
                </div>
                <div class="tab-pane fade" id="tabD">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Resiko Kredit : Debitur Perubahan Kualitas Berdasarkan Baki Debet Terbesar</h1>
                            <div class="toolbar clearfix">
                                <a id="getCR009" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/excelcr009/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtcr009/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>                                
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                            
                            
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilCR009"></div>
                        </div>
                </div>
                <div class="tab-pane fade" id="tabE">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Resiko Operasional : Pemantauan Mutasi Kas Harian</h1>
                            <div class="toolbar clearfix">
                                <a id="getOP001" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/excelop001/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtop001/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>                                
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                            
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilOP001"></div>
                        </div>
                </div>
                <div class="tab-pane fade" id="tabF">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Resiko Operasional : Pemantauan Penempatan pada Bank Lain</h1>
                            <div class="toolbar clearfix">
                                <a id="getOP002" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/excelop002/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtop002/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>                                
                                
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                            
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilOP002"></div>
                        </div>
                </div>
                <div class="tab-pane fade" id="tabH">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Resiko Likuiditas : 10 Nasabah dengan Dana Masuk Terbesar</h1>
                            <div class="toolbar clearfix">
                                <a id="getLQ003" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/excellq003/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtlq003/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>                                
                                
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                            
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilLQ003"></div>
                        </div>
                    <!-- <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
                            <h1 style="margin-left: 41.5%">Data LQ003 Kosong </h1> -->
                </div>
                <div class="tab-pane fade" id="tabI">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Resiko Likuiditas : 10 Nasabah dengan Dana Keluar Terbesar</h1>
                            <div class="toolbar clearfix">
                                <a id="getLQ004" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/excellq004/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtlq004/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>                                
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                            
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilLQ004"></div>
                        </div>
                    <!-- <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
                            <h1 style="margin-left: 41.5%">Data LQ004 Kosong </h1> -->
                </div>
                <div class="tab-pane fade" id="tabJ">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Resiko Likuiditas : Pemantauan Cash Ratio Mingguan</h1>
                            <div class="toolbar clearfix">
                                <a id="getLQ005" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/excellq005/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtlq005/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>                                
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                           
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilLQ005"></div>
                        </div>
                </div>
                <div class="tab-pane fade" id="tabK">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"> Resiko Likuiditas : Pemantauan Loan to Deposit Ratio</h1>
                            <div class="toolbar clearfix">
                                <a id="getLQ006" style="margin-right: 5px; color:white;"   class="btn btn-primary " type="submit"  >Hitung</a>
                                <a href="<?php echo site_url('generate/excellq006/'.$data[0]['periodebatassebelum'].'/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
                                <a href="<?php echo site_url('generate/txtlq006/'.$data[0]['daritgl'].'/'.$data[0]['sampaitgl']) ?>" style="margin-right: 5px; color:white;"   class=" btn btn-danger " type="submit"  >Generate TXT</a>                                
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <hr>
                            
                            <!-- Image loader -->
                            <div class='loader' style='display: none;'>
                                <div style="text-align: center !important;">
                                    <img src='<?= base_url('assets/images/loading.png') ?>' width='102px' height='102px'>
                                </div>
                            </div>
                            <!-- Image loader -->
                            <div id="tampilLQ006"></div>
                        </div>
                         <!-- <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
                            <h1 style="margin-left: 41.5%">Data LQ006 Kosong </h1> -->
                </div>
            </div>
<!-- End Tabs -->
        </div>
    </div>


</div>
<script>


$(document).ready(function() {
   
});


$(document).ready(function(){

  $("#getCR006").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial},
            url: "<?php echo base_url(); ?>generate/tampilCR006",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilCR006").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#getCR007").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial},
            url: "<?php echo base_url(); ?>generate/tampilCR007",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilCR007").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#getCR008").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var periodebatassebelum = $("#periodebatassebelum").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,periodebatassebelum:periodebatassebelum},
            url: "<?php echo base_url(); ?>generate/tampilCR008",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilCR008").html(data);
                alert("Sukses");
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });


  $("#getCR009").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var periodebatassebelum = $("#periodebatassebelum").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,periodebatassebelum:periodebatassebelum},
            url: "<?php echo base_url(); ?>generate/tampilCR009",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilCR009").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#getOP001").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var periodebatassebelum = $("#periodebatassebelum").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,periodebatassebelum:periodebatassebelum},
            url: "<?php echo base_url(); ?>generate/tampilOP001",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilOP001").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#getOP002").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var periodebatassebelum = $("#periodebatassebelum").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,periodebatassebelum:periodebatassebelum},
            url: "<?php echo base_url(); ?>generate/tampilOP002",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilOP002").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#getLQ003").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var periodebatassebelum = $("#periodebatassebelum").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,periodebatassebelum:periodebatassebelum},
            url: "<?php echo base_url(); ?>generate/tampilLQ003",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilLQ003").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#getLQ004").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var periodebatassebelum = $("#periodebatassebelum").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,periodebatassebelum:periodebatassebelum},
            url: "<?php echo base_url(); ?>generate/tampilLQ004",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilLQ004").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#getLQ005").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var periodebatassebelum = $("#periodebatassebelum").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,periodebatassebelum:periodebatassebelum},
            url: "<?php echo base_url(); ?>generate/tampilLQ005",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilLQ005").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });


  $("#getLQ006").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var periodebatassebelum = $("#periodebatassebelum").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,periodebatassebelum:periodebatassebelum},
            url: "<?php echo base_url(); ?>generate/tampilLQ006",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilLQ006").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });



  //====================== Generate TXT =======================//

  $("#generateCR006").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtcr006",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                // $("#tampilCR007").html(data);
                // alert("Sukses");
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#generateCR007").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtcr007",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                // $("#tampilCR007").html(data);
                alert("Sukses");
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#generateCR008").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtcr008",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                alert("Sukses")
                // $("#tampilCR006").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#generateCR009").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtcr009",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                // $("#tampilCR009").html(data);
                alert("Sukses");
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#generateOP001").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtop001",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                // $("#tampilCR009").html(data);
                alert("Sukses");
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#generateOP002").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtop002",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                // $("#tampilCR009").html(data);
                alert("Sukses");
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#generateLQ003").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtlq003",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                alert("Sukses")
                // $("#tampilLQ005").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

    });
    

    $("#generateLQ004").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtlq004",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                alert("Sukses")
                // $("#tampilLQ005").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

    });

  $("#generateLQ005").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtlq005",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                alert("Sukses")
                // $("#tampilLQ005").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });
  $("#generateLQ006").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/txtlq006",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                alert("Sukses")
                // $("#tampilLQ005").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

  });

  $("#excelCR006").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        var tgllaporan = $("#tgllaporan").val();
        
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial,tgllaporan:tgllaporan},
            url: "<?php echo base_url(); ?>generate/excel",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                alert("Sukses")
                // $("#tampilLQ005").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });

    });
  
  

  $('#search_text').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
      load_data(search);
      document.getElementById('result').style.display='block';
    }else{
      document.getElementById('hidd').style.display='block';
      document.getElementById('hidd3').style.display='block';
      document.getElementById('result').style.display='none';
    }
  });
});
  function data_ref(){
     document.getElementById('hidd').style.display='block';
     document.getElementById('rekap').style.display='none';
     document.getElementById('tgl_awal').value="";
     document.getElementById('tgl_akhir').value="";
     document.getElementById('company').value="";
  }
    function data_rek(){
     document.getElementById('tgl_awal').value="";
     document.getElementById('tgl_akhir').value="";
     document.getElementById('company').value="";
  }


</script>
