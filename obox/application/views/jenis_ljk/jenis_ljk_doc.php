<!doctype html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?php //echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
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
        <h2>Jenis LJK</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode</th>
		<th>Nama Ljk</th>
		
            </tr><?php
            foreach ($jenis_ljk_data as $jenis_ljk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $jenis_ljk->kode ?></td>
		      <td><?php echo $jenis_ljk->nama_ljk ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>