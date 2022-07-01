<?php if(count($hasil)>0){ ?>
<table width="100%" class="table-bordered table-striped" id="tableKolek">
    <thead>
        <tr>
            <td  align="center"><i>No</i></td>
            <td>Flag</td>
            <td>Kantor</td>
            <td>Nama</td>
            <td>Cif</td>
            <td>Nik</td>
            <td>Kode <br>Kelompok Kredit</td>
            <td>No Rek</td>
            <td>Jenis<br>Kredit</td>
            <td>Jenis<br>Debitur</td>
            <td>Sektor<br>Ekonomi</td>
            <td>Kategori<br>Usaha</td>
            <td>Suku<br>Bunga</td>
            <td>Perhitungan<br>Suku<br>Bunga</td>
            <td>Jumlah<br>Rekening</td>
            <td>Perubahan<br>Kualitas</td>
            <td>Tanggal<br>Perubahan</td>
            <td>Kualitas<br>Lama</td>
            <td>Kualitas<br>Baru</td>
            <td>Penyebab<br>Kualitas</td>
            <td>Plafond</td>
            <td>Baki<br>Debet</td>
            <td>Jenis<br>Agunan</td>
            <td>Nilai<br>Agunan</td>
            <td>Waktu Dibuat</td>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($hasil as $items) { ?>      
                       
            <tr>
                <td  align="center"><i><?php echo $no++; ?></i></td>
                <td><?php echo $items['flag_detail'] ?></td>
                <td><?php echo $items['kode_kantor'] ?></td>
                <td><?php echo $items['nama_nasabah'] ?></td>
                <td><?php echo $items['no_cif'] ?></td>
                <td><?php echo $items['nik'] ?></td>
                <td><?php echo $items['kode_kelompok_kredit'] ?></td>
                <td><?php echo $items['no_rekening'] ?></td>
                <td><?php echo $items['jenis_kredit'] ?></td>   
                <td><?php echo $items['jenis_debitur'] ?></td>   
                <td><?php echo $items['sektor_ekonomi']; ?></td>
                <td><?php echo $items['kategori_usaha']; ?></td>
                <td><?php echo number_format($items['suku_bunga'],2); ?></td>
                <td><?php echo $items['perhitungan_suku_bunga']; ?></td>
                <td><?php echo $items['jumlah_rekening']; ?></td>
                <td><?php echo $items['perubahan_kualitas']; ?></td>
                <td><?php echo $items['tanggal']; ?></td>
                <td><?php echo $items['kualitas_lama']; ?></td>
                <td><?php echo $items['kualitas_baru']; ?></td>
                <td><?php echo $items['penyebab_kualitas']; ?></td>
                <td><?php echo number_format($items['plafond'], 2); ?></td>
                <td><?php echo number_format($items['baki_debet'], 2); ?></td>
                <td><?php echo $items['jenis_agunan']; ?></td>
                <td><?php echo number_format($items['nilai_agunan'], 2); ?></td>
                <td><?php echo $items['created_at']; ?></td>

            </tr>
        <?php } ?>
        
    </tbody>
</table>
<?php } else { ?>
    <?php if($message != "") { ?>
        <h1 style="margin-left: 30.5%">Tanggal tidak boleh lebih dari 31 Hari</h1>
    <?php }else{?>
        <img style="margin-left: 20%" width="50%"  src="<?= base_url('assets/images/automa.png') ?>" alt="IMG">
         <h1 style="margin-left: 30.5%">Data Belum Ada</h1>

        <?php }?>
    
<?php }?>


<script type="text/javascript">
    $(document).ready(function () {
        $("#tableKolek").dataTable();
    });
</script>