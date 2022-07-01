<script src="<?php echo base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
   <script src="<?php echo base_url() ?>assets/sweetalert/jquery.min.js"></script>
<script>
  function hapusantrian(kode) {
      swal({
          title: "Hapus Data",
          text: "Yakin data dengan kode "+kode+" akan dihapus?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, Hapus",
          cancelButtonText: "Tidak, Batalkan",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            var nilaicsrf='<?php echo $this->security->get_csrf_hash() ?>';
            var datanya = "&kode="+kode+"&token_klinik="+nilaicsrf;
             $.ajax({
              url :"<?php echo site_url('auth/delete') ?>",
              data : datanya,
              type : 'post',
              dataType : 'json',
              cache : false,
              error:function(e){
                swal('error',e,'error');
              },
              success: function(data){
                if (data.sukses) {
                  swal({
                      title: "Hapus Data",
                      text: "data.sukses",
                      type: "success",
                      showCancelButton: false,
                      closeOnConfirm: false,
                      showLoaderOnConfirm: true,
                    },
                    function(){
                      setTimeout(function(){
                        window.location.reload();
                      }, 1000);
                    });
                }
              }
            })
          } else {
            swal("Batal", "Data batal dihapus", "error");
          }
        });
       
    }

</script>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Inisialisasi Laporan</h1>
        <div class="toolbar clearfix">
            <a style="margin-right: 5px" href="#" data-target="#login-box" class="btn btn-secondary" type="submit" >Data </a>
            <a href="#" data-target="#forgot-box" class="btn btn-danger" type="submit" >Tambah</a>
        </div>
    </div>
     <div id="infoMessage"><?php echo $message;?></div>
    <div class="login-layout">
        
        <div class="space-6"></div>
        <?php if (!isset($data_users_visible)) {
            $data_users_visible=null;
        } ?>
            <div class="position-relative">
                <div id="login-box" class="login-box <?= $data_users_visible ?>  widget-box no-border">
                    <div class="widget-body">
                        <div class="card mb-4">
                            <table style="font-size: 14px" width="100%" class="table-bordered table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <td  align="center"><i>No</i></td>
                                        <td>Kode Jenis LJK</td>
                                        <td>Kode LJK</td>
                                        <td>Dari Tanggal</td>
                                        <td>Sampai Tanggal</td>
                                        <td>Tanggal Laporan</td>
                                        <td>Tanggal Periode Sebelumnya</td>
                                        <td>Dibuat Tgl</td>
                                        <td>User</td>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php $no=1; foreach($init as $item){ ?>
                                            <tr>
                                            <td  align="center"><i><?php echo $no++; ?></i></td>
                                            <td><?php echo $item->kodejenisljk; ?></td>
                                            <td><?php echo $item->kodeljk; ?></td>
                                            <td><?php echo $item->daritgl; ?></td>
                                            <td><?php echo $item->sampaitgl; ?></td>
                                            <td><?php echo $item->tgllaporan; ?></td>
                                            <td><?php echo $item->periodebatassebelum; ?></td>
                                            <td><?php echo $item->created_at; ?></td>
                                            <td><?php echo $item->user; ?></td>
                                            </tr>       
                                        <?php } ?>
                                                         
                                </tbody>
                            </table>
                      </div>
                    </div><!-- /.widget-body -->
                </div><!-- /.login-box -->
                <?php if (!isset($daftar_visible)) {
                  $daftar_visible=null;
                } ?>
                <div id="forgot-box" class="forgot-box <?= $daftar_visible ?> widget-box no-border">
                    <div class="widget-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="card ">
                                        <h4 align="center" style="padding-top: 1.5%;padding-bottom: 1.5%;background-color: #d5e3ef;margin-top: 0px;margin-bottom: 0px;" class="header blue lighter bigger">
                                            <i class="ace-icon fa fa-add green"></i>
                                            <b>Tambah Inisialisasi Laporan</b>
                                        </h4>
                                        <div class="space-6"></div>
                                        <div class="card-body">
                                        <?php echo form_open("generate/store");?>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">KODE JENIS LJK</label>
                                                        <input class="form-control " name="kode_jenis_ljk" id="kode_jenis_ljk" type="text"  value="01020101" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">KODE LJK</label>
                                                        <input class="form-control " name="kode_ljk" id="kode_ljk" type="text" readonly value="600420" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Dari Tanggal</label>
                                                        <input class="form-control " name="daritgl" id="daritgl" type="date"  value="" require=""/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Sampai Tanggal</label>
                                                        <input class="form-control " name="sampaitgl" id="sampaitgl" type="date"  value="" require=""/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Tanggal Laporan</label>
                                                        <label class="form-control" name="tgllaporan" ><?php echo date('Y-m-d') ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Periode Tanggal Sebelum</label>
                                                        <input class="form-control " name="batasperiode" id="batasperiode" type="date"  value="" require="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0 row">
                                                    <div class="col-md-6">
                                                    <div style="background-color: transparent;padding-top: 0px;padding-left: 0px;padding-bottom: 0px;padding-right: 0px;border-top-width: 0px;" class="toolbar ">
                                                        <a href="#" data-target="#login-box" class="btn btn-secondary btn-block" type="submit" >Cancel</a>
                                                    </div>          
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-danger btn-block">Simpan</button>
                                                </div>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               

                  </div><!-- /.widget-body -->
                </div><!-- /.forgot-box -->

                
  </div><!-- /.position-relative -->
</div>