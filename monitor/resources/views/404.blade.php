
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" media="screen, print"
          href="{{asset('public/assets/css/datagrid/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" media="screen, print"
          href="{{asset('public/assets/css/formplugins/select2/select2.bundle.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('public/assets/css/fa-solid.css') }}">
    <link rel="stylesheet" media="screen, print" href="{{asset('public/assets/css/fa-brands.css') }}">
    
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
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item">Page Not Found</li>
            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
        </ol>   
        <div class="h-alt-hf d-flex flex-column align-items-center justify-content-center text-center">
            <h1 class="page-error color-fusion-500">
                ERROR <span class="text-gradient">404</span>
                <small class="fw-500">
                    Halaman Tidak ditemukan
                </small>
            </h1>
            
        </div>
    </main>
  
@endsection
@section('scripts')

    <script src="{{asset('public/assets/js/datagrid/datatables/datatables.bundle.js') }}"></script>
    <script src="{{asset('public/assets/js/formplugins/inputmask/inputmask.bundle.js') }}"></script>
    <script src="{{asset('public/assets/js/formplugins/select2/select2.bundle.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('public/assets/js/custom/master.js')}}"></script>

    {{-- <script src="{{asset('assets_custom/js/uang.js') }}"></script>
    <script src="{{asset('assets_custom/js/accounting.js') }}"></script>
    <script src="{{env('APP_URL')}}/assets_custom/js/logic.js"></script>
    <script src="{{env('APP_URL')}}/assets_custom/js/initScoreCard.js"></script>
    <script src="{{env('APP_URL')}}/assets_custom/js/initEligibility.js"></script>
    <script src="{{env('APP_URL')}}/assets_custom/js/initScoringDebitur.js"></script>
    <script src="{{env('APP_URL')}}/assets_custom/js/initScoringDebitur.js"></script> --}}

    <script type="text/javascript">

       

       $(document).ready(function () {

        

        $(".money").change(function () {
            console.log(this.value);
            result = accounting.formatMoney(this.value,{
                precision : 2,
                thousand : ".",
                decimal  : ",",
            });
            $("#"+this.id).val(result);

        });

        $('.select2').select2();

        $('#nama').select2({
            
            placeholder: "-- Pilih Nama --",
            allowClear: true
        });
        $('#branchKode').select2({
            placeholder: "-- Select Branch --",
            allowClear: true
        });

        $('#filter1').select({
            dropdownParent: $('#pilih'),
            placeholder: "-- Select  --",
            allowClear: true
        });

        $('#typeApplication').select2({
            placeholder: "-- Select type application --",
            allowClear: true
        });

        $('#personGender').select2({
            dropdownParent: $('#pilih'),
            placeholder: "-- Select Gender --",
            allowClear: true
        });

    });

        function selectDebtor(id) {
            event.preventDefault();
            console.log(id);
            var query = "";
            fetch_customer_data();

            function fetch_customer_data(query = '') {
                query = id;
                $.ajax({
                    url: "",
                    method: 'GET',
                    data: {query: query},
                    dataType: 'json',
                    headers: {
                        'Authorization': $('#authorization').val()
                    },
                    success: function (data) {
                        
                        $("#formAdd").trigger("reset");
                        
                        $('#js-contacts').html(data.table_data);
                        // document.getElementById("js-scoreCard").style.display = "none";
                        document.getElementById("js-scoreCard").style.display = "none";
                        document.getElementById("btnSave1").style.display = "block";
                        $('#step').val(1);
                        

                        
                        // $('tbody').html(data.table_data);
                        // $('#total_records').text(data.total_data);
                        // $('tbody').html(data.table_data);
                        // $('#total_records').text(data.total_data);
                    }
                })
            }
        }




    </script>
    <script>

   
    
        function validatePart(isMessage,id){
            var idDiv = id.toString() ;
            var isvalid =  true;
            if(idDiv === "1" || idDiv === "2" || idDiv === "4"){
                if(idDiv === "4" ){
                    idDiv ="3"
                }
                var input = $("#tab_justified-"+idDiv).find("select, textarea, input");
                
                $.each(input, function () {
                    
                    if (!this.checkValidity()) {
                        isvalid = false;
                        console.log("ini namanya",this.name)
                    }
                });
                if(isMessage && !isvalid){
                    toastr.info('make sure the data sent is complete', 'Info Tab '+idDiv);
                }
            }

            return isvalid;
        }
        $(document).on("click",".one-data",function(e) {
            var linkHref = this.getAttribute("href");
            var idLink = linkHref.substring(linkHref.lastIndexOf("/")+1);
            for (var i = 0; i < localStorage.length; i++) {
                // console.log(localStorage.getItem(localStorage.key(i)));
                var keyLocal= localStorage.key(i);
                var idStorage = keyLocal.substring(0,keyLocal.indexOf("-"));
                if(idStorage === idLink){
                    localStorage.removeItem(keyLocal);
                }
            }

        });

        $(document).ready(function () {

            // $('.btnNext').click(function () {
            //     stepScroing();
            // });

            $('.btnPrev').click(function () {
                // if ($('.active').prev('.nav-link').length) {
                //     $('.active').removeClass('active')
                //         .prev('.nav-link')
                //         .addClass('active');
                // }
                if ($('.tab-pane.fade.show').prev(".tab-pane").length) {
                    $('.tab-pane.fade.show').removeClass('active show')
                        .prev(".tab-pane")
                        .addClass('active show');


                }
                var countPrev =  $('#step').val();
                $('#step').val(parseInt(countPrev)-1);
            });


            fetch_customer_data();

            function fetch_customer_data(query = '', debPersonal = 0, debCompany = 0, filter = 0) {
                // var debPersonal = 0;
                // var debCompany = 0;
                // var filter =0 ;
                if (document.getElementById('filter-name').checked) {
                    filter = document.getElementById('filter-name').value;
                } else if (document.getElementById('filter-id').checked) {
                    filter = document.getElementById('filter-id').value;
                }

                if (document.getElementById('typeDebtor1').checked) {
                    debPersonal = 1;

                }
                if (document.getElementById('typeDebtor2').checked) {
                    debCompany = 2;
                }

                if(query.length>3) {
                    $.ajax({
                        url: "",
                        method: 'GET',
                        data: {query: query, debPersonal: debPersonal, debCompany: debCompany, filter: filter},
                        dataType: 'json',
                        headers: {
                            'Authorization': $('#authorization').val()
                        },
                        success: function (data) {
                            $('#js-contacts').html(data.table_data);
                            $(".nav-link").removeClass('active');
                            $('.tab-pane.fade.show').removeClass('active show');
                            $('#tab_justified-1').addClass('active show');
                            $("#tab1").addClass('active');
                            document.getElementById("btnSave1").style.display = "none";
                            document.getElementById("js-eligibility").style.display = "none";
                            document.getElementById("js-scoreCard").style.display = "none";
                            // $('tbody').html(data.table_data);
                            // $('#total_records').text(data.total_data);
                        }
                    })
                }
            }

            $(document).on('keyup', '#js-filter-contacts', function () {
                var query = $(this).val();
                fetch_customer_data(query);
            });
        });


    </script>

    <script type="application/javascript">

        function isEligibility() {
            var formAdd = document.forms.formAdd;
            var resultEl = false;
            var isRequire = validatePart(true,2);
            if(isRequire){
                resultEl = eligibility(formAdd, "formEligibility");
                if (resultEl) {
                    document.getElementById("btnSave2").style.display = "block";
                    document.getElementById("btnEligibility").style.display = "none";

                }else{
                    document.getElementById("btnSave2").style.display = "none";
                    document.getElementById("btnEligibility").style.display = "none";
                }
                $('#step').val(3);
            }
        }
        function isScoreDt() {
            var formAdd = document.forms.formAdd;
            var resultSC = false;
            var isRequire = validatePart(true,4);
            if(isRequire) {
                resultSC =   scoreDt(formAdd, "scoreDt",false);
                if (resultSC) {
                    document.getElementById("btnSave3").style.display = "block";
                    // document.getElementById("btnScore").style.display = "none";

                } else {
                    document.getElementById("btnSave3").style.display = "none";
                    document.getElementById("btnScore").style.display = "none";
                }
                $('#step').val(5);
            }
        }
        function isReset(idstep) {

            document.getElementById("btnScore").style.display = "block";
            document.getElementById("btnEligibility").style.display = "block";
            $(".nav-link").removeClass('active');
            $('.tab-pane.fade.show').removeClass('active show');
            $('#tab_justified-'+idstep).addClass('active show');
            $('#tab_justified-'+idstep).find('input:text').val('');
            $("#tab"+idstep).addClass('active');
            // $("#formAdd")[0].reset();
            if(idstep === 3){
                idstep = idstep+1;
            }
            $('#step').val(idstep);

        }
        function isValidate() {
            console.log("last1");
            var formAdd = document.forms.formAdd;
            var stepForm = new FormData(formAdd);
            console.log(stepForm.get("step"));
            var step = parseInt(stepForm.get("step"))-1;
            var isRequire = validatePart(false,step);
            console.log("",isRequire);
            if(isRequire) {
                console.log("last");
                if (stepForm.get("step") === "2") {
                    var today = new Date();
                    var dob = new Date($("#tanggalPendirian").val());
                    var age = today.getFullYear() - dob.getFullYear(); //This is the update
                    $('#US').val(age);
                    $(".nav-link").removeClass('active');
                    $("#tab2").addClass('active');
                    document.getElementById("js-eligibility").style.display = "block";
                    return false
                } else if (stepForm.get("step") === "3") {
                    document.getElementById("js-scoreCard").style.display = "block";
                    return false;
                } else if (stepForm.get("step") === "4") {
                    $(".nav-link").removeClass('active');
                    $("#tab3").addClass('active');
                    return false
                } else if (stepForm.get("step") === "5") {
                    if (stepForm.get("type_application") == null || stepForm.get("id_debtor") == null || stepForm.get("selectApp") == null || stepForm.get("branch") == null || $("#noteScore") === "Reject" || $("textarea#logic").val() === "" || $("textarea#logicElig").val() === "") {
                        toastr.info('make sure the data sent is complete', 'Info data input');
                        return false
                    } 
                    else {
                        if (confirm(' Are you sure create this data?')) {
                            return true;
                        }
                        else{
                            return false;
                        }

                    }
                } else {
                    return false
                }
            }
            else{
                return false
            }
        }
        $(document).ready(function () {


        });
    </script>
    <script>
        $('#application').select2({
            dropdownParent: $('#pilih'),
            placeholder: "-- Select Province --",
            allowClear: true
        });

       

        $(document).ready(function () {
                      
            $('#dt-basic-example').dataTable(
            {
                responsive: true
            });

            $('.js-thead-colors a').on('click', function()
            {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
            });

            $('.js-tbody-colors a').on('click', function()
            {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
            });

             // initialize datatable
            //  $('#dt-basic-example').dataTable(
            //     {
            //         responsive: true,
                    // columnDefs: [
                    // {
                    //     targets: -1,
                    //     title: 'Admin Controls',
                    //     orderable: false,
                    //     render: function(data, type, full, meta)
                    //     {

                    //         /*
                    //         -- ES6
                    //         -- convert using https://babeljs.io online transpiler
                    //         return `
                    //         <div class='d-flex mt-2'>
                    //         	<a href='javascript:void(0);' class='btn btn-sm btn-outline-danger mr-2' title='Delete Record'>
                    //         		<i class="fal fa-times"></i> Delete Record
                    //         	</a>
                    //         	<a href='javascript:void(0);' class='btn btn-sm btn-outline-primary mr-2' title='Edit'>
                    //         		<i class="fal fa-edit"></i> Edit
                    //         	</a>
                    //         	<div class='dropdown d-inline-block'>
                    //         		<a href='#'' class='btn btn-sm btn-outline-primary mr-2' data-toggle='dropdown' aria-expanded='true' title='More options'>
                    //         			<i class="fal fa-plus"></i>
                    //         		</a>
                    //         		<div class='dropdown-menu'>
                    //         			<a class='dropdown-item' href='javascript:void(0);'>Change Status</a>
                    //         			<a class='dropdown-item' href='javascript:void(0);'>Generate Report</a>
                    //         		</div>
                    //         	</div>
                    //         </div>`;
                            	
                    //         ES5 example below:	

                    //         */
                    //         // return "\n\t\t\t\t\t\t<div class='d-flex mt-2'>\n\t\t\t\t\t\t\t<a href='javascript:void(0);' class='btn btn-sm btn-outline-danger mr-2' title='Delete Record'><i class=\"fal fa-times\"></i> Delete Record</a>\n\t\t\t\t\t\t\t<a href='javascript:void(0);' class='btn btn-sm btn-outline-primary mr-2' title='Edit'><i class=\"fal fa-edit\"></i> Edit</a>\n\t\t\t\t\t\t\t<div class='dropdown d-inline-block'>\n\t\t\t\t\t\t\t\t<a href='#'' class='btn btn-sm btn-outline-primary mr-2' data-toggle='dropdown' aria-expanded='true' title='More options'><i class=\"fal fa-plus\"></i></a>\n\t\t\t\t\t\t\t\t<div class='dropdown-menu'>\n\t\t\t\t\t\t\t\t\t<a class='dropdown-item' href='javascript:void(0);'>Change Status</a>\n\t\t\t\t\t\t\t\t\t<a class='dropdown-item' href='javascript:void(0);'>Generate Report</a>\n\t\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>";
                    //     },
                    // },
                    // {
                    //     targets: 17,
                    //     /*	The `data` parameter refers to the data for the cell (defined by the
                    //     	`data` option, which defaults to the column being worked with, in this case `data: 16`.*/
                    //     render: function(data, type, full, meta)
                    //     {
                    //         var badge = {
                    //             1:
                    //             {
                    //                 'title': 'Pending',
                    //                 'class': 'badge-warning'
                    //             },
                    //             2:
                    //             {
                    //                 'title': 'Delivered',
                    //                 'class': 'badge-success'
                    //             },
                    //             3:
                    //             {
                    //                 'title': 'Canceled',
                    //                 'class': 'badge-secondary'
                    //             },
                    //             4:
                    //             {
                    //                 'title': 'Attempt #1',
                    //                 'class': 'bg-danger-100 text-white'
                    //             },
                    //             5:
                    //             {
                    //                 'title': 'Attempt #2',
                    //                 'class': 'bg-danger-300 text-white'
                    //             },
                    //             6:
                    //             {
                    //                 'title': 'Failed',
                    //                 'class': 'badge-danger'
                    //             },
                    //             7:
                    //             {
                    //                 'title': 'Attention!',
                    //                 'class': 'badge-primary'
                    //             },
                    //             8:
                    //             {
                    //                 'title': 'In Progress',
                    //                 'class': 'badge-success'
                    //             },
                    //         };
                    //         if (typeof badge[data] === 'undefined')
                    //         {
                    //             return data;
                    //         }
                    //         return '<span class="badge ' + badge[data].class + ' badge-pill">' + badge[data].title + '</span>';
                    //     },
                    // }],
                // });

            

            // table = $("#dt-basic-example").DataTable({
            //     "sDom": "" +
            //         "t" +
            //         "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            //     "sPaginationType": "full_numbers",
            //     orderCellsTop: true,
            //     fixedHeader: true,
            //     columns,
            //     initComplete: function () {
            //         $("div#table-app_filter")
            //             .prepend($("<button/>").addClass("btn btn-primary pull-right add-new-users").text("Add New Users"));
            //     },
            //     serverSide: true,
            //     "ajax": {
            //         "url": window.CONFIG.APP_API_URL_LOAN+"/api/v1/aplikasi/"+window.CONFIG.APP_SEGMENT_URL+"/tablesView?status=DRAFT&status=REJECT&status=FINISH",
            //         {{--"url": "{{route("application.tablesApp")}}",--}}
            //         "type": "POST",
            //         headers: {
            //             'Authorization': window.CONFIG.authToken
            //         },
            //         contentType: 'application/json',
            //         data: function (d) {
            //             let {columns} = d;
            //             columns = columns.map(f => {
            //                 // if (f.data === "statusAplikasi") {
            //                 //     f.search = {
            //                 //         value: "DRAFT|REJECT",
            //                 //         regex: true
            //                 //     };
            //                 // }
            //                 return f;
            //             });
            //             d.columns = columns;
            //             return JSON.stringify(d);
            //         },
            //         // success: function (data) {
            //         //
            //         //  console.log(data);
            //         // },
            //         error: function (e) {
            //             console.log('Error:', e);
            //         }
            //     }
            // });
            // $('#dt-basic-example thead tr').clone(true).appendTo('#dt-basic-example thead');
            // $('#dt-basic-example thead tr:eq(1) th').each(function (i) {
            //     var title = $(this).text();
            //     $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');

            //     $('input', this).on('keyup change', function () {
            //         if (table.column(i).search() !== this.value) {
            //             table
            //                 .column(i)
            //                 .search(this.value)
            //                 .draw();
            //         }
            //     });
            // });

            // Setup - add a text input to each footer cell


        });

    </script>
@endsection
