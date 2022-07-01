@extends('layouts.app')
@section('head')
    <!-- base css -->
    {{-- <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/vendors.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/app.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">
     --}}
    <style>
        .select2-close-mask {
            z-index: 2099;
        }

        .select2-dropdown {
            z-index: 3051;
        }

        span.select2-container {
            z-index: 10050;
        }

    </style>
@endsection
@section('content')
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Laporan TKS</a></li>
        
    </ol>
   
    <div class="subheader">
        <h1 class="subheader-title">
            Aplikasi Penunjang Laporan TKS
            <small>
                Tingkat Kesehatn Bank <span class='fw-500 color-info-700'></span>
            </small>
        </h1>
    </div>
    <div class="alert alert-primary alert-dismissible">
        <form id="formHitung"   >
            <div class="form-row">
                <div class="form-group">
                    <label for="name" class="col-sm-12 control-label">Tanggal Transaksi</label>
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="date" class="form-control" name="tanggaltransaksi">   
                            <div class="input-group-append">
                                <span class="input-group-text fs-xl">
                                    <i class="fal fa-calendar-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="form-group">
                    <label for="name" class="col-sm-12 control-label">Kode Kantor</label>
                    <div class="col-sm-12">
                        <select name="kodekantor" class="form-control">
                            <option value="null">- Konsolidasi -</option>
                            @foreach($kantor as $item)
                            <option value="{{ $item->KODE_KANTOR }}">{{ $item->NAMA_KANTOR }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="name" class="col-sm-12 control-label">Perhitungan TKS</label>
                    <div class="col-sm-12">
                        <select id="carahitung" name="carahitung" class="form-control">
                            <option value="1">TKS BI</option>
                            <option value="2">TKS OJK</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-12 control-label"></label>
                    <button id="btnShow1" class="btn btn-primary btn-sm">Hitung</button>
                </div> 
                <div class="form-group">
                    <label for="name" class="col-sm-12 control-label"></label>
                    <button  class="btn btn-danger btn-sm"><span class="fal fa-print mr-1"></span>Export Report Konsolidasi</button>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-12 control-label"></label>
                    <a style="color: black" id="reset"  class="btn btn-warning btn-sm"><span class="fal fa-trash-alt mr-1"></span>Reset</a>
                </div>
            </div>
        </form>
       
    </div>
    <div class="row">
		<div class="col-xl-4">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        LDR <span class="fw-300"><i>(Loan to Deposit Ratio)</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                           (Kredit yang diberikan / Dana Pihak Ketiga)*100%
                            <br>
                            <p id="ldrRumus">(0 / 0) * 100 %</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g" style="background-color: orange;">
                                    <div class="">
                                        <h3 id="showldr" class="display-4 d-block l-h-n m-0 fw-500">
                                            0 %
                                            <small class="m-0 l-h-n">LDR</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                        <a style="background-color: #5D78E3;
                        border-color: #5D78E3;" href="#" id="printLdr"  class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan LDR
                        </a>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-xl-4">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Cash Ratio <span class="fw-300"><i></i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            (Alat Likuid / Kewajiban Lancar)*100%
                            <br>
                            <p id="crRumus">(0 / 0) * 100 %</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g" style="background-color: #8c3521;">
                                    <div class="">
                                        <h3 id="showcr" class="display-4 d-block l-h-n m-0 fw-500">
                                            0 %
                                            <small class="m-0 l-h-n">Cash Ratio</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                            
                        </div>
                        <a style="background-color: #5D78E3;
                        border-color: #5D78E3;" href="#" id="printCr"  class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan Cash Ratio
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        CAR <span class="fw-300"><i> (Capital Adequacy Ratio)</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            (Modal Inti/ATMR)*100%
                            <br>
                            <p id="carRumus">((0 + 0))/0) * 100 %</p>
                            <input type="hidden" id="modalinti" value="">
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g" style="background-color: #ea4d4d;">
                                    <div class="">
                                        <h3 id="showcar" class="display-4 d-block l-h-n m-0 fw-500">
                                            0 %
                                            <small class="m-0 l-h-n">Capital Adequacy Ratio</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-globe position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
                                </div>
                            </div>
                        </div>
                        <a style="background-color: #5D78E3;
                        border-color: #5D78E3;" href="#" id="printCar" class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan CAR
                        </a>
                        {{-- <a href="#" onclick="return false;" class="btn btn-switch m-0" data-action="toggle" data-class="header-function-fixed"></a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        NPL <span class="fw-300"><i>(Non Performaing Loan)</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            (Kredit Kol 3, 4 dan 5 / Kredit yang diberikan)*100%
                            <br>
                            <p id="roaRumus">(0 / 0) * 100 %</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            10%
                                            <small class="m-0 l-h-n">Non Performaing Loan</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                </div>
                            </div>
                          
                        </div>
                        <button  style="background-color: #5D78E3;
                        border-color: #5D78E3;" type="button" class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan NPL
                        </button>
                        {{-- <a href="#" onclick="return false;" class="btn btn-switch m-0" data-action="toggle" data-class="nav-function-fixed"></a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        ROA <span class="fw-300"><i>(Return On Assets)</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            (Pendapatan sebelum pajak / Asset)*100%
                            <br>
                            <p id="roaRumus">(0 / 0) * 100 %</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g" style="background-color: #439138;">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            80 %
                                            <small class="m-0 l-h-n">Return On Assets</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                            
                        </div>
                        <button style="background-color: #5D78E3;
                        border-color: #5D78E3;"  type="button" class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan ROA
                        </button>
                        {{-- <a href="#" onclick="return false;" class="btn btn-switch m-0" data-action="toggle" data-class="nav-function-fixed"></a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        KAP <span class="fw-300"><i>(Kualitas Aktiva Produktif)</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            (Aktiva Produktif yg diklasifikasikan/(Kredit yg diberikan + ABA))*100%
                            <br>
                            <p id="kapRumus">(0 / (0+0)) * 100 %</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g"> 
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g" style="background-color: #7f35b2;">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            80 %
                                            <small class="m-0 l-h-n">Kualitas Aktiva Produktif</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                        <button style="background-color: #5D78E3;
                        border-color: #5D78E3;"  type="button" class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan KAP
                        </button>
                        {{-- <a href="#" onclick="return false;" class="btn btn-switch m-0" data-action="toggle" data-class="nav-function-fixed"></a> --}}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        BOPO <span class="fw-300"><i>(Biaya Opr thd pendpt Opr)</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            (Biaya Operasional/Pendapatan)*100%
                            <p id="bopoRumus">(0 / 0) * 100 %</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g" style="background-color: #a89f1f;">
                                    <div class="">
                                        <h3  class="display-4 d-block l-h-n m-0 fw-500">
                                            0 %
                                            <small class="m-0 l-h-n">BOPO</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                        <button style="background-color: #5D78E3;
                        border-color: #5D78E3;"   type="button" class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan BOPO
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        PPAP <span class="fw-300"><i>(Pnysihan Pghapusn Aset Produktif)</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            (PPAP Wajib dibentuk / PPAP yg sdh dibentuk)*100%
                            <br>
                            <p id="ppapRumus">(0 / 0) * 100 %</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g" style="background-color: #2a151f;">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            80 %
                                            <small class="m-0 l-h-n">PPAP</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                        <button  style="background-color: #5D78E3;
                        border-color: #5D78E3;" type="button" class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan PPAP
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        ROE <span class="fw-300"><i>(Return On Equity)</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            (Pendapatan sblm pajak / Modal)*100% 
                            <br>
                            <p id="roeRumus">(0 / 0) * 100 %</p>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g" style="background-color: #26b39f;">
                                    <div class="">
                                        <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                            80 %
                                            <small class="m-0 l-h-n">ROE</small>
                                        </h3>
                                    </div>
                                    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                                </div>
                            </div>
                        </div>
                        <button style="background-color: #5D78E3;
                        border-color: #5D78E3;"  type="button" class="btn btn-danger btn-sm">
                            <span class="fal fa-print mr-1"></span>
                            Laporan ROE
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade " id="daftar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
            
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('assets/js/notifications/sweetalert2/sweetalert2.bundle.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom/car.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom/cr.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom/ldr.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom/reset.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom/print.js') }}"></script>
<script> 
	var url 		= "{{ env('APP_API') }}";
    var base_url 	= "{{ url('/') }}";
    // var swalWithBootstrapButtons = Swal.mixin(
    // {
    //     customClass:
    //     {
    //         confirmButton: "btn btn-primary",
    //         cancelButton: "btn btn-danger mr-2"
    //     },
    //     buttonsStyling: false
    // });
	$("input[name='tanggaltransaksi']").val('');
    $("#formHitung").submit(function(e){
        e.preventDefault();

        if($("input[name='tanggaltransaksi']").val() == null || $("input[name='tanggaltransaksi']").val() == ""){
           alert("Pilih Tanggal Transaksi dulu.");
           return false;
        }

        var formData = new FormData(this);
        
        Swal.fire(
        {
            title: "Apakah yakin ingin hitung TKS?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya",
            
        }).then(function(result)
        {
            if (result.value)
            {
                $("#btnShow1").attr('disabled',true).text('Loading...');
               
                //hitung 
                getCar(formData);  
                getCr(formData);
                getLdr(formData);
                      
            }
        });

        $('.swal2-cancel').text('Tidak');  
    });
    
</script>
@stop