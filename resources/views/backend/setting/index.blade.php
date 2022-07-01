@extends('layouts.app')
@section('head')
<link rel="stylesheet" media="screen, print"
href="{{asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
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
   
    <div class="row">
        <div class="col-md-6">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        CR <span class="fw-300"><i> (Cash Ratio)</i></span>
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
                            (Modal Inti + Modal Pelengkap)/ATMR
                            
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="frame-wrap">
                                    <div class="showTable">
                                    </div>
                                    <table class="table table-bordered table-hover m-0" id="tableCr">
                                        <thead class="thead-themed">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode</th>
                                                <th>Nama Perkiraan</th>
                                                <th>Kode Perkiraan</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showCr">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
                            Kredit Kol 3, 4 dan 5 / Kredit yang diberikan
                        </div>
                        <div class="row">
                            <div class="col-12 mb-g">
                                <div class="frame-wrap">
                                    <table class="table table-bordered table-hover m-0" id="tableLdr">
                                        <thead class="thead-themed">
                                            <tr>
                                                <th>#</th>
                                                <th>Kode</th>
                                                <th>Nama Perkiraan</th>
                                                <th>Kode Perkiraan</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showLdr"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
<script src="{{asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script> 

 // input group layout 
    $(document).ready(function(){

        $('#tableLdr').dataTable(
        {
            responsive: true,
            fixedHeader: true,
            colReorder: true
        });
        
        $('#tableCr').dataTable(
        {
            responsive: true,
            fixedHeader: true,
            colReorder: true
        });

        getDataLdr();   
        getDataCr(); 
    })
    

    $("#formHitung").submit(function(e){
        e.preventDefault();
       
        var formData = new FormData(this);

        Swal.fire(
        {
            title: "Apakah yakin ingin hitung TKS?",
           
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya"
        }).then(function(result)
        {
            
            // if (result.value)
            // {
            //     $("#btnShow1").attr('disabled',true).text('Loading...');
            //     $.ajax({
            //         url: {{ env('APP_API') }} +'/',
            //         type: 'POST',
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         // data: formData,
            //         cache: false,
            //         contentType: false,
            //         processData: false,
            //         beforeSend: function(){
            //             var timerInterval;
                        Swal.fire(
                        {
                            title: "Silakan menunggu sedang proses menghitung..",
                            onBeforeOpen: function onBeforeOpen()
                            {
                                Swal.showLoading();
                                // timerInterval = setInterval(function()
                                // {
                                //     Swal.getContent().querySelector(
                                //         "strong"
                                //     ).textContent = Swal.getTimerLeft();
                                // }, 100);
                            },
                            onClose: function onClose()
                            {
                                clearInterval(timerInterval);
                            }
                        }).then(function(result)
                        {
                            if (
                                // Read more about handling dismissals
                                result.dismiss === Swal.DismissReason.timer
                            )
                            {
                                console.log("I was closed by the timer");
                            }
                        });
            //         },
            //         success: function(hasil) {

            //             console.log(hasil)
            //             //end step
            //             toastr.success('LPDU (1) Berhasil disimpan.',  'Info', { positionClass: 'toast-bottom-right', timeOut: 5000, "progressBar": true });
            //             $("#btnShow1").removeAttr('disabled',true).text('Hitung');
                        
            //         },
            //         error: function(err) {
            //             console.log(err)
            //             $("#btnShow1").removeAttr('disabled',true);
            //             toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });
            //         }
            //     });

                
            // }
        });

        $('.swal2-cancel').text('Tidak');

        // var tglpenilaian = $("input[name='tglpenilaian']").val();
    
        // Swal.fire(
        // {
        //     title: "Saya merekomendasikan agar aplikasi ini?",
        //     input: "select",
        //     inputOptions: {
        //         '4': 'Tidak',
        //         '5': 'Ya',
        //     },
        //     showCancelButton: true,
        //     confirmButtonText: "Simpan",
        //     showLoaderOnConfirm: true,
        //     preConfirm: function preConfirm(status)
        //     {

        //         $.ajax({
        //             url: 'store',
        //             type: 'POST',
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             data: formData,
        //             cache: false,
        //             contentType: false,
        //             processData: false,
        //             beforeSend: function(){
        //                 $("#btnShow1").attr('disabled',true).text('Loading...');
        //             },
        //             success: function(hasil) {

        //                 console.log(hasil)
        //                 //end step
        //                 toastr.success('LPDU (1) Berhasil disimpan.',  'Info', { positionClass: 'toast-bottom-right', timeOut: 5000, "progressBar": true });
        //                 $("#btnShow1").removeAttr('disabled',true).text('Simpan dan Lanjut');
                        
        //             },
        //             error: function(err) {
        //                 console.log(err)
        //                 $("#btnShow1").removeAttr('disabled',true);
        //                 toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });
        //             }
        //         });
            
        //     },
        //     allowOutsideClick: function allowOutsideClick()
        //     {
        //         return !Swal.isLoading();
        //     }
        // }).then(function(result)
        // {
        //     if (result.value)
        //     {
        //         $("#btnShow1").removeAttr('disabled',true).text('Simpan dan Lanjut');
        //         if ($('.show').next(".tab-pane").length) {
        //             console.log("oke oce");
        //             $('.show').removeClass('show active')
        //                 .next(".tab-pane")
        //                 .addClass('show active');
        //                 $('#lpduone').removeClass('active');
        //                 $('#lpdutwo').addClass('active');
        //         }
        //     }
        // });
    });



    function getDataLdr(){
        $.ajax({
            url: "http://localhost/bkc-restapi/public/api/getdataldr",
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            cache: false,
            async:false,
            contentType: false,
            processData: false,
            success: function(hasil) {

                console.log(hasil);
                var temp = "";
                var no = 1;
                hasil.data.forEach((itemData) => {
                    temp += "<tr>";
                    temp += "<td>" + no++ + "</td>";
                    temp += "<td>" + itemData.kode + "</td>";
                    temp += "<td>" + itemData.nama_perkiraan + "</td>";
                    temp += "<td>" + itemData.kode_perk + "</td>";
                    temp += "<td><a href='javascript:void(0);' class='btn btn-warning btn-icon waves-effect waves-themed'>"+
                                                        "<i class='fal fa-pencil'></i>"+
                                                    "</a></td></tr>";
                });
                document.getElementById('showLdr').innerHTML = temp;
                
            },
            error: function(err) {
             
                console.log(err)
                toastr.error('Koneksi jaringan internet terputus.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });

            }
        });
    }

    function getDataCr(){
        $.ajax({
            url: "http://localhost/bkc-restapi/public/api/getdatacr",
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            cache: false,
            async:false,
            contentType: false,
            processData: false,
            success: function(hasil) {

                console.log(hasil);
                var temp = "";
                var no = 1;
                hasil.data.forEach((itemData) => {
                    temp += "<tr>";
                    temp += "<td>" + no++ + "</td>";
                    temp += "<td>" + itemData.kode + "</td>";
                    temp += "<td>" + itemData.nama_perkiraan + "</td>";
                    temp += "<td>" + itemData.kode_perk + "</td>";
                    temp += "<td><a href='javascript:void(0);' class='btn btn-warning btn-icon waves-effect waves-themed'>"+
                                                        "<i class='fal fa-pencil'></i>"+
                                                    "</a></td></tr>";
                });
                document.getElementById('showCr').innerHTML = temp;
            },
            error: function(err) {
                console.log(err);
                toastr.error('Koneksi jaringan internet terputus.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
            }
        });
    }
        
</script>

@stop