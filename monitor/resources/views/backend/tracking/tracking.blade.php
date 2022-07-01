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
        <li class="breadcrumb-item active">Tracking Kredit</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-truck'></i> Tracking Nasabah Kredit
            <small>
                Tampilan Tracking Kredit.
            </small>
        </h1>
    </div>
    <div class="panel-content">
        <div class="panel-tag">
            Lakukan pengecekan data dengan no surat kredit.
        </div>
          <!-- Page heading removed for composed layout -->
        <div class="px-10 px-sm-5 pt-4">
            <h1 class="mb-4">
                {{-- 160 Results for "SmartAdmin WebApp" --}}
                Cek No Pengajuan Kredit
                <small class="mb-3">
                    Request time (0.23 seconds)
                </small>
            </h1>
            <div class="input-group input-group-lg mb-5 shadow-1 rounded">
                <input type="text" class="form-control shadow-inset-2" id="filter-icon" aria-label="type 2 or more letters" placeholder="Search anything..." value="">
                <div class="input-group-append">
                    <button class="btn btn-primary hidden-sm-down" type="button"><i class="fal fa-search mr-lg-2"></i><span class="hidden-md-down">Cari</span></button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Data</a>
                        <a class="dropdown-item" href="#">Images</a>
                        <a class="dropdown-item" href="#">Users</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item active" href="#">Everything</a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs nav-tabs-clean px-3 px-sm-5" role="tablist">
            <li class="nav-item">
                <a class="nav-link active bg-transparent fs-lg fw-400" data-toggle="tab" href="#tab-all" role="tab">All</a>
            </li>
        </ul>
        <div class="px-3 px-sm-5 pb-4">
            <div class="tab-content">
                <div class="tab-pane show active" id="tab-all" role="tabpanel" aria-labelledby="tab-all">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item py-4 px-4">
                                <div class="alert border-info bg-transparent text-secondary fade show" role="alert">
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon">
                                            <span class="icon-stack icon-stack-md">
                                                <i class="base-7 icon-stack-3x color-success-600"></i>
                                                <i class="fal fa-check icon-stack-1x text-white"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="h5 color-info-600">Proses Pengajuan Sudah Langkap</span>
                                            <br>
                                            Tanggal 02 Agustus 2021
                                        </div>
                                        <a class="btn btn-outline-info btn-sm btn-w-m waves-effect waves-themed">Review</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item py-4 px-4">
                                <div class="alert border-info bg-transparent text-secondary fade show" role="alert">
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon">
                                            <div class="alert-icon width-1">
                                                <i class="fal fa-sync fm-xl fa-spin"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <span class="h5 color-info-600">Proses Masih Proses Di Customer Services</span>
                                            <br>
                                            Tanggal 02 Agustus 2021
                                        </div>
                                        <a class="btn btn-outline-info btn-sm btn-w-m waves-effect waves-themed">Review</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item py-4 px-4">
                                <div class="alert border-danger bg-transparent text-secondary fade show" role="alert">
                                    <div class="d-flex align-items-center">
                                        <div class="alert-icon">
                                            <span class="icon-stack icon-stack-md">
                                                <i class="base-7 icon-stack-3x color-danger-900"></i>
                                                <i class="fal fa-times icon-stack-1x text-white"></i>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <span class="h5 color-info-600">Proses Masih Proses Di Customer Services</span>
                                            <br>
                                            Tanggal 02 Agustus 2021
                                        </div>
                                        <a class="btn btn-outline-danger btn-sm btn-w-m waves-effect waves-themed">Review</a>
                                    </div>
                                    
                                </div>
                            </li>                                            
                        </ul>
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
<script src="{{asset('assets/js/custom/kredit.js') }}"></script>
