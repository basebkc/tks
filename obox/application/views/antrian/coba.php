<script src="https://cdn.jsdelivr.net/gh/tanaikech/ResumableUploadForGoogleDrive_js@master/resumableupload_js.min.js"></script>

<body>
    <?php echo form_open(site_url('coba/in')); ?>
    <input name="file" id="uploadfile" type="file" />
    <input type="text" name="getRes" id="getRes">
    <div id="btn-sub"></div>
    <?php echo form_close(); ?>
  <div style="background: #9ed3ff" id="progress"></div>
  
</body>
 <script type="text/javascript">
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:
         var data=JSON.parse(xhttp.responseText);
         console.log(data);
      }
  };
  xhttp.open("GET", "<?php echo base_url('assets/data.json') ?>", true);
  xhttp.send();

 </script>
<script type="text/javascript" src="<?php echo base_url('assets/upload_gd.js') ?>"></script>
