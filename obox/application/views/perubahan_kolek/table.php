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
    

 <div style="margin-top: 5px;margin-bottom: 5px" class="table-header">PERUBAHAN KOLEKTIBILITAS</div>
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

                                            <div class="col-md-3 ">
                                                <div class="form-group"><label class="small mb-1" for="inputLastName">Dari Tanggal</label>
                                                    <div class="dates">
                                                        <input type="date" name="daritgl" id="daritgl" autocomplete="off"  class="form-control" placeholder="yyyy-mm-dd" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="form-group"><label class="small mb-1" for="inputLastName">Sampai Tanggal</label>
                                                    <div class="dates">
                                                        <input type="date" name="sampaitgl" id="sampaitgl" autocomplete="off"  class="form-control" placeholder="yyyy-mm-dd" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <a id="getPerubahanKolek" style="margin-right: 5px; color:white;"   class=" btn btn-primary " type="submit"  >Hitung</a>
                                                <a href="#" style="margin-right: 5px; color:white;"   class=" btn btn-success " type="submit"  >Excel</a>
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
       
        <span class="nav-tabs-wrapper-border" role="presentation"></span>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tabA">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="h3 mb-0 text-gray-800"> Perubahan Kolektibilitas</h4>
                        <div class="toolbar clearfix">
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
                        <div id="infoMessage"><?php  if(isset($message)){ echo $message; }else{ echo ""; };?></div>
                        <div id="tampilPerubahanKolek"></div>
                    </div>
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

    $("#getPerubahanKolek").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();

        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl},
            url: "<?php echo base_url(); ?>generate/tampilKolek",
            cache: false,
            beforeSend: function(){
                // Show image container
                $(".loader").show();
            },
            success: function(data) {
                $("#tampilPerubahanKolek").html(data);
            },
            complete:function(data){
                // Hide image container
                $(".loader").hide();
            }
        });
    })

  $("#getCR006").click(function(){
        var daritgl = $("#daritgl").val();
        var sampaitgl = $("#sampaitgl").val();
        var id_inisial = $("#id_inisial").val();
        $.ajax({
            type: 'POST',
            data:{daritgl:daritgl,sampaitgl:sampaitgl,id_inisial:id_inisial},
            url: "<?php echo base_url(); ?>generate/tampilKolek",
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
