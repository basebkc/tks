<?php if(count($hasil)>0){ ?>
<table width="100%" class="table-bordered table-striped" id="tableOP002">
    <thead>
        <tr>
            <td  align="center"><i>No</i></td>
            <td>Flag</td>
            <td>No Cif</td>
            <td>Sandi Bank</td>
            <td>Lokasi<br>Bank</td>
            <td>No Rekening Bank</td>
            <td>Jenis</td>
            <td>Saldo<br>Awal</td>
            <td>Debet</td>
            <td>Kredit</td>
            <td>Saldo<br>Akhir</td>
            
            <td>Waktu Dibuat</td>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($hasil as $items) { ?>                    
            <tr>
                <td  align="center"><i><?php echo $no++; ?></i></td>
                <td><?php echo $items['flag_detail'] ?></td>
                <td><?php echo $items['no_cif'] ?></td>
                <td><?php echo $items['sandi_bank'] ?></td>
                <td><?php echo $items['lokasi_bank'] ?></td>
                <td><?php echo $items['no_rekening_bank_penempatan'] ?></td>
                <td><?php echo $items['jenis'] ?></td>
                <td><?php echo $items['saldo_awal'] ?></td>   
                <td><?php echo $items['debet']; ?></td>
                <td><?php echo $items['kredit']; ?></td>
                <td><?php echo $items['saldo_akhir']; ?></td>
                
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
        $("#tableOP002").dataTable();
    });
</script>