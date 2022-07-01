<?php if(count($hasil)>0){ ?>
<table width="100%" class="table-bordered table-striped" id="tableOP001">
    <thead>
        <tr>
            <td  align="center"><i>No</i></td>
            <td>Flag</td>
            <td>Kantor</td>
            <td>Tanggal</td>
            <td>Saldo Awal</td>
            <td>Debet</td>
            <td>Kredit</td>
            <td>Saldo Akhir</td>
            <td>Waktu Dibuat</td>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($hasil as $items) { ?>                    
            <tr>
                <td  align="center"><i><?php echo $no++; ?></i></td>
                <td><?php echo $items['flag_detail'] ?></td>
                <td><?php echo $items['kd_kantor_ojk'] ?></td>
                <td><?php echo $items['tanggal'] ?></td>
                <td><?php echo $items['saldo_awal'] ?></td>
                <td><?php echo $items['debet'] ?></td>
                <td><?php echo $items['kredit'] ?></td>
                <td><?php echo $items['saldo_akhir'] ?></td>   
                <td><?php echo $items['created_at']; ?></td>

            </tr>
        <?php } ?>
        
    </tbody>
</table>
<?php } else { ?>
    <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
    <h1 style="margin-left: 30.5%">Data CR006-A Belum Ada</h1>
<?php }?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#tableOP001").dataTable();
    });
</script>