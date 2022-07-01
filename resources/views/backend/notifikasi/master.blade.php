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
        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
        <li class="breadcrumb-item active">Transaksi Notification</li>
        <li class="breadcrumb-item active">Master Pesan</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Tabel <span class='fw-300'>Master Pesan</span> 
            <small>
                Tabel data master pesan.
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tabel<span class="fw-300"><i>Master Pesan</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0"
                                data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Collapse"><i class="fal fa-window-minimize"></i>
                        </button>
                        <button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0"
                                data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Fullscreen"><i class="fal fa-expand"></i>
                        </button>
                        <button class="btn btn-panel bg-transparent fs-xl w-auto h-auto rounded-0"
                                data-action="panel-close" data-toggle="tooltip" data-offset="0,10"
                                data-original-title="Close"><i class="fal fa-times"></i>
                        </button>
                    </div>
                </div>
                <input id="judul" type="hidden" value="master">  
                <div class="panel-container show ">
                    <div class="panel-content">
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="panel-toolbar ml-0 pb-3">
                                    <h5 class="m-12">
                                        <a id="resetModal" data-toggle="modal" data-target="#daftar" class="btn btn-success react-url">
                                            <i class="fal fa-plus"></i> <span class="hidden-mobile"> Tambah</span></a>
                                    </h5>
                                </div>
                                <div class="panel-tag">
                                    Lakukan pengecekan data dengan mencari data terlebih dahulu sebelum menambahkan.
                                </div>
                                <table class="table table-striped table-bordered" id="tabelHistoryTransaksiNotifSms">
                                    <thead>
                                        <tr class="table-primary">
                                            <th >No</th>
                                            <th >Kode Trans </th>
                                            <th >Keterangan</th>
                                            <th >Isi Pesan</th>
                                            <th> Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no=1)
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->kode_trans }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->isi_pesan }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning waves-effect waves-themed" data-toggle="tooltip" data-placement="top" data-animation="true" title="Edit" data-original-title="Edit" onclick="javascript:getModalEdit({{ $item->id }})">
                                                        <i class="fal fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Tabel Master --> 
            </div>
        </div>
    </div>
</main>


<!-- Modal Tambah Jaminan Tanah/Bangunan -->
<div class="modal fade " id="daftar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-right">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" enctype="multipart/form-data"  novalidate class="was-validated">
                    @csrf
                    <input class="form-control" name="id" id="id" type="hidden">
                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label" for="customControlValidation1">Kode Transaksi <span class="text-danger">*</span></label>
                            <select class="select2 form-control" name="kode" id="kode" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($kodetrans as $item)
                                    <option value="{{ $item->KODE_TRANS }}">{{ $item->KODE_TRANS." - ".$item->DESKRIPSI_TRANS }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Tolong pilh kode transaksi.
                            </div>                                            
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label" for="customControlValidation2">Keterangan <span class="text-danger">*</span></label>
                            <input class="form-control" name="keterangan" id="keterangan" type="text" required placeholder="keterangan">
                            <div class="invalid-feedback">
                                Tolong input keterangan.
                            </div>                                                                                 
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label" for="customControlValidation3">Isi Pesan <span class="text-danger">*</span></label>
                            <textarea rows="5" class="form-control" name="isi" id="isi" type="text" required placeholder="isi pesan"></textarea>
                            <div class="invalid-feedback">
                                Tolong input Nomor WhatApps.
                            </div>                                                                                 
                        </div>
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')

<script src="{{asset('assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script src="{{asset('assets/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
<script src="{{asset('assets/js/formplugins/select2/select2.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/notifikasi.js') }}"></script>

<script> 
    $(document).ready(function(){


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    })
        
</script>

@stop