@extends('layouts.app')

@section('head')
    <link rel="stylesheet" media="screen, print"
          href="{{asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
          href="{{asset('assets/css/formplugins/select2/select2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/fa-solid.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/fa-brands.css') }}">
    
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
        <li class="breadcrumb-item"><a href="javascript:void(0);">Management Notification</a></li>
        <li class="breadcrumb-item active">Notifikasi Tabungan</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Tabel <span class='fw-300'>Notifikasi Tabungan</span> 
            <small>
                List notifikasi pesan dari transaksi tabungan.
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                       <span class="fw-300"><i>Tabel</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0"
                                data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Collapse"><i class="fal fa-window-minimize"></i></button>
                        <button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0"
                                data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Fullscreen"><i class="fal fa-expand"></i></button>
                        <button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0"
                                data-action="panel-close" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Close"><i class="fal fa-times"></i></button>
                    </div>
                </div>
                
                <input id="judul" type="hidden" value="tabungan">  
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-hdr">
                            <h2></h2>
                            <div class="panel-toolbar">
                                <h5 class="m-0"></h5>
                            </div>
                            <div class="panel-toolbar ml-0">
                                <h5 class="m-0">
                                    {{-- <button class="btn btn-warning" onclick="javascript:getModalEdit({{ $item->id }})" id="{{ $item->id }}"><i class="fal fa-plus"></i> Tambah Mutasi</button> --}}
                                 
                                    <h5 class="m-0">
                                        <a onclick="javascript:sendNotification()"  class="btn btn-success react-url">
                                            <i class="fa fa-envelope"></i> Example Send </a>
                                    </h5>


                                  
                                </h5>
                            </div>
                        </div>
                        <br/>
                        
                        <!-- datatable start -->
                        
                        <table id="dt-tabtrans" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Transaksi</th>
                                    <th>No Rekening</th>
									<th>Kode Transaksi</th>
                                    <th>Nama Rekening</th>
									<th>Waktu</th>
									<th>Nominal</th>
                                    <th>Status Terkirim</th>
                                    <th>Waktu Terkirim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftar as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tabtrans_id }}</td>
                                        <td>{{ $item->no_rekening }}</td>
                                        <td>{{ $item->kode_trans }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jam_trans }}</td>
										<td>{{ $item->nominal }}</td>
                                        @if($item->status_terkirim == 'Message Sent!')
                                        <td class="bg-success-100">
                                            {{ $item->status_terkirim }}
                                        </td>
                                        @else
                                        <td class="bg-danger-100">
                                            {{ $item->status_terkirim }}
                                        </td>
                                        @endif
                                        <td>{{ date('Y-m-d h:i:s',strtotime($item->created_at)) }}</td>
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
@section('scripts')

<script src="{{asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script src="{{asset('assets/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
<script src="{{asset('assets/js/formplugins/select2/select2.bundle.js')}}"></script>
<script src="{{asset('assets/js/dependency/moment/moment.js') }}"></script>
<script src="{{asset('assets/js/custom/notifikasi.js') }}"></script>

<script>

    function sendNotification(){

        $.ajax({

            type:'POST',
            url: "{{ url('notifikasi/exampleTransaksiTabungan')}}",
            cache:false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){

                console.log(data.message.msg);
                toastr.success('Data berhasil disimpan.',  'Info', 
                    { positionClass: 'toast-top-center', timeOut: 5000 }
                );
                // var oTable = $('#dt-transaksi').dataTable();
                //     oTable.fnDraw(false);


            },
            error: function(error){
                console.log(error)
                toastr.error('Data gagal disimpan.',  'Error', 
                    { positionClass: 'toast-top-center', timeOut: 3000 }
                );
            }

        });

    }


    // function getDataTabTransaksi(){


    //     $.ajax({
    //             type:'GET',
    //             url: "{{ url('notifikasi/getDataTabTransaksi')}}",
    //             cache:false,
    //             contentType: false,
    //             processData: false,
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             success: function(data){

    //                 console.log(data);

    //             },

    //             error: function(error){
    //                 console.log(error)
    //                 toastr.error('Data gagal disimpan.',  'Error', 
    //                     { positionClass: 'toast-top-center', timeOut: 3000 }
    //                 );
    //             }

    //         });

    // }

    $(document).ready(function(){

        // fetch_data();

        // function fetch_data()
        // {
        // var dataTable = $('#dt-tabtrans').DataTable({
        //     "processing" : true,
        //     "serverSide" : true,
        //     "order" : [],
        //     "ajax" : {
        //         type:'POST',
        //         url: "{{ url('notifikasi/getDataLogTabTrans')}}",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //     }
        // });
        // }
    })
        
</script>

@stop