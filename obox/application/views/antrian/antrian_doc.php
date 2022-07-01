<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important;
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important;
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Antrian List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>No Antrian</th>
		<th>Nama</th>
		<th>No Ktp</th>
		<th>Tempat Lahir</th>
		<th>Tgl Lahir</th>
		<th>File</th>
		<th>Id User</th>
		<th>Tgl Upload</th>
		
            </tr><?php
            foreach ($antrian_data as $antrian)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
              <td><?php echo $antrian->no_antrian ?></td>
		      <td><?php echo $antrian->nama ?></td>
		      <td><?php echo $antrian->no_ktp ?></td>
		      <td><?php echo $antrian->tempat_lahir ?></td>
		      <td><?php echo $antrian->tgl_lahir ?></td>
		      <td><?php echo $antrian->file ?></td>
		      <td><?php echo $antrian->id_user ?></td>
		      <td><?php echo $antrian->tgl_upload ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>