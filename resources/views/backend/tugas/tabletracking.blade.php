@extends('layouts.app')

@section('head')
    <link rel="stylesheet" media="screen, print"
          href="{{asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
          href="{{asset('assets/css/formplugins/select2/select2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/fa-solid.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/fa-brands.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/filepond/filepond.css') }}">
    
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
        <li class="breadcrumb-item"><a href="javascript:void(0);">TUGAS</a></li>
        <li class="breadcrumb-item active">Tabel</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
   
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        TRACKING <span class="fw-300"><i>Tabel</i></span>
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
               
                <div class="panel-container show ">
                    <div class="panel-content">
                        
                        <div class="panel-container show">
                            <div class="panel-content">
                              
                                <table class="table table-striped table-bordered" id="tabelTabungan">
                                    <thead>
                                        <tr class="table-primary">
                                            <th >No</th>
                                            <th >No Pengajuan Tugas </th>
                                            <th>Status</th>
                                            <th >Tgl Perubahan</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no=1)
                                        @foreach ($data as $item)
                                        
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <th >{{ $item->nopengajuantugas }} </th>
                                               
                                                <td>
                                                    @if($item->status == "0")
                                                    <button type="button" class="btn btn-xs btn-danger waves-effect waves-themed">Pending</button>
                                                    @elseif($item->status == "1")
                                                    <button type="button" class="btn btn-xs btn-warning waves-effect waves-themed">Progress</button>
                                                    @elseif($item->status == "2")
                                                    <button type="button" class="btn btn-xs btn-warning waves-effect waves-themed">Revisi</button>
                                                    @elseif($item->status == "3")
                                                    <button type="button" class="btn btn-xs btn-info waves-effect waves-themed">Review</button>
                                                    @else
                                                    <button type="button" class="btn btn-xs btn-success waves-effect waves-themed">Done</button>
                                                    @endif
                                                   
                                                </td>
                                                <th >{{ $item->created_at }} </th>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
<script> 
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
     
        // initialize datatable
        $('#tabelTabungan').dataTable(
        {
            responsive: true,
        });

    })
</script>
@stop