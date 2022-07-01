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
        <li class="breadcrumb-item active">Nasabah Pengajuan Tabungan</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Tabel <span class='fw-300'>Nasabah Pengajuan Tabungan</span> 
            <small>
                Tampilan tabel dari Nasabah Pengajuan Tabungan.
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Nasabah Pengajuan Tabungan <span class="fw-300"><i>Tabel</i></span>
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
                        <div class="panel-hdr">
                            <h2></h2>
                            <div class="panel-toolbar">
                                <h5 class="m-0"></h5>
                            </div>
                            <div class="panel-toolbar ml-0">
                                <h5 class="m-0">
                                   
                                    </h5>
                                </h5>
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                              
                                <table class="table table-striped table-bordered" id="tabelTabungan">
                                    <thead>
                                        <tr class="table-primary">
                                            <th >No</th>
                                            <th >Cabang</th>
                                            <th >Nama</th>
                                            <th >Nik</th>
                                            <th >Pekerjaan</th>
                                            <th >Permohonan Kredit</th>
                                            <th >Telepon</th>
                                            <th >Email</th>
                                            <th >Alamat</th>
                                            <th >Nilai Di Ajukan</th>
                                            <th >Tenor</th>
                                            <th >Agunan</th>
                                            <th >Tanggal Pengajuan</th>
                                            <th >Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no=1)
                                        @foreach($data ?? '' as $datas)
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $datas->n_kan }}</td>
                                            <td>{{ $datas->namalengkap }}</td>
                                            <td>{{ $datas->nik }}</td>
                                            <td>{{ $datas->pekerjaan }}</td>
                                            <td>{{ $datas->permohonan }}</td>
                                            <td>{{ $datas->telepon }}</td>
                                            <td>{{ $datas->email }}</td>
                                            <td>{{ $datas->alamat }}</td>
                                            <td>{{ $datas->nilaidiajukan }}</td>
                                            <td>{{ $datas->jangkawaktu." Bulan" }}</td>
                                            <td>{{ $datas->jaminan }}</td>
                                            <td>{{ $datas->created_at }}</td>
                                            <td>
                                                <a class="btn btn-success" href="{{ url('kredit/nasabah/edit/'.$datas->id) }}">
                                                    <i class="fas fa-edit"></i> 
                                                </a>
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
        </div>
    </div>
</main>


<!-- datatable end -->
<div class="modal fade" id="pilihtambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lx" role="document" style="max-width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cek Debitur </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-content">
                    <form id="formAdd" class="smart-form" novalidate="novalidate">
                        @csrf
                        <div class="form-row">
                            <input type="hidden" name="step" id="step" value="0">
                            <div class="col-md-12 mb-3">
                                <div class="border-faded bg-faded p-3 mb-g d-flex">

                                    <input oninput="this.value" type="text"
                                           id="js-filter-contacts" name="filter-contacts"
                                           class="form-control shadow-inset-2 form-control-lg"
                                           placeholder="Search Debtor">
                                    <button type="submit" class="btn btn-primary"
                                            style="display: none;">
                                        Search
                                    </button>
                                        <div class="btn-group btn-group-lg btn-group-toggle ml-4">
                                                <div class="demo">
                                                    <div
                                                        class="custom-control custom-radio custom-radio-rounded">
                                                        <input type="radio"
                                                            class="custom-control-input"
                                                            id="filter-name" value="1"
                                                            name="filter" checked="">
                                                        <label class="custom-control-label"
                                                            for="filter-name">Nama</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-radio custom-radio-rounded">
                                                        <input type="radio"
                                                            class="custom-control-input"
                                                            id="filter-id" value="2"
                                                            name="filter">
                                                        <label class="custom-control-label"
                                                            for="filter-id">KTP</label>
                                                    </div>
                                                </div>
                                            
                                                
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning resetsearch">
                                Reset
                            </button>
                            <button id="close" type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Close
                            </button>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- boostrap company model -->
<div class="modal fade" id="company-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title" id="CompanyModal"></h4></div>
                <div class="modal-body">
                <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Jenis</label>
                        <div class="col-sm-12">
                            <select name="jenis" class="form-control">
                                <option value="Potong Gaji PNS/HONOR">Potong Gaji PNS/HONOR (kredit)</option>
                                <option value="Sertifikasi">Sertifikasi (kredit)</option>
                                <option value="SILTap">SILTap (kredit)</option>
                                <option value="TPP">TPP (kredit)</option>
                                <option value="Perdagangan Umum">Perdagangan Umum (kredit)</option>
                                <option value="Kepincut Pasar">Kepincut Pasar (kredit)</option>
                                <option value="Deposito">Deposito (deposito)</option>
                            </select>
                            
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Produk</label>
                        <div class="col-sm-12">
                            {{-- <input type="text" class="form-control" id="produk" name="produk" placeholder="Masukan nama produk" maxlength="50" required=""> --}}
                            <select name="produk" class="form-control">
                                <option value="kredit">Kredit</option>
                                <option value="deposito">Deposito</option>
                                <option value="tabungan">Tabungan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Suku Bunga</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="sukubunga" name="sukubunga" placeholder="Masukan suku bunga" maxlength="50" required="">
                        </div>
                    </div>                    
                    
                    
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                    </form>
                </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
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