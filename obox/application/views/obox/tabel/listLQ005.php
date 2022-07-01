<?php if(count($hasil)>0){ ?>
<table width="100%" class="table-bordered table-striped" id="tableLQ005">
    <thead>
        <tr>
            <td  align="center"><i>No</i></td>
            <td>Flag</td>
            <td>Periode</td>
            <td>Kas</td>
            <td>Giro</td>
            <td>Selisih</td>
            <td>Tab_ABA</td>
            <td>Tab Bank<br>ABP</td>
            <td>Tab BPR<br>ABP</td>
            <td>Jumlah Likuid</td>
            <td>Kewajiban<br>Segera</td>
            <td>Tabungan DPK</td>
            <td>Deposito DPK</td>
            <td>Jumlah<br>Kewajiban</td>
            <td>Cash Rasio</td>
            <td>Waktu Dibuat</td>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($hasil as $items) { ?>                    
            <tr>
                <td  align="center"><i><?php echo $no++; ?></i></td>
                <td><?php echo $items['flag_detail'] ?></td>
                <td><?php echo $items['periode'] ?></td>
                <td><?php echo number_format($items['kas'],0) ?></td>
                <td><?php echo number_format($items['giro'],0) ?></td>
                <td><?php echo number_format($items['selisih'],0) ?></td>
                <td><?php echo number_format($items['tab_aba'],0) ?></td>
                <td><?php echo number_format($items['tab_bank_abp'],0) ?></td>   
                <td><?php echo number_format($items['tab_bpr_abp'],0) ?></td>   
                <td><?php echo number_format($items['jml_likuid'],0) ?></td>
                <td><?php echo number_format($items['kewajiban_segera'],0) ?></td>
                <td><?php echo number_format($items['tab_dpk'],0) ?></td>
                <td><?php echo number_format($items['dep_dpk'],0) ?></td>
                <td><?php echo number_format($items['jml_kewajiban'],0) ?></td>
                <td><?php echo number_format($items['cash_ratio'],2) ?></td>
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
        $("#tableLQ005").dataTable();
    });
</script>
