<!DOCTYPE html>
<html>
<head>
    <title>Laporan TKS</title>
</head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<body style="font-family: Arial, Helvetica, sans-serif ">
   
    <img src="{{ url('assets/img/logo.png') }}" width="200" height="70"> 
    <br>
    <h6 style="margin-top: 0px">{{ $bank }}<br>{{ $alamat }}</h6>
    <hr style="height:1px; border:none; color:#000; background-color:#000;"> 
    <p style="text-align: center; font-weight: bold;">{{ $laporan }}
        <p style="text-align: center;font-size: 10px;font-weight: bold;">{{ $cabang }}</p>
        <p style="text-align: center;font-size: 10px;font-weight: bold;">Per : {{ $tanggallaporan }}</p>
    </p>
    <br>
    <div style="width: 100%;padding-bottom: 2px">MODAL INTI</div>
    <table style="font-size: 12px; width: 100%;">
            <tr>
                <th style="width: 80%">KETERANGAN</th>
                <th>JUMLAH</th>
            </tr>
            @php($modal=0)
            @foreach($data as $item)
            @if(preg_match("/10/i", $item->kode) && $item->kode != "100")
            <tr>
                <td>{{ $item->nama_perkiraan }}</td>
                <td style="text-align: right">{{ number_format($item->jumlah,"2",".",".") }}</td>
            </tr>
            
            @endif
            @if($item->kode == "100")
            @php($modal = $item->jumlah)
            @endif
            @endforeach
            <tr>
                <th style="width: 80%">JUMLAH MODAL INTI</th>
                <th style="text-align: right">{{ number_format($modal,"2",".",".") }}</th>
            </tr>
            
    </table>
    {{-- <div style="width: 100%;padding-bottom: 2px;padding-top: 20px">HUTANG LANCAR</div> --}}
    {{-- <table style="font-size: 12px; width: 100%;">
            <tr>
                <th style="width: 80%">KETERANGAN</th>
                <th>JUMLAH</th>
            </tr>
            @php($hutanglancar=0)
            @foreach($data as $item)
            @if(preg_match("/20/i", $item->kode) && $item->kode != "200")
            <tr>
                <td>{{ $item->nama_perkiraan }}</td>
                <td style="text-align: right">{{ number_format($item->jumlah,"2",".",".") }}</td>
            </tr>
            @endif
            @if($item->kode == 200)
            @php($hutanglancar = $item->jumlah)
            @endif
            @endforeach
            <tr>
                <th style="width: 80%">JUMLAH</th>
                <th style="text-align: right">{{ number_format($hutanglancar,"2",".","."), }}</th>
            </tr>
    </table> --}}
    <br>
    {{-- <table style="font-size: 12px; width: 100%;padding-top: 20px">
        <tr >
            <th rowspan="2">CR</th>
            <th rowspan="2">=</th>
            <th style="border-bottom: 1px solid ">Alat Likuid</th>
            <th rowspan="2">=</th>
            <th style="border-bottom: 1px solid ">{{ number_format($modal,"2",".",".") }}</th>
            <th rowspan="2">=</th>
            <th rowspan="2">{{ number_format(($modal/0)*100,"2",".",".") }}%</th>

        </tr>
        <tr >
            <th>Hutang Lancar</th>
            <th>{{ number_format($hutanglancar,"2",".",".") }}</th>
        </tr>
       
    </table> --}}
</body>
</html>