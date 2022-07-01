<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabTransaksi extends Model
{
    use HasFactory;

    protected $connection   = "server";

    protected $table        = "calon_nasabah";

    public function masterpesan(){

        return $this->belongsTo(MasterPesan::class, 'KODE_TRANS', 'kode_trans');

    }

    // protected $fillable     = [
    //     'tabtrans_id',
    //     'TGL_TRANS',
    //     'NO_REKENING',
    //     'KODE_TRANS',
    //     'MY_KODE_TRANS',
    //     'POKOK',
    //     'ADM',
    //     'KUITANSI',
    //     'USERID',
    //     'KETERANGAN',
    //     'VERIFIKASI',
    //     'MODUL_ID_SOURCE',
    //     'TRANS_ID_SOURCE',
    //     'TOB',
    //     'PRINT_BUKU',
    //     'PRINT_KARTU',
    //     'TABTRANS_TAG',
    //     'SANDI_TRANS',
    //     'OTORISASI',
    //     'FLAG',
    //     'KODE_PERK_OB',
    //     'KODE_PERK_RAK',
    //     'NO_REKENING_VS',
    //     'POSTED_TO_GL',
    //     'KODE_KOLEKTOR',
    //     'kode_kantor',
    //     'counter_sign',
    //     'ADM_PENUTUPAN',
    //     'common_id',
    //     'TITIPAN_BUNGA',
    //     'jam',
    //     'ip_add' ,
    //     'flag_insentif',
    //     'flag_jt',
    //     'NPM',
    //     'FLAG_EXCEL',
    //     'institusion_id',
    //     'institusion_id_vs',
    //     'BUNGA_TAS',
    //     'PRINT_BUKU_RMB',
    //     'kode_pemb',
    //     'transfer' ,
    //     'no_slip' ,
    //     'KETERANGAN1' ,
    //     'online_kk',
    //     'online_id' ,
    //     'voucher_trans',
    //     'premi_trans',
    //     'pajak_trans',
    //     'insentif_trans',
    //     'return_bunga',
    //     'kode_group1_trans',
    //     'no_rekening_aba' ,
    //     'POINT',
    //     'no_rekening_abp' ,
    //     'SETORAN_KE' ,
    //     'biaya_trans',
    //     'kuitansi_id',
    //     'jam_trans',
    //     'kode_kantor_trans' ,
    //     'device_id',
    //     'tgl_real_trans' ,
    //     'issuerId' ,
    //     'echannel_trans_desc',
    //     'trans_id_ref',
    // ];
}
