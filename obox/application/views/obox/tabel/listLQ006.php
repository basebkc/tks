<?php if(count($hasil)>0){ ?>
<table width="100%" class="table-bordered table-striped" id="tableLQ006">
    <thead>
        <tr>
            <td  align="center"><i>No</i></td>
            <td>Flag</td>
            <td>Periode</td>
            <td>Kredit kpd Bank lain dari 3 Bulan</td>
            <td>Kredit kpd Pihak Ke 3 Bukan Bank</td>
            <td>Jumlah Kredit yg diberikan</td>
            <td>Simpanan Pihak Ketiga</td>
            <td>Pinjaman Dari Bank Indonesia</td>
            <td>Deposito dari Bank lain > 3 bln</td>
            <td>Pinjaman dari Bank lain > 3 bln</td>
            <td>Pinjaman yg diterima dari pihak ke 3 bukan bank > 3 bln</td>
            <td>Pinjaman yg dapat diperhitungkan sbg modal inti tambahan s.d 3 bln</td>
            <td>Modal Inti</td>
            <td>Jumlah Komponen Dana</td>
            <td>LDR</td>
            <td>Waktu Dibuat</td>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($hasil as $items) { ?>                    
            <tr>
                <td  align="center"><i><?php echo $no++; ?></i></td>
                <td><?php echo $items['flag_detail'] ?></td>
                <td><?php echo $items['periode'] ?></td>
                <td><?php echo number_format($items['kyd_bank_lain'],0) ?></td>
                <td><?php echo number_format($items['kyd_nasabah'],0) ?></td>
                <td><?php echo number_format($items['jml_kyd'],0) ?></td>
                <td><?php echo number_format($items['dpk'],0) ?></td>
                <td><?php echo number_format($items['kyd_bi'],0) ?></td>   
                <td><?php echo number_format($items['abp_dep'],0) ?></td>   
                <td><?php echo number_format($items['abp_kyd'],0) ?></td>
                <td><?php echo number_format($items['abp_bukan_bank'],0) ?></td>
                <td><?php echo number_format($items['abp_modal'],0) ?></td>
                <td><?php echo number_format($items['modal_inti'],0) ?></td>
                <td><?php echo number_format($items['jml_dana'],0) ?></td>
                <td><?php echo number_format($items['ldr'],2); ?></td>
                
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
        $("#tableLQ006").dataTable();
    });
</script>
