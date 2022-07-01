    $(function()
    {
        $('.select2').select2();

    });
    
  
    var id_deb;
    $( window ).on( "load", function() {
        var url = window.location.href;
        var url_array = url.split('/') // Split the string into an array with / as separator
        id_deb = url_array[url_array.length-2];  // Get the last part of the array (-1)
    });

    //===================== upload KTP ========================//
    FilePond.setOptions({
        server: {
            url: 'nasabah/uploadFile',
        
            process: {
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // 'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                url: '/deleteFile/'+id_deb,
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
    const inputElementktp = document.querySelector('input[name="ktp"]');
    const pondktp = FilePond.create( inputElementktp );

    //===================== upload kk ========================//
    FilePond.setOptions({
        server: {
            url: 'nasabah/uploadFile',
        
            process: {
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // 'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                url: '/deleteFile/'+id_deb,
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
    const inputElementkk = document.querySelector('input[name="kk"]');
    const pondkk = FilePond.create( inputElementkk );

    //===================== upload ktp pasangan ========================//
    FilePond.setOptions({
        server: {
            url: 'nasabah/uploadFile',
        
            process: {
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // 'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                url: '/deleteFile/'+id_deb,
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
    const inputElementkp = document.querySelector('input[name="ktppasangan"]');
    const pondkp = FilePond.create( inputElementkp );

    //===================== upload surat jaminan ========================//
    FilePond.setOptions({
        server: {
            url: 'nasabah/uploadFile',
        
            process: {
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // 'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                url: '/deleteFile/'+id_deb,
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
    const inputElementsj = document.querySelector('input[name="suratjaminan"]');
    const pondsj = FilePond.create( inputElementsj );

    
    $(document).ready(function()
    {    
        
        var jennisaguanan = "{{ $data->jaminan }}";
        if(jennisaguanan == "Sertifikat"){
            $("#sertifikat").addClass("active");
            $("#bpkb").removeClass("active");
            $("#lainnya").removeClass("active");
        }
        if(jennisaguanan == "BPKB"){
            $("#sertifikat").removeClass("active");
            $("#bpkb").addClass("active");
            $("#lainnya").removeClass("active");
        }
        if(jennisaguanan == "Lainnya"){
            $("#sertifikat").removeClass("active");
            $("#bpkb").removeClass("active");
            $("#lainnya").addClass("active");
        }
    

        $('.btnPrev').click(function(){
            if ($('.active').prev('.nav-link').length) {
                console.log("oke");
                $('.active').removeClass('active')
                    .prev('.nav-link')
                    .addClass('active');
            }
            if ($('.show').prev(".tab-pane").length) {
                console.log("aa");
                $('.show').removeClass('show active')
                    .prev(".tab-pane")
                    .addClass('show active');

            }
        });

        $("#btnBack2").click(function(){
            $('#permohonan').removeClass('active');
            $('#personal').addClass('active');
        });

        $("#btnBack3").click(function(){
            $('#permohonan').addClass('active');
            $('#dokument').removeClass('active');
        });

        //################################## JENIS AGUNAN ############################
        
        $(".agunantanah").show();
        $(".agunankend").hide();
        $(".agunanlainnya").hide();
        $(".modal-title").text("Tambah Jaminan Sertifikat Tanah");

        $('#jenisagunan').change(function(){
            const jenis = $(this).val();
            
            if(jenis == 6){
                $(".modal-title").text("Tambah Jaminan Sertifikat Tanah");
                $(".agunantanah").show();
                $(".agunankend").hide();
                $(".agunanlainnya").hide();
            }else if(jenis == 5){
                $(".modal-title").text("Tambah Jaminan BPKB");
                $(".agunantanah").hide();
                $(".agunankend").show();
                $(".agunanlainnya").hide();
            } else {
                $(".modal-title").text("Tambah Jaminan Lainnya");
                $(".agunantanah").hide();
                $(".agunankend").hide();
                $(".agunanlainnya").show();
            }
        });

    });

    function selectShowDebtor(id) {
        event.preventDefault();
        alert("ok");
        console.log(id);
        var query = "";
        query = id;

        $.ajax({
            url: "nasabah/selectShowDebtor",
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
        }); 
    }

    
    // ######################### step 1 process storing ################//
    
    $("form#step1").submit(function(e) {
        e.preventDefault();

        console.log("ke form 1");
        
        var step        = "1";
        var formData    = new FormData(this);
        var url         = 'update';

        formData.append('step', step);
        formData.append('id', $("#id_debitur_step1").val());

        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': $('#authorization').val()
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
				// Show image container
				$("#btnShow1").attr('disabled',true).text('Loading...');
				
			},
            success: function(hasil) {

                console.log(hasil)

                if(hasil.id == null){
                    id = hasil.message.id;
                }else{
                    id = hasil.id;
                }

                id_deb = id;

                $("#id_debitur_step2").val(id);
                $("#id_debitur_step3").val(id);
                $("#id_debitur_step4").val(id);

                if(hasil.message == 0){
                    toastr.error('Maaf, proses simpan data gagal .',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });
                }else{

                    //process step

                    console.log("id "+hasil.id);
                   
                    // if ($('.active').next('.nav-link').length) {
                    //     console.log("staepp1");
                    //     $('.active').removeClass('active')
                    //         .next('.nav-link')
                    //         .addClass('active');
                    // }

                    if ($('.show').next(".tab-pane").length) {
                        console.log("staepp1 aa");
                        $('.show').removeClass('show active')
                            .next(".tab-pane")
                            .addClass('show active');
                        $('#personal').removeClass('active');
                        $('#permohonan').addClass('active');
                    }
               
                    //end step
                    toastr.success('Step 1 Berhasil disimpan.',  'Info', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });

                }
                
                
            },
            error: function(err) {
                console.log(err)
                // alert("Masih ada yang kosong");
                toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });

            },
            complete:function(data){
				// Hide image container
				
                $("#btnShow1").text('Next').attr('disabled',false);
			}
        });

    });

    //######################### end step 1 #######################//

    //###################### step 2 process storing ################
    
    $("form#step2").submit(function(e) {
        e.preventDefault();
        
        var step        = "2";
        $('#step1 :input[_token]').remove();
        $('#step1 :input').not(':submit').clone().hide().appendTo('#step2');
        var url         = 'update';
        var formData    = new FormData(this);

        formData.append('step', step);
        formData.append('id', $("#id_debitur_step2").val());
        
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
				// Show image container
				$("#btnShow2").attr('disabled',true).text('Loading...');
				
			},
            success: function(hasil) {

                console.log(hasil);
                
                if(hasil.message == 0){

                    toastr.error('Maaf, proses simpan data gagal',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });

                }else{

                    //process step
            
                    if ($('.show').next(".tab-pane").length) {
                        console.log("oke oce");
                        $('.show').removeClass('show active')
                            .next(".tab-pane")
                            .addClass('show active');
                            $('#permohonan').removeClass('active');
                            $('#dokument').addClass('active');
                    }
                    
                    //end step

                    toastr.success('Step 2 Berhasil disimpan.',  'Info', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
                   
                }
                

            },
            error: function(err) {
                console.log(err);
                toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
            },
            complete:function(data){
				// Hide image container
				
                $("#btnShow2").text('Next').attr('disabled',false);
			}
        });

    });
    //############################### end step 2 ##########################

    //############################### step 3 process storing ##############
    $("form#step3").submit(function(e) {
        e.preventDefault();
        
        // var url         = 'update';
        // var formData    = new FormData(this);

        //process step
        if ($('.show').next(".tab-pane").length) {
            console.log("aa");
            $('.show').removeClass('show active')
                .next(".tab-pane")
                .addClass('show active');
            $('#dokument').removeClass('active');
            $('#surat').addClass('active');
        }

        //end step
        toastr.success('Step 3 Berhasil disimpan.',  'Info', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });


        // $.ajax({
        //     url: url,
        //     type: 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     data: formData,
        //     cache: false,
        //     contentType: false,
        //     processData: false,
        //     beforeSend: function(){
		// 		// Show image container
		// 		$("#btnShow3").attr('disabled',true).text('Loading...');
				
		// 	},
        //     success: function(hasil) {

        //         // $("#shownik").val(hasil.data.nik);
        //         $("#shownikpasangan").val(hasil.data.no_id_pasangan);
        //         // $("#showtgllahir").val(hasil.data.tgllahir);
        //         // $("#showtgllahirpasangan").val(hasil.data.tgllahirpasangan);
                
        //         $("#showslik").val(hasil.data.nogenerateslik1);
        //         $("#showslikpasangan").val(hasil.data.nogenerateslik2);
                
        //         console.log(hasil);

        //        //process step
            
            
        //         if ($('.show').next(".tab-pane").length) {
        //             console.log("aa");
        //             $('.show').removeClass('show active')
        //                 .next(".tab-pane")
        //                 .addClass('show active');
        //             $('#dokument').removeClass('active');
        //             $('#surat').addClass('active');
        //         }

              
        //         //end step

        //         toastr.success('Step 3 Berhasil disimpan.',  'Info', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });

        //     },
        //     error: function(err) {
        //         console.log(err);
        //         toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
        //     },
        //     complete:function(data){
		// 		// Hide image container
				
        //         $("#btnShow3").text('Next').attr('disabled',false);
		// 	}
        // });

    });
    //############################### end step 3 ##########################


    //############################### step 4 process finish ##############
    $(".finish").click(function(){
        var formData    = new FormData();

        formData.append('step', '4');
        formData.append('id', $("#id_debitur_step4").val());

        var url = 'update';
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'post',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
				// Show image container
				$("#btnShow2").attr('disabled',true).text('Loading...');
                toastr.success('Data Berhasil disimpan.',  'Info', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
				
			},
            success: function(hasil) {
                console.log("ok")
            }
        });
    });
    //############################### end step 4 ##############


     //######################### get no urut by kode cabang
     function getNoUrut(cabang){

        $.ajax({
            url: 'getnourutnasabah/'+cabang,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': $('#authorization').val()
            },
            // data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(hasil) {

                // return hasil;
                console.log("hasil ");
                console.log(hasil.data);
                return hasil.data;

            },
            error: function(err) {
                
                console.log(err)
                toastr.error('Silakan cek koneksi jaringan internet.',  'Informasi', { positionClass: 'toast-top-right', timeOut: 10000, "progressBar": true });
                
            }
        });
      
    }
    
    // ##################### create generate to slik 1 dan slik 2 , no pengajuan
    function generate(keterangan, parameter){

        let nokredit ="";

        //change format date pengajuan
        var tglpengajuan =   moment(moment(parameter.tglpengajuan).format("YYYY-MM-DD")).format("YYYYMMD");//new Date(Date.parse(parameter.tglpengajuan)).format("yyyyMMdd");
        
        //get no urut
        console.log(getNoUrut(parameter.cabang));
        console.log("cek no urut");
        console.log(nourut);
        
        if(keterangan == "kredit"){

            nokredit    = parameter.cabang+"-"+tglpengajuan+"-"+nourut;

        }else 
        if(keterangan == "slik"){

        }

    }

    
    

  


  

   





