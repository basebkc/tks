<?php if(count($hasil)>0){ ?>
<table width="100%" class="table-bordered table-striped" id="tableCR008">
    <thead>
        <tr>
            <td  align="center"><i>No</i></td>
            <td>Flag</td>
            <td>Kode Kantor OJK</td>
            <td>Nama</td>
            <td>Cif</td>
            <td>Nik</td>
            <td>Kode <br>Kelompok Kredit</td>
            <td>No Rek</td>
            <td>Jenis<br>Debitur</td>
            <td>Plafond<br>Sebelum</td>
            <td>Plafond<br>Sesudah</td>
            <td>Peningkatan<br>Penurunan<br>Plafond</td>
            <td>Baki<br>Debet<br>Sebelum</td>
            <td>Baki<br>Debet<br>Sesudah</td>
            <td>Penurunan<br>Baki<br>Debet</td>
            <td>Rek<br>Sebelum</td>
            <td>Rek<br>Sesudah</td>
            <td>Penyebab<br>Penurunan</td>
            
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($hasil as $items) { ?>                    
            <tr>
                <td  align="center"><i><?php echo $no++; ?></i></td>
                <td><?php echo $items['flag_detail'] ?></td>
                <td><?php echo $items['kd_kantor_ojk'] ?></td>
                <td><?php echo $items['nama_nasabah'] ?></td>
                <td><?php echo $items['no_cif'] ?></td>
                <td><?php echo $items['nik'] ?></td>
                <td><?php echo $items['kode_kelompok_kredit'] ?></td>
                <td><?php echo $items['no_rekening'] ?></td>
                <td><?php echo $items['jenis_debitur'] ?></td>   
                <td><?php echo number_format($items['plafond_sebelum'],2); ?></td>
                <td><?php echo number_format($items['plafond_sesudah'],2); ?></td>
                <td><?php echo number_format($items['peningkatan_penurunan_plafond'],2); ?></td>
                <td><?php echo number_format($items['baki_debet_sebelum'],2); ?></td>
                <td><?php echo number_format($items['baki_debet_sesudah'],2); ?></td>
                <td><?php echo number_format($items['penurunan_baki_debet'],2); ?></td>
                <td><?php echo number_format($items['rek_sebelum'],2); ?></td>
                <td><?php echo number_format($items['rek_sesudah'],2); ?></td>
                <td><?php echo number_format($items['penyebab_penurunan'], 2); ?></td>
            </tr>
        <?php } ?>
        
    </tbody>
</table>
<?php } else { ?>
    <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
    <h1 style="margin-left: 30.5%">Data CR008-A Belum Ada</h1>
<?php }?>


<script type="text/javascript">
    $(document).ready(function () {
        $("#tableCR008").dataTable();
    });
</script>