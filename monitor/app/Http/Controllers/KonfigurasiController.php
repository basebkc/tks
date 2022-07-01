<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konfigurasi;
use Carbon\Carbon;
use Auth;
use App\Models\Kantor;


class KonfigurasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   = Konfigurasi::get();
        $akses   = Auth::user();
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();

        
        $title  = "Konfigurasi";
        return view('backend.konfigurasi.list',compact('data','title','akses','namakantor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Konfigurasi::updateOrCreate(
            [ 
                'id' => $request->id 
            ],
            [
                'kode'          => $request->kode,
                'nosender'      => $request->nosender,
                'isi'           => $request->isi,
                'keterangan'    => $request->keterangan,
                'updated_at'    => Carbon::now()
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data  = Konfigurasi::find($id);
        
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
