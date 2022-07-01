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
        <h2>Kantor</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kd Kan</th>
		<th>Kd Jenis Ljk</th>
		<th>N Kan</th>
		
            </tr><?php
            foreach ($tbl_kantor_data as $tbl_kantor)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_kantor->kd_kan ?></td>
		      <td><?php echo $tbl_kantor->kd_jenis_ljk ?></td>
		      <td><?php echo $tbl_kantor->n_kan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>