<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kantor;
use Auth;
use GuzzleHttp\Client;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $user           = $user      =  'Nana';//Auth::user();
        
        $menutks        = "open";
        $menulikuid     = "open";
        $likuid         = 'active';
        $akses          = $user;
        // $namakantor =   Kantor::where('KODE_KANTOR','000')->first();
        $namakantor = "KPM";
       
        return view('backend.setting.index',compact('akses','menulikuid','menutks','namakantor','likuid'));
    }

    public function getdataldr(){
        $client = new Client;
        $headers = [
            'Content-Type' => 'application/json',
            'Accept'        => 'application/json'
        ];
        // dd(env('APP_API').'api/getdataldr');
        $response = $client->GET(env('APP_API').'api/getdataldr');

        
        if ($response->getStatusCode() == 200) { // 200 OKa
            $response_data = $response->getBody()->getContents();
            $response_data = json_decode($response_data);
            return Response::json($response_data,200);
        }
        return response('error',202);
    }


}
