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
                        TUGAS <span class="fw-300"><i>Tabel</i></span>
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
                            <div class="panel-toolbar ml-0 pr-3 pb-3">
                                <h5 class="m-12">
                                        <a style="color: white;" data-toggle="modal" data-target="#filtercetak"  class="btn btn-info">
                                            <i class="fal fa-print"></i> <span class="hidden-mobile"> Cetak</span></a>
                                </h5>
                            </div>
                            <div class="panel-toolbar ml-0 pb-3">
                                <h5 class="m-12">
                                        <a style="color: white;" id="resetModal" data-toggle="modal" data-target="#daftar" id="tambah"  class="btn btn-success">
                                            <i class="fal fa-plus"></i> <span class="hidden-mobile"> Tambah</span></a>
                                </h5>
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                              
                                <table class="table table-bordered table-hover table-striped w-100" id="tabelTabungan">
                                    <thead class="thead-dark">
                                        <tr class="table-primary">
                                            <th >No</th>
                                            <th >Tanggal </th>
                                            <th >No Pengajuan Tugas </th>
                                            <th >Cabang</th>
                                       
                                            <th >Perihal</th>
                                             <th >PIC IT</th>
                                            <th >Tgl Selesai</th>
                                            <th >Prioritas</th>
                                            <th >Status</th>
                                            <th >Response</th>
                                            <th >Lampiran</th>
                                            <th >Ket Selesai</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($no=1)
                                        @foreach ($data as $item)
                                        
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td >{{ $item->created_at }} </td>
                                                <td >{{ $item->nopengajuantugas }} </td>
                                                <td>{{ $item->n_kan }}</td>
                                               
                                                <td >{{ $item->kendala }}</td>
                                               <td>{{ $item->PIC_IT }}</td>
                                                <td >{{ $item->tanggal_selesai }} </td>
                                                <td>
                                                    @if($item->sifat == "Tinggi")
                                                    <button type="button" class="btn btn-xs btn-danger waves-effect waves-themed">Tinggi</button>
                                                    @elseif($item->sifat == "Menengah")
                                                    <button type="button" class="btn btn-xs btn-warning waves-effect waves-themed">Menengah</button>
                                                    @else
                                                    <button type="button" class="btn btn-xs btn-success waves-effect waves-themed">Rendah</button>
                                                    @endif
                                                </td>
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
                                               
                                               
                                                <td>
                                                    <button type="button" class="btn btn-xs btn-warning waves-effect waves-themed" data-toggle="tooltip" data-placement="top" data-animation="true" title="Response" data-original-title="Response" onclick="javascript:getModalEdit({{ $item->id }})">
                                                        <i class="fal fa-edit"></i>
                                                    </button> &nbsp;&nbsp;&nbsp;
                                                  
                                                </td>
                                                <td>
                                                       @if($item->lampiran == '')
                                                        <span class="btn btn-xs btn-danger waves-effect waves-themed">Belum</span>
                                                    @else
                                                        <button type="button" class="btn btn-xs btn-info waves-effect waves-themed" data-toggle="tooltip" ddata-placement="top" data-animation="true" title="View" data-original-title="View" onclick="javascript:getModalImage({{ $item->id }})">
                                                            <i class="fal fa-eye"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>{{ $item->keterangan_selesai }}</td>
                                                
                                              
                                               
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
                <form id="formAdd" enctype="multipart/form-data"  novalidate class="was-validated">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation1">Cabang <span class="text-danger">*</span></label>
                            <select class="form-control" name="cabang">
                                @foreach($kantor as $item)
                                <option value="{{ $item->kd_kan }}">{{ $item->kd_kan." : ".$item->n_kan }}</option>
                                @endforeach
                            </select>                                            
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation2">PIC Cabang <span class="text-danger">*</span></label>
                            <input class="form-control"  name="pic_cabang"  type="text" required placeholder="Isi">
                            <div class="invalid-feedback">
                                Tolong input.
                            </div>                                                                                 
                        </div>
                        
                        {{-- <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status" >
                                <option value="1">Progress</option>
                                <option value="2">Revisi</option>
                                <option value="3">Review</option>
                                <option value="4">Done</option>
                            </select>
                        </div> --}}
                      
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">No Kontak <span class="text-danger"></span></label>
                            <input class="form-control" name="kontak" id="kontak" type="text"  placeholder="kontak">
                            <div class="invalid-feedback">
                                Tolong input kontak.
                            </div>  
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">Remote Akses <span class="text-danger"></span></label>
                            <input class="form-control" name="remote" id="remote" type="text"  placeholder="remote">
                            <div class="invalid-feedback">
                                Tolong input remote.
                            </div>  
                        </div>
                        {{-- <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori" id="kategori"  required >
                                <option value="ibs report">IBS Report</option>
                                <option value="ibs gen 2">IBS Gen 2</option>
                                <option value="selisih kas">Selisih kas</option>
                                <option value="selisih nominatif">Selisih nominatif</option>
                                <option value="koneksi internet">Koneksi internet</option>
                                <option value="hardware">Hardware</option>
                                <option value="cctv">CCTV</option>
                                <option value="hapus data">Hapus Data</option>
                            </select>
                            <div class="invalid-feedback">
                                Tolong input kategori.
                            </div>  
                        </div> --}}
                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="customControlValidation3">Kendala <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="kendala" id="kendala" type="text" required placeholder="kendala"></textarea>
                            <div class="invalid-feedback">
                                Tolong input kendala.
                            </div>                                                                                 
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="customControlValidation3">Keterangan Detail <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="keterangan" id="keterangan" type="text" required placeholder="keterangan"></textarea>
                            <div class="invalid-feedback">
                                Tolong input keterangan.
                            </div>   
                        </div>
                        {{-- <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">Sifat <span class="text-danger">*</span></label>
                            <select class="form-control" name="sifat" id="sifat" required >
                                <option value="Urgent">Urgent</option>
                                <option value="Biasa">Biasa</option>
                            </select>
                            <div class="invalid-feedback">
                                Tolong input sifat.
                            </div>  
                        </div> --}}
                        {{-- <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">PIC_IT <span class="text-danger">*</span></label>
                            <select class="form-control" name="PIC_IT" id="PIC_IT" >
                                <option value="Aditya Wirayuda">Aditya Wirayuda</option>
                                <option value="Aji Bhakti Rahman">Aji Bhakti Rahman</option>
                                <option value="Nana Suryana">Nana Suryana</option>
                                <option value="Saefudin Zuhri">Saefudin Zuhri</option>
                            </select>
                            <div class="invalid-feedback">
                                Tolong input PIC IT.
                            </div>  
                        </div> --}}
                        
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

<div class="modal fade " id="updateDaftar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Response</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" enctype="multipart/form-data"  novalidate class="was-validated">
                    @csrf
                    <input class="form-control" name="id" id="id" type="hidden">
                    <div class="form-row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation1">Cabang <span class="text-danger">*</span></label>
                            <select disabled class="form-control" name="cabang">
                                @foreach($kantor as $item)
                                <option value="{{ $item->kd_kan }}">{{ $item->kd_kan." : ".$item->n_kan }}</option>
                                @endforeach
                            </select>                                            
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation2">Nama PIC Request <span class="text-danger">*</span></label>
                            <input disabled class="form-control"  name="pic_cabang"  type="text" required placeholder="Isi">
                            <div class="invalid-feedback">
                                Tolong input.
                            </div>                                                                                 
                        </div>
                      
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">No Kontak <span class="text-danger">*</span></label>
                            <input disabled class="form-control" name="kontak" id="kontak" type="text"  placeholder="kontak">
                            <div class="invalid-feedback">
                                Tolong input kontak.
                            </div>  
                        </div>
                        
                       
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">Remote Akses <span class="text-danger"></span></label>
                            <input class="form-control" name="remote" id="remote" type="text"  placeholder="remote">
                            <div class="invalid-feedback">
                                Tolong input remote.
                            </div>  
                        </div>
                       
                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="customControlValidation3">Kendala <span class="text-danger">*</span></label>
                            <textarea disabled class="form-control" name="kendala" id="kendala" type="text" required placeholder="kendala"></textarea>
                            <div class="invalid-feedback">
                                Tolong input kendala.
                            </div>                                                                                 
                        </div>
                       
                        <div class="col-md-12 mb-1">
                            <label class="form-label" for="customControlValidation3">Keterangan <span class="text-danger">*</span></label>
                            <textarea disabled class="form-control" name="keterangan" id="keterangan" type="text" required placeholder="keterangan"></textarea>
                            <div class="invalid-feedback">
                                Tolong input keterangan.
                            </div>   
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control" name="kategori" id="kategori"  required >
                                <option value="">- Pilihan -</option>
                                @foreach($kategori as $it)
                                <option value="{{ $it->id }}">{{ $it->kategori }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Tolong input kategori.
                            </div>  
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">No Pengajuan Tugas <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nopengajuantugas" readonly>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">Sifat <span class="text-danger"></span></label>
                            <select class="form-control" name="sifat" id="sifat" required >
                                <option value="">- Pilihan -</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Menengah">Menengah</option>
                                 <option value="Tinggi">Tinggi</option>
                            </select>
                            <div class="invalid-feedback">
                                Tolong input sifat.
                            </div>  
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">PIC IT <span class="text-danger">*</span></label>
                            <select required class="form-control" name="PIC_IT" id="PIC_IT" >
                                <option value="">- Pilihan -</option>
                                <option value="Aditya Wirayuda">Aditya Wirayuda</option>
                                <option value="Aji Bhakti Rahman">Aji Bhakti Rahman</option>
                                <option value="Nana Suryana">Nana Suryana</option>
                                <option value="Saefudin Zuhri">Saefudin Zuhri</option>
                            </select>
                            <div class="invalid-feedback">
                                Tolong input PIC IT.
                            </div>  
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation3">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="">- Pilihan -</option>
                                <option value="1">Progress</option>
                                <option value="2">Revisi</option>
                                <option value="3">Review</option>
                                <option value="4">Done</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-1 edit">
                            <label class="form-label" for="customControlValidation3">Selesai Waktu<span class="text-danger">*</span></label>
                            <input required class="form-control" type="date" name="selesaiwaktu" placeholder="Selesai Waktu">
                           
                        </div>
                        <div class="col-md-12 mb-1 edit">
                            <label class="form-label" for="customControlValidation3">Keterangan Selesai<span class="text-danger"></span></label>
                            <textarea  class="form-control"  type="text" name="ketselesai" placeholder="Keterangan Selesai"></textarea>
                           
                        </div>
                        
                        <div class="col-md-12 mb-1 edit">
                            <label class="form-label" for="customControlValidation3">Lampiran<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="lampiran">
                            
                             {{-- <input type="file" 
                            id="inputGroupFile04" name="lampiran"
                            class="filepond"                                
                            data-allow-reorder="true"
                            data-max-file-size="2MB"
                            data-max-files="3"> --}}
                               
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="btnedit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="filtercetak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Cetak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="{{ url('tugas/cetak') }}" method="post"  novalidate class="was-validated">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation1">Dari Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="daritanggal">                                         
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="customControlValidation2">Sampai Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="sampaitanggal">                                         
                            <div class="invalid-feedback">
                                Tolong input.
                            </div>                                                                                 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" id="btnShow3" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <!-- Show the KK image in modal -->
 <div class="modal fade docs-cropped" id="view" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img  id="imgShow" alt="" title="" style="width: 100%;width: 50%;">    
                <embed type="application/pdf" id="pdfShow" width="100%" height="400"></embed>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/js/filepond/filepond.js') }}"></script>
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

    var url = "{{ url('/') }}";

    $("#tambah").click(function(){
        alert("OK")
    });

    $("#resetModal").click(function(){
        $("#formAdd").trigger("reset");
        $("#imgShow").attr("src","")
    });

    $("#formCetak").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: url+'/tugas/cetak',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
				// Show image container
				$("#btnShow3").attr('disabled',true).text('Loading...');
				
			},
            success: function(hasil) {
                console.log(hasil);
                $('.modal').each(function(){
                    $(this).modal('hide');
                });
                toastr.success('Tugas Berhasil disimpan.',  'Info', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
                location.reload();
            },
            error: function(err) {
                console.log(err);
                toastr.error('Terjadi kesalahan sistem.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
            },
            complete:function(data){
				// Hide image container
				
                $("#btnShow3").text('Cetak').attr('disabled',false);
			}
        });
    });

    $("#formAdd").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: url+'/tugas/store',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
				// Show image container
				$("#btnadd").attr('disabled',true).text('Loading...');
				
			},
            success: function(hasil) {
                console.log(hasil);
                $('.modal').each(function(){
                    $(this).modal('hide');
                });
                toastr.success('Tugas Berhasil disimpan.',  'Info', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
                location.reload();
            },
            error: function(err) {
                console.log(err);
                toastr.error('Terjadi kesalahan sistem.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
            },
            complete:function(data){
				// Hide image container
				
                $("#btnadd").text('Simpan').attr('disabled',false);
			}
        });
    });

    $("#form").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);
        if($("select[name='kategori']").val() != "" || $("select[name='sifat']").val() != "" || $("select[name='PIC_IT']").val() != "" || $("select[name='status']").val() != "" ){
            $.ajax({
                url: url+'/tugas/store',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    // Show image container
                    $("#btnedit").attr('disabled',true).text('Loading...');
                    
                },
                success: function(hasil) {
                    console.log(hasil);
                    $('.modal').each(function(){
                        $(this).modal('hide');
                    });
                    toastr.success('Tugas Berhasil disimpan.',  'Info', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
                    location.reload();
                },
                error: function(err) {
                    console.log(err);
                    toastr.error('Terjadi kesalahan sistem.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
                },
                complete:function(data){
                    // Hide image container
                    
                    $("#btnedit").text('Simpan').attr('disabled',false);
                }
            });
        }else{
            toastr.error('Lengkapi kolom yang kosong.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
        }
       
    });

    function getModalEdit(id){
        
        $.ajax({
            url: url+"/tugas/getData/"+id,
            type:'GET',
            data: { }
        }).done(function(data){
            console.log(data);

            $(".modal-title").text("Edit");
            // $(".modal-title").text("Edit BPKB");
            $("select[name='cabang']").val(data.data.cabang);
            $("input[name='pic_cabang']").val(data.data.PIC_cabang);
            $("textarea[name='kendala']").val(data.data.kendala);
            $("select[name='status']").val(data.data.status);
               $("select[name='sifat']").val(data.data.sifat);
            
            $("input[name='selesaiwaktu']").val(data.data.tanggal_selesai);
            
            $("textarea[name='keterangan']").val(data.data.keterangan);
            $("input[name='kontak']").val(data.data.kontak);
            $("input[name='remote']").val(data.data.remote);
            $("input[name='nopengajuantugas']").val(data.data.nopengajuantugas);
            $("select[name='PIC_IT']").val(data.data.PIC_IT);
            $("select[name='kategori']").val(data.data.kategori);
            $("input[name='id']").val(data.data.id);
            
             $("textarea[name='ketselesai']").val(data.data.keterangan_selesai);
            if(data.data.lampiran != null){
                $("#imgShow").attr("src","");
            }

            $("#updateDaftar").modal({show: true});
            
        });
    }

    // var imgUrl = '';
    var viewImg = '';
    function getModalImage(id){
        $.ajax({
            url: url+"/tugas/getData/"+id,
            type:'GET',
            data: { }
        }).done(function(data){
            console.log(data);
            $(".modal-title").text("Vew Image");
            console.log(data.data)
            
            $("#imgShow").attr("src",url+"/storage/uploads/lampiran/"+data.data.lampiran);
            $("#pdfShow").attr("src",url+"/storage/uploads/lampiran/"+data.data.lampiran);
            
            // $(".modal-title").text("Edit BPKB");
            // $("select[name='cabang']").val(data.data.cabang);
            // $("input[name='pic_cabang']").val(data.data.PIC_cabang);
            // $("input[name='kendala']").val(data.data.kendala);
            // $("select[name='status']").val(data.data.status);
            // $("input[name='keterangan']").val(data.data.keterangan);
            // $("input[name='kontak']").val(data.data.kontak);
            // $("input[name='remote']").val(data.data.remote);
            // $("select[name='kategori']").val(data.data.kategori);
            // $("select[name='sifat']").val(data.data.sifat);
            // $("select[name='PIC_IT']").val(data.data.PIC_IT);
            // $("input[name='id']").val(data.data.id);

            $("#view").modal({show: true});
            
        });
    }


    //===================== upload Lampiran ========================//
    var id_deb = $("input[name='id']").val();
    FilePond.setOptions({
        server: {
            url: url+'/tugas/upload',
        
            process: {
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  
                },
                withCredentials: false,
                onload: (response) => response.key,
                onerror: (response) => response.data,
                ondata: (formData) => {
                    formData.append('id_debitur', id_deb);
                    return formData;
                },
            },
            revert: {
                url: url+'/deleteFile/'+id_deb,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onload: function (x) {

                    // X - empty, why????
                    console.log(x)

                }
            }
        }
    });
    // const inputElementktp = document.querySelector('input[name="lampiran"]');
    // const pondktp = FilePond.create( inputElementktp );
        
</script>

@stop