<script>
function myFunction() {
  var cek = document.getElementById("cektemplate").value;
  if (cek == "1") {
    document.getElementById("template").style.paddingLeft = "9%";
    document.getElementById("pad_search").style.marginLeft = "0px";
    document.getElementById("cektemplate").value="2";
  }else{
    document.getElementById("template").style.paddingLeft = "18%";
    document.getElementById("pad_search").style.marginLeft = "8%";
    document.getElementById("cektemplate").value="1";
  }
  
}
</script>
<script type="text/javascript">
      jQuery(function($) {
       $(document).on('click', '.toolbar a[data-target]', function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('.widget-box.visible').removeClass('visible');//hide others
        $(target).addClass('visible');//show target
       });
      });
      
    </script>
  <!-- HARI OTOMATIS -->
  <script src="https://cdn.jsdelivr.net/gh/tanaikech/ResumableUploadForGoogleDrive_js@master/resumableupload_js.min.js"></script>

  <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
<script type="text/javascript" src="<?php echo base_url('assets/upload_gd.js') ?>"></script>
    <!-- <script src="<?php echo base_url('assets/hari_otomatis/time.js') ?>" type="text/javascript"></script> -->
      <!-- HARI OTOMATIS -->

       <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

  <!-- Page level plugins -->
  <!-- <script src="<?php //echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script> -->

  <!-- Page level custom scripts -->
  <!-- <script src="<?php //echo base_url('assets/js/demo/chart-area-demo.js') ?>"></script> -->
  <!-- <script src="<?php //echo base_url('assets/js/demo/chart-pie-demo.js') ?>"></script> -->

</body>

</html>

        <!-- DATA TABLES -->
       	<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables/jQuery-3.3.1.js') ?>"></script>
 <script  type="text/javascript" charset="utf8" src="<?php echo base_url('assets/datatables/dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets\ace-master\assets\js\buttons.colVis.min.js') ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>

    <script src="<?php echo base_url('assets/vendor/tilt/tilt.jquery.min.js') ?>"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23581568-13');
    </script>

<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/js/main.js') ?>"></script>

 
  <!-- DATEPICKER -->
  <script type="text/javascript" src="<?php echo base_url() ?>assets/datepicker/bootstrap-datepicker.js"></script>
  <link href="<?php echo base_url() ?>assets/datepicker/bootstrap-datepicker.css" rel="stylesheet">
  <script>
    $(function() {
       $('.dates #datepkr').datepicker({
          'format' : 'yyyy-mm-dd',
          'autoclose' : true 
       });
    });
     $(function() {
       $('.dates #tgl_awal').datepicker({
          'format' : 'yyyy-mm-dd',
          'autoclose' : true 
       });
    });
      $(function() {
       $('.dates #tgl_akhir').datepicker({
          'format' : 'yyyy-mm-dd',
          'autoclose' : true 
       });
    });

  </script>
    <!-- DATEPICKER -->

    <!-- UMUR -->
    <script>
      function get_age() {
        var date = document.getElementById('datepkr2').value;
 
      if(date === ""){
        alert("Please complete the required field!");
        }else{
        var tgl = date.substring(2, 0);
        var bln = date.substring(4, 2);
        var thn = date.substring(8, 4);
        var tgl_lahir = tgl+"-"+bln+"-"+thn;
        var tgl_lahir2 = thn+"-"+bln+"-"+tgl;
        var today = new Date();
        var birthday = new Date(tgl_lahir2);
        var year = 0;
        if (today.getMonth() < birthday.getMonth()) {
          year = 1;
        } else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
          year = 1;
        }
        var age = today.getFullYear() - birthday.getFullYear() - year;
     
        if(age < 0){
          alert("Maaf tanggal yang anda pilih tidak valid !");
          return;
        } else if (age <= 15) {
          alert("Maaf usia tidak boleh dibawah 15 tahun !");
          return;
        }
        var error = isNaN(age);
        if(error==true){
            document.getElementById('umur').value = 'Tgl Tidak Valid!';
            document.getElementById('datepkr2').value = '';
            document.getElementById('datepkr').value = '';
        }else{
            document.getElementById('umur').value = age+' Tahun';
            document.getElementById('datepkr').value = tgl_lahir2;
            document.getElementById('datepkr2').value = tgl_lahir;
        }
           
       
            
        
       
      }
      }
    </script>

    <script>
  function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  var text = ($(element).text());
    alert("Copied the text: " + text );
  $temp.remove();
}
    </script>
    </body>
</html>