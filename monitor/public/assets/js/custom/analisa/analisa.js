$(document).ready(function(){  
    $("#usahaunggas-ayam").hide();
    $("#usahaunggas-bebek").hide();
    $("#usahapadi").hide();
    $("#usahapalawija").hide();
    $("#usahaperdaganganumum").hide();   
    $("#usahaternak-kambing").hide();   

    $("select[name='jenisusaha']").change(function(){
        var jenisusaha = $(this).val();
        if(jenisusaha == 1117){  //palawija
            $("#usahapalawija").show();
            $("#usahaperdaganganumum").hide();   
            $("#usahapadi").hide();
            $("#usahaunggas-ayam").hide();
            $("#usahaunggas-bebek").hide();

            console.log("palawija")
        }else if(jenisusaha == 1111 || jenisusaha == 1001){ //usaha berbagai jenis padi
            $("#usahapadi").show();
            $("#usahaunggas-ayam").hide();
            $("#usahaunggas-bebek").hide();
            $("#usahaperdaganganumum").hide();   
            $("#usahapalawija").hide();
            console.log("palawija")

        }else if(jenisusaha == 1171){ // usaha unggas
          
            Swal.fire({
                    title: "Pilih Unggas",
                    input: "select",
                    inputOptions: {
                        '1': 'Ayam',
                        '2': 'Bebek',
                      },
                    showCancelButton: true,
                    confirmButtonText: "Simpan",
                    showLoaderOnConfirm: true,
                    preConfirm: function preConfirm(status)
                    {
                       
                    },
                    allowOutsideClick: function allowOutsideClick()
                    {
                        return !Swal.isLoading();
                    }
                }).then(function(result)
                {
                  
                    if (result.value == 1)
                    {
                        $("#usahaunggas-ayam").show();
                        $("#usahaunggas-bebek").hide();
                        $("#usahaperdaganganumum").hide();   
                        $("#usahapadi").hide();
                        $("#usahapalawija").hide();
                        $("#usahaternak-kambing").hide();   

                    }else if(result.value == 2){
                        $("#usahaunggas-ayam").hide();
                        $("#usahaunggas-bebek").show();
                        $("#usahaperdaganganumum").hide();   
                        $("#usahapadi").hide();
                        $("#usahapalawija").hide();
                        $("#usahaternak-kambing").hide();   

                    }
                });  

        } else if(jenisusaha == 1179){ // usaha peternakan kambing
            $("#usahaternak-kambing").show(); 
            $("#usahaperdaganganumum").hide();   
            $("#usahaunggas-ayam").hide();
            $("#usahaunggas-bebek").hide();
            $("#usahapadi").hide();
            $("#usahapalawija").hide();
             
        }else{ //perdagangan umum
            $("#usahaperdaganganumum").show();   
            $("#usahaunggas-ayam").hide();
            $("#usahaunggas-bebek").hide();
            $("#usahapadi").hide();
            $("#usahapalawija").hide();
            $("#usahaternak-kambing").hide();   

            console.log("dagang umum")
        }
    });
});


// ============= LPDU 1 =================== //

$("form#formLpdu1").submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);
    var tglpenilaian = $("input[name='tglpenilaian']").val();
   
    Swal.fire(
    {
        title: "Saya merekomendasikan agar aplikasi ini?",
        input: "select",
        inputOptions: {
            '4': 'Tidak',
            '5': 'Ya',
          },
        showCancelButton: true,
        confirmButtonText: "Simpan",
        showLoaderOnConfirm: true,
        preConfirm: function preConfirm(status)
        {
            console.log(status)
            formData.append("tglpenilaian",tglpenilaian);
            formData.append("statuspenilaian",status);
            formData.append("lpdu","1");

            $.ajax({
                url: 'store',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("#btnShow1").attr('disabled',true).text('Loading...');
                },
                success: function(hasil) {

                    console.log(hasil)
                    //end step
                    toastr.success('LPDU (1) Berhasil disimpan.',  'Info', { positionClass: 'toast-bottom-right', timeOut: 5000, "progressBar": true });
                    $("#btnShow1").removeAttr('disabled',true).text('Simpan dan Lanjut');
                    
                },
                error: function(err) {
                    console.log(err)
                    $("#btnShow1").removeAttr('disabled',true);
                    toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });
                }
            });
          
        },
        allowOutsideClick: function allowOutsideClick()
        {
            return !Swal.isLoading();
        }
    }).then(function(result)
    {
        // console.log("hasil "+result);

        if (result.value)
        {
            $("#btnShow1").removeAttr('disabled',true).text('Simpan dan Lanjut');
            if ($('.show').next(".tab-pane").length) {
                console.log("oke oce");
                $('.show').removeClass('show active')
                    .next(".tab-pane")
                    .addClass('show active');
                    $('#lpduone').removeClass('active');
                    $('#lpdutwo').addClass('active');
            }
        }
    });
});

// ============= LPDU 2 =================== //

$("form#formLpdu2").submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);
  
    Swal.fire(
    {
        title: "Saya telah melakukan verifikasi dan konfirmasi terhadap kelayakan data pemohon?",
        input: "select",
        inputOptions: {
            '4': 'Tidak',
            '5': 'Ya',
          },
        showCancelButton: true,
        confirmButtonText: "Simpan",
        showLoaderOnConfirm: true,
        preConfirm: function preConfirm(status)
        {
            formData.append("statuspenilaian",status);
            formData.append("lpdu","2");

            $.ajax({
                url: 'store',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("#btnShow1").attr('disabled',true).text('Loading...');
                },
                success: function(hasil) {

                    //end step
                    toastr.success('LPDU (2) Berhasil disimpan.',  'Info', { positionClass: 'toast-bottom-right', timeOut: 5000, "progressBar": true });
                    $("#btnShow1").removeAttr('disabled',true).text('Simpan dan Lanjut');
                    
                },
                error: function(err) {
                    console.log(err)
                    $("#btnShow1").removeAttr('disabled',true);
                    toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });
                }
            });
          
        },
        allowOutsideClick: function allowOutsideClick()
        {
            return !Swal.isLoading();
        }
    }).then(function(result)
    {
        console.log("hasil "+result);

        if (result.value)
        {
            $("#btnShow1").removeAttr('disabled',true).text('Simpan dan Lanjut');
            if ($('.show').next(".tab-pane").length) {
                console.log("oke oce");
                $('.show').removeClass('show active')
                    .next(".tab-pane")
                    .addClass('show active');
                    $('#lpdutwo').removeClass('active');
                    $('#lpduthree').addClass('active');
            }
        }
    });    
});



// ============= LPDU 3 =================== //

$("form#formLpdu3").submit(function(e){
    e.preventDefault();

    var formData = new FormData(this);
  
    Swal.fire(
    {
        title: "Saya telah melakukan verifikasi dan konfirmasi terhadap kelayakan data pemohon?",
        input: "select",
        inputOptions: {
            '4': 'Tidak',
            '5': 'Ya',
          },
        showCancelButton: true,
        confirmButtonText: "Simpan",
        showLoaderOnConfirm: true,
        preConfirm: function preConfirm(status)
        {
           
            formData.append("status",status);
            formData.append("lpdu","3");

            $.ajax({
                url: 'store',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("#btnShow1").attr('disabled',true).text('Loading...');
                },
                success: function(hasil) {
                    //end step
                    toastr.success('LPDU UM Berhasil disimpan.',  'Info', { positionClass: 'toast-bottom-right', timeOut: 5000, "progressBar": true });
                    $("#btnShow1").removeAttr('disabled',true).text('Simpan dan Lanjut');
                    
                },
                error: function(err) {
                    console.log(err)
                    $("#btnShow1").removeAttr('disabled',true);
                    toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });
                }
            });
          
        },
        allowOutsideClick: function allowOutsideClick()
        {
            return !Swal.isLoading();
        }
    }).then(function(result)
    {
        console.log("hasil "+result);

        if (result.value)
        {
            $("#btnShow1").removeAttr('disabled',true).text('Simpan dan Lanjut');
            if ($('.show').next(".tab-pane").length) {
                console.log("oke oce");
                $('.show').removeClass('show active')
                    .next(".tab-pane")
                    .addClass('show active');
                    $('#lpduthree').removeClass('active');
                    $('#dtpendukung').addClass('active');
            }
        }
    });    
});


$("input[name='hargapokok']").keyup(function(){
    const a = $("input[name='sewakontrak']").val();
    const b = $("input[name='gaji']").val();
    const c = $("input[name='listriktelepon2']").val();
    const d = $("input[name='transportasi2']").val();
    const e = $("input[name='pengeluaranlainnya2']").val();

    const hasil = a+b+c+d+e;
    
    $("input[name='pengeluaranusaha']").val(hasil);
});