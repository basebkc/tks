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
        <li class="breadcrumb-item active">Nasabah Kredit Online</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Tabel <span class='fw-300'>Daftar Nasabah</span> 
            <small>
                Pendaftaran notifikasi pesan dari transaksi.
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr bg-primary-700 bg-success-gradient">
                    <h2>
                       Daftar Nasabah<span class="fw-300"><i>Tabel</i></span>
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
                
                <input id="judul" type="hidden" value="daftarnasabah">  
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
                        <table class="table table-bordered table-hover table-striped w-100" id="tabelTabungan">
                            <thead class="thead-dark">
                                <tr class="table-primary">
                                    <th>Kode Kantor</th>
                                    <th>No Rekening</th>
                                    <th>No HP</th>
									<th>Nama Rekening</th>
                                    <th>No WhatApps</th>
                                    <th style="text-align: center;">Status WhatApps</th>
                                    <th>Status SMS</th>
                                    <th>Expired</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->kode_kantor }}</td>
                                        <td>{{ $item->no_rekening }}</td>
										 <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->no_wa }}</td>
                                        <td>
                                            @if($item->status_wa == "on")
                                                <span class="badge badge-success badge-pill">Aktif</span>
                                            @else
                                                <span class="badge badge-danger badge-pill">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status_sms == "on")
                                            <span class="badge badge-success badge-pill">Aktif</span>
                                            @else
                                                <span class="badge badge-danger badge-pill">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ date('Y-m-d',strtotime($item->tgl_aktif)) ." sampai ". date('Y-m-d',strtotime($item->tgl_akhir)) }}
                                        </td>
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
    </div>
</main>


<!-- modal -->
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
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="customControlValidation1">No Rekening <span class="text-danger">*</span></label>
                            <input class="form-control" name="no_rekening" id="no_rekening" type="text" required placeholder="Nomor Rekening">
                            <div class="invalid-feedback">
                                Tolong input Nomor Rekening.
                            </div>                                            
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="customControlValidation2">No Handphone <span class="text-danger">*</span></label>
                            <input class="form-control" name="no_phone" id="no_phone" type="text" required placeholder="Nomor Handphone">
                            <div class="invalid-feedback">
                                Tolong input Nomor Handphone.
                            </div>                                                                                 
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="customControlValidation3">No WhatApps <span class="text-danger">*</span></label>
                            <input class="form-control" name="no_wa" id="no_wa" type="text" required placeholder="Nomor WhatApps">
                            <div class="invalid-feedback">
                                Tolong input Nomor WhatApps.
                            </div>                                                                                 
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="customControlValidation3">Kirim WhatApps<span class="text-danger"></span></label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status_wa" name="status_wa">
                                <label class="custom-control-label" for="status_wa"></label>
                            </div>
                            <div class="invalid-feedback">
                                Tolong input Nomor WhatApps.
                            </div>                                                                                 
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="customControlValidation3">Kirim SMS<span class="text-danger"></span></label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status_sms" name="status_sms">
                                <label class="custom-control-label" for="status_sms"></label>
                            </div>
                            <div class="invalid-feedback">
                                Tolong input Nomor WhatApps.
                            </div>                                                                                 
                        </div>
                       
                        {{-- <div class="col-md-12 mb-2">
                            <label class="form-label" for="customControlValidation4">Tanggal Aktif <span class="text-danger">*</span></label>
                            <input class="form-control tanggal" id="tgl_aktif" name="tgl_aktif" type="text" placeholder="Tanggal Aktif" required>
                            <div class="invalid-feedback">
                                Pilih tanggal aktif.
                            </div>                                                                                  
                        </div>

                        
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="customControlValidation4">Tanggal Expired <span class="text-danger">*</span></label>
                            <input class="form-control tanggal" id="tgl_akhir" name="tgl_akhir" type="text" placeholder="Tanggal Expired" required>
                            <div class="invalid-feedback">
                                 Pilih tanggal akhir.
                            </div>                                                                                  
                        </div> --}}
                        
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="customControlValidation7">Keterangan<span class="text-danger">*</span></label>
                            <input class="form-control" name="keterangan" id="keterangan" type="text" placeholder="Keterangan">
                            <div class="invalid-feedback">
                                Tolong input Keterangan.
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
<script src="{{asset('assets/js/dependency/moment/moment.js') }}"></script>
<script src="{{asset('assets/js/custom/notifikasi.js') }}"></script>

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
           
             scrollY: 400,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            //fixedColumns:   true,
            fixedColumns:
            {
                leftColumns: 2
            },
        });
    })
        
</script>

@stop