<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


class ReportController extends Controller
{
    public function ldrpdf($tgl,$kodekantor,$carahitung){
        
		$client = new \GuzzleHttp\Client();
		
		$apiURL = env('APP_API').'api/getldr';
		
        $headers = [
            'Content-Type' => 'application/json',
            'Accept'        => '*/*'
        ];

        $body = [
            'tanggaltransaksi' => $tgl,
            'kodekantor' => $kodekantor,
            'carahitung' => $carahitung
        ]; 
	
        
		$response = Http::withHeaders($headers)->post(env('APP_API').'api/getldr', 
            $body
        );
		
		if ($response->getStatusCode() == 200) { 
            $response_data = json_decode($response->body());
			
			$data = $response_data;
        }
		else{
			$data = ""; //$response_data = $response_data->push((object)['data' => '']);
		}
		
        $result = [
            'bank' => 'PERUMDA BPR KABUPATEN CIREBON',
            'alamat' => 'Babakan Gebang No. 112, Babakan Gebang',
            'laporan' => 'LAPORAN TKS LDR',
            'tanggallaporan' => date('d M Y',strtotime($tgl)),
            'data' => $data,
            'cabang' => $this->kantor($kodekantor)
        ];
        
        
        // return view('backend.report.reportldr', $data);
        $pdf = PDF::loadView('backend.report.reportLdr', $result);
     
        return $pdf->download('ldr_'.date('Y_m_d').'.pdf');
    }

    public function crpdf($tgl,$kodekantor,$carahitung){
        
        $headers = [
            'Content-Type' => 'application/json',
            'Accept'        => 'application/json'
        ];

        $body = [
            'tanggaltransaksi' => $tgl,
            'kodekantor' => $kodekantor,
            'carahitung' => $carahitung
        ]; 
		
		
        $response = Http::withHeaders($headers)
				->post('191.177.192.5:8074/bkc-restapi/public/api/getcr', 
					$body
				);
		
        if ($response->getStatusCode() == 200) { 
            $response_data = json_decode($response->body());
			$data = $response_data;
        }else{
			$data = "";
		}
       
        $data = [
            'bank' => 'PERUMDA BPR KABUPATEN CIREBON',
            'alamat' => 'Babakan Gebang No. 112, Babakan Gebang',
            'laporan' => 'LAPORAN TKS CASH RATIO',
            'tanggallaporan' => date('d M Y',strtotime($tgl)),
            'data' => $data,
            'cabang' => $this->kantor($kodekantor)
        ];

        
        // return view('backend.report.reportldr', $data);
        $pdf = PDF::loadView('backend.report.reportcr', $data);
     
        return $pdf->download('cr_'.date('Y_m_d').'.pdf');
    }


    public function carpdf($tgl,$kodekantor,$carahitung){
        
        $headers = [
            'Content-Type' => 'application/json',
            'Accept'        => 'application/json'
        ];

        $body = [
            'tanggaltransaksi' => $tgl,
            'kodekantor' => $kodekantor,
            'carahitung' => $carahitung
        ]; 


        $response = Http::post(env('APP_API').'api/getcar', 
            $body
        );

        if ($response->getStatusCode() == 200) { 
            $response_data = json_decode($response->body());
        }
       
        $data = [
            'bank' => 'PERUMDA BPR KABUPATEN CIREBON',
            'alamat' => 'Babakan Gebang No. 112, Babakan Gebang',
            'laporan' => 'LAPORAN TKS CAR',
            'tanggallaporan' => date('d M Y',strtotime($tgl)),
            'data' => $response_data->data,
            'cabang' => $this->kantor($kodekantor)
        ];

        
        // return view('backend.report.reportldr', $data);
        $pdf = PDF::loadView('backend.report.reportcar', $data);
     
        return $pdf->download('cr_'.date('Y_m_d').'.pdf');
    }


    function kantor($kantor){
        if($kantor == "null"){
            $cabang = "Konsole";
        }elseif($kantor == "000"){
            $cabang = "KANTOR PUSAT MANAJEMEN";
        }elseif($kantor == "001"){
            $cabang = "KANTOR PUSAT OPERASIONAL";
        }elseif($kantor == "002"){
            $cabang = "CABANG SUMBER";
        }elseif($kantor == "003"){
            $cabang = "CABANG SUSUKAN";
        }elseif($kantor == "004"){
            $cabang = "CABANG PLUMBON";
        }elseif($kantor == "005"){
            $cabang = "CABANG CIREBON BARAT";
        }elseif($kantor == "006"){
            $cabang = "CABANG CIREBON UTARA";
        }elseif($kantor == "007"){
            $cabang = "CABANG KARANGSEMBUNG";
        }elseif($kantor == "008"){
            $cabang = "CABANG LEMAHABANG";
        }elseif($kantor == "009"){
            $cabang = "CABANG ARJAWINANGUN";
        }elseif($kantor == "010"){
            $cabang = "CABANG PALIMANAN";
        }elseif($kantor == "011"){
            $cabang = "CABANG WERU";
        }elseif($kantor == "012"){
            $cabang = "CABANG WALED";
        }

        return $cabang;
    }
}
