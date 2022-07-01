<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">

		

		<title>Laporan</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

		<meta name="header" content="">

		<!-- Call App Mode on ios devices -->

		<meta name="apple-mobile-web-app-capable" content="yes" />

		 <!-- Remove Tap Highlight on Windows Phone IE -->

		<meta name="msapplication-tap-highlight" content="no">

		<!-- base css -->

		



        <!-- Fonts -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->

        <!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> -->

		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/vendors.bundle.css') }}">

		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/app.bundle.css') }}">

		{{-- <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/themes/cust-theme-8.css') }}"> --}}

		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/toastr/toastr.css') }}">

		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/fa-solid.css') }}">

		<link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css') }}">

        @livewireStyles

		@yield('head')

	<!-- Place favicon.ico in the root directory -->

	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="stylesheet" media="screen, print" href="{{ asset('assets/css/notifications/sweetalert2/sweetalert2.bundle.css') }}">

    <style>

        .swal2-container {

           z-index: 10050;
        }

    </style>

        <!-- Scripts -->

     <!-- <script src="{{ mix('js/app.js') }}" defer></script> -->

     <link rel="stylesheet" media="screen, print"

          href="{{asset('assets/css/datagrid/datatables/datatables.bundle.css') }}">

    <link rel="stylesheet" media="screen, print"

          href="{{asset('assets/css/formplugins/select2/select2.bundle.css') }}">

    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/fa-solid.css') }}">

    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/fa-brands.css') }}">

    <link rel="stylesheet" media="screen, print" href="{{asset('assets/css/filepond/filepond.css') }}">

    <style>

        span.select2-container {

            z-index: 10050;

        }

        .select2-dropdown {

            z-index: 3051;

        }



        span.select2-container {

            z-index: 150;

        }



        #dvVideoBtm.vdhide {

            bottom: -160px;

        }

        #dvVideoBtm {

            visibility: visible;

            opacity: 1;

            z-index: 999999999;

            width: 300px;

            height: 200px;

            position: fixed;

            display: block;

            bottom: 0;

            right: 2%;

            left: auto;

            cursor: auto;

            transition: bottom 1s;

        }

        #dvVideoBtm {

            visibility: visible;

        }

        #vdtgr {

            background-color: var(--primary);

            height: 15px;

            width: 90px;

            float: right;

            font-size: 12px;

            text-align: center;

            color: #fff;

            cursor: pointer;

            padding-bottom: 20px;

            border-top-right-radius: 10px;

            border-top-left-radius: 10px;

        }

    </style>

    </head>

    <body class="mod-bg-1 ">

        <main id="js-page-content" role="main" class="page-content">

            <div id="cetak">

            <div class="panel mt-2" style="padding-right: 100px;padding-left: 100px;padding-top: 100px; ">

                <div class="container">

                    {{-- <a href="javascript:demoFromHTML()" class="button">Run Code</a> --}}

                    <div  data-size="A4">

                        <div class="row">

                            <div class="col-sm-10">

                            </div>

                            <div class="col-sm-2">


                            </div>                            

                        </div>

                        <div class="row table-scale-border-bottom">

                            <div class="col-sm-12" style="text-align: center;font-family: TimesNewRoman,Times New Roman,Times,Baskerville,Georgia,serif; ">

                                <h2 class="fw-900 fw-700 keep-print-font pt-2 l-h-n m-0">

                                    Laporan Pekerjaan Tim IT
                                    <br>
                                    Per Tanggal ( {{ date("d M Y ",strtotime($daritgl)) }} - {{ date("d M Y",strtotime($sampaitgl)) }} )
                                </h2>

                                <h2 class="fw-900 fw-700 keep-print-font pt-1 pb-4 l-h-n m-0">

                                </h2>

                            </div>

                        </div>

                        <br>

                        <div class="row table-scale-border-bottom ">

                            <div class="col-sm-6 d-flex">

                                <div class="table-responsive">

                                    <table class="table table-clean table-sm align-self-end">

                                        <tbody style="border: 1px solid">

                                            <tr >

                                                <td>

                                                    <strong>Tanggal Cetak:</strong>

                                                </td>

                                                <td>
                                                    {{ date('d M Y') }}

                                                </td>

                                            </tr>

                                            {{-- <tr style="border: 1px solid">

                                                <td>

                                                    <strong>No Aplikasi:</strong>

                                                </td>

                                                <td>

                                                </td>

                                            </tr> --}}

                                        </tbody>

                                    </table>

                                </div>

                            </div>


                        </div>

                        <div class="row ">

                            <div class="col-sm-12 pt-2">

                                <h3  style="text-align: center;font-family: TimesNewRoman,Times New Roman,Times,Baskerville,Georgia,serif;"><strong> </strong></h3>

                            </div>

                            <div class="col-sm-12 d-flex" style="border: 1px solid">

                                <div class="col-sm-11">

                                    <div class="table-responsive">

                                        <table class="table-sm table-clean text-left" style="font-size: 16px">
                                            <thead>
                                                <tr style="border: 1px solid">
                                                    <td style="border: 1px solid">No</td>
                                                    <td style="border: 1px solid">Tgl Request</td>
                                                    <td style="border: 1px solid">No Tracking Tiket</td>
                                                    <td style="border: 1px solid">Kantor</td>
                                                    <td style="border: 1px solid">Kendala</td>
                                                    <td style="border: 1px solid">Keterangan Detail</td>
                                                    <td style="border: 1px solid">Kategori</td>
                                                    <td style="border: 1px solid">Sifat</td>
                                                    <td style="border: 1px solid">PIC Request</td>
                                                    <td style="border: 1px solid">Status Kerjaan</td>
                                                    <td style="border: 1px solid">Tgl Selesai</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                                @php($no=1)
                                                @foreach($data as $item)
                                               
                                                <tr style="border: 1px solid">
                                                    <td style="border: 1px solid">{{ $no++ }}</td>
                                                    <td style="border: 1px solid">{{ $item->created_at }}</td>
                                                    <td style="border: 1px solid">{{ $item->nopengajuantugas }}</td>
                                                    <td style="border: 1px solid">{{ $item->n_kan }}</td>
                                                    <td style="border: 1px solid">{{ $item->kendala }}</td>
                                                    <td style="border: 1px solid">{{ $item->keterangan }}</td>
                                                    <td style="border: 1px solid">{{ $item->namakategori }}</td>
                                                    <td style="border: 1px solid">{{ $item->sifat }}</td>
                                                    <td style="border: 1px solid">{{ $item->PIC_cabang }}</td>
                                                    
                                                    <td style="border: 1px solid">
                                                        
                                                        @if($item->status == 4)
                                                        {{ "Selesai" }}
                                                        @else
                                                        {{ "Belum Selesai" }}
                                                        @endif
                                                    </td>
                                                    <td style="border: 1px solid">{{ $item->tanggal_selesai }}</td>
                                                </tr>
                                                @endforeach
                                               
                                            </tbody>


                                        </table>
                                       
                                    </div>

                                </div>

                            </div>

                        </div>
                      
                        <div class="row table-scale-border-bottom ">

                            <div class="col-sm-12 d-flex " >

                                <div class="table-responsive">

                                    <table class="table table-sm table-clean text-left" >
                                        <tbody>
                                            <tr >

                                                <td style="height: 100px;text-align: center">

                                                    <h5 >

                                                        Menyetujui<br>

                                                        <p style="height: 100px"></p>

                                                        <br>

                                                       (................................)

                                                     </h5>

                                                </td>

                                                <td >


                                                </td>

                                            </tr>

                                           

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <br>
                    
                    </div>

                </div>

            </div>

            </div>
          
        </main>

    </body>
  

<script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>



