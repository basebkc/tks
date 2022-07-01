<?php

$string = '<link rel="stylesheet" href="<?php echo base_url() ?>/assets/sweetalert/sweetalert.css" />
   <script src="<?php echo base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
   <script src="<?php echo base_url() ?>assets/sweetalert/jquery.min.js"></script>
<script>
  $(document).ready(function(e){
       $(\'.simpan\').submit(function(e){
        $.ajax({
          url :$(this).attr(\'action\'),
          data : $(this).serialize(),
          type : \'post\',
          dataType : \'json\',
          cache : false,
          beforeSend : function(){
            $(\'.tombolsimpan\').attr(\'disabled\',\'disabled\');
            $(\'.tombolsimpan\').html(\'<i class="fa fa-spin fa-spinner"></i> Sedang di Proses\');
          },
          complete : function(){
              $(\'.tombolsimpan\').removeAttr(\'disabled\');
            $(\'.tombolsimpan\').html(\' Create\');
          },
          error:function(e){
            swal(\'error\',e,\'error\');
          },
          success: function(data){
            if (data.validasi) {
              $(\'.pesan\').fadeIn();
              $(\'.pesan\').html(data.validasi);
            }
            if (data.sukses) {
              swal({
                  title: "Simpan Data",
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
        return false;
       })
            $(\'.update\').submit(function(e){
        $.ajax({
          url :$(this).attr(\'action\'),
          data : $(this).serialize(),
          type : \'post\',
          dataType : \'json\',
          cache : false,
          beforeSend : function(){
            $(\'.tombolsimpan\').attr(\'disabled\',\'disabled\');
            $(\'.tombolsimpan\').html(\'<i class="fa fa-spin fa-spinner"></i> Sedang di Proses\');
          },
          complete : function(){
              $(\'.tombolsimpan\').removeAttr(\'disabled\');
            $(\'.tombolsimpan\').html(\' Update\');
          },
          error:function(e){
            swal(\'error\',e,\'error\');
          },
          success: function(data){
            if (data.sukses) {
              swal({
                  title: "Update Data",
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
        return false;
       })
      })
  function hapus' . $c_url .'(kode) {
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
            var nilaicsrf=\'<?php echo $this->security->get_csrf_hash() ?>\';
            var datanya = "&kode="+kode+"&token_klinik="+nilaicsrf;
             $.ajax({
              url :"<?php echo site_url(\'' . $c_url .'/delete\') ?>",
              data : datanya,
              type : \'post\',
              dataType : \'json\',
              cache : false,
              error:function(e){
                swal(\'error\',e,\'error\');
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
';


        $hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_sweetalert_file);
?>
