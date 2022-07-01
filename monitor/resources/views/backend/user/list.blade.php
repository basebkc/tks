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
        <li class="breadcrumb-item active">User Management</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-table'></i> Tabel <span class='fw-300'>User</span> 
            <small>
                Tampilan tabel dari User.
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr bg-primary-700 bg-info-gradient">
                    <h2>
                        User <span class="fw-300"><i>Tabel</i></span>
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
                <input id="judul" type="hidden" value="User">  
                <div class="panel-container show ">
                    <div class="panel-content">
                        <div class="panel-hdr">
                            <h2></h2>
                            <div class="panel-toolbar">
                                <h5 class="m-0"></h5>
                            </div>
                            <div class="panel-toolbar ml-0">
                                <h5 class="m-0">
                                    <h5 class="m-0">
                                        <a id="resetModal" data-toggle="modal" data-target="#pilih" class="btn btn-success react-url"><i
                                                class="fal fa-plus"></i><!-- react-text: 54 --><!-- /react-text --><span
                                                class="hidden-mobile"> Daftar User</span></a>
                                    </h5>
                                </h5>
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                
                                <table class="table table-striped table-bordered" id="tabelUser">
                                    <thead>
                                        <tr class="table-primary">
                                            <th >No</th>
                                            <th >Nama</th>
                                            <th >Email</th>
                                            <th >Kantor Cabang</th>
                                            <th >Role</th>
                                            <th >Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no=1)
                                        @foreach($user ?? '' as $datas)
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $datas->name }}</td>
                                            <td>{{ $datas->email }}</td>
                                            <td>{{ $datas->kode_kantor }}</td>
                                            <td>@if($datas->role_id == 1) {{ "Admin" }} @else {{ "User" }} @endif</td>
                                            <td>
                                                <button type="button" class="btn-xs btn-warning waves-effect waves-themed" data-toggle="tooltip" data-placement="top" data-animation="true" title="Edit" data-original-title="Edit" onclick="javascript:getModalEditUser({{ $datas->id }})">
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
        </div>
    </div>
</main>


<!-- Modal Tambah -->
<div class="modal fade " id="pilih" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-right">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUser" enctype="multipart/form-data" novalidate class="was-validated">
                    @csrf
                    <input class="form-control" name="id" id="id" type="hidden">
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="name" value="{{ __('Name') }}">Nama <span class="text-danger">*</span></label>
                            <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="masukan nama"/>
                            <div class="invalid-feedback">
                                Tolong pilih name.
                            </div>                                            
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="email" value="{{ __('Email') }}">Email <span class="text-danger">*</span></label>
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="masukan email">
                            <div class="invalid-feedback">
                                Tolong input email.
                            </div>                                                                                 
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="kantor" >Kantor Cabang <span class="text-danger">*</span></label>
                            <select id="kantor" class="form-control select2" type="text" name="kantor" required>
                                <option value="">-- Pilihan --</option>
                                @foreach ($kantor as $item)
                                    <option value="{{ $item->kd_kan }}">{{ $item->kd_kan }} : {{ $item->n_kan }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Tolong input cabang.
                            </div>                                                                                 
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label" for="role_id" >Role <span class="text-danger">*</span></label>
                            <select id="role_id" class="form-control select2" type="text" name="role_id" required>
                                <option value="">-- Pilihan --</option>
                                @foreach ($role as $item)
                                <option value="{{ $item->id }}">{{ $item->id }} : {{ $item->role }}</option>    
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Tolong input role.
                            </div>                                                                                 
                        </div>
                        <div class="col-md-12 mb-2 password">
                            <label class="form-label" for="password" value="{{ __('Password') }}">Password<span class="text-danger">*</span></label>
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="masukan password">
                            <div class="invalid-feedback">
                                Tolong input password.
                            </div>                                                                                 
                        </div>
                       
                        <div class="col-md-12 mb-2 password">
                            <label for="password_confirmation" value="{{ __('Confirm Password') }}">konfirmasi Password<span class="text-danger">*</span></label>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="masukan konfirmasi password"/>
                            <div class="invalid-feedback">
                                Pilih status konfirmasi password.
                            </div>                                                                                  
                        </div>
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms"/>
        
                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif
                    <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary waves-effect waves-themed">
                            Save
                        </button>
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
<script src="{{asset('assets/js/custom/master.js') }}"></script>

<script> 
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#tabelUser').DataTable(
        {
            responsive: true
        });

    })
        
</script>

@stop