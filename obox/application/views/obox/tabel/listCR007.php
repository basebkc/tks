<?php if(count($hasil)>0){ ?>
<table width="100%" class="table-bordered table-striped" id="tableCR007">
    <thead>
        <tr>
            <td  align="center"><i>No</i></td>
            <td>Flag</td>
            <td>Kode Jenis LJK</td>
            <td>Kode LJK</td>
            <td>Type</td>
            <td>Periode</td>
            <td>Total</td>
            <td>Waktu dibuat</td>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($hasil as $items) { ?>                    
            <tr>
                <td  align="center"><i><?php echo $no++; ?></i></td>
                <td><?php echo $items['kodejenisljk'] ?></td>
                <td><?php echo $items['flag_detail'] ?></td>
                <td><?php echo $items['kodeljk'] ?></td>
                <td><?php echo $items['typelaporan'] ?></td>
                <td><?php echo $items['periode'] ?></td>
                <td><?php echo $items['total'] ?></td>
                <td><?php echo $items['created_at'] ?></td>
            </tr>
        <?php } ?>
        
    </tbody>
</table>
<?php } else { ?>
    <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
    <h1 style="margin-left: 30.5%">Data CR007-A Belum Ada</h1>
<?php }?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#tableCR007").dataTable();
    });
</script>