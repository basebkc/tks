<?php

namespace App\Exports;

use App\Models\Tugas;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;

class TugasExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $tgl1, string $tgl2){
      
        $this->date1 = $tgl1;
        $this->date2 = $tgl2;
    }

    public function query() 
    {
         $data = Tugas::query()->join('tbl_kantor as cbg','cbg.kd_kan','=','tugas.cabang')
                ->leftJoin('kategori_tugas as kt','kt.id','=','tugas.kategori')
                ->select('tugas.*','kt.kategori as namakategori','cbg.n_kan')
                ->whereBetween('tugas.created_at',[$this->date1,$this->date2])
                ->orderBy('tugas.created_at','DESC')->get();
        //  $data = Tugas::join('tbl_kantor as cbg','cbg.kd_kan','=','tugas.cabang')
        //         ->leftJoin('kategori_tugas as kt','kt.id','=','tugas.kategori')
        //         ->select('tugas.*','kt.kategori as namakategori','cbg.n_kan')
        //         ->whereBetween('tugas.created_at',[$this->date1,$this->date2])
        //         ->orderBy('tugas.created_at','DESC')->get();
        return $data;
        // return view('backend.tugas.rptTugas',
        //     [
        //     'data' => $data
            
        //      ]
        // );
    }
}
