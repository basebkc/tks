<?php if(count($hasil)>0){ ?>
<table width="100%" class="table-bordered table-striped" id="tableLQ003">
    <thead>
        <tr>
            <td align="center"><i>No</i></td>
            <td>Flag</td>
            <td>No CIF</td>
            <td>Nama Nasabah</td>
            <td>No Identitas</td>
            <td>Jenis DPK/<br>Simpanan Bank Lain</td>
            <td>Nominal</td>
            <td>No Rekening</td>
            <td>Jml Transaksi</td>
            <td>Keterangan</td>
            <td>Waktu Dibuat</td>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($hasil as $items) { ?>                    
            <tr>
                <td  align="center"><i><?php echo $no++; ?></i></td>
                <td><?php echo $items['flag_detail'] ?></td>
                <td><?php echo $items['no_cif'] ?></td>
                <td><?php echo $items['nama_nasabah'] ?></td>
                <td><?php echo $items['no_identitas'] ?></td>
                <td style="textalig"><?php echo $items['jenis_dpk'] ?></td>
                <td><?php echo $items['nominal'] ?></td>
                <td><?php echo $items['no_rekening'] ?></td>   
                <td><?php echo $items['jml_trx'] ?></td>   
                <td><?php echo $items['keterangan']; ?></td>
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
        $("#tableLQ003").dataTable();
    });
</script>
