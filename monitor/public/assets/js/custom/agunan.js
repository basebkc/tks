

$(document).ready(function()
{
    $(":input").inputmask();

    // enable clear button 
    $('.tanggal').datepicker(
    {
        todayBtn: "linked",
        clearBtn: true,
        todayHighlight: true,
        
    });
    

});



$(".test1").hide();
function show() {
    console.log('asdasdasd');

    $(".test1").show();
    $.scrollTo($('.show'), 1000);

}

$(".btnReset").click(function(){
    $(".modal-title").text("Tambah");
    $("#jenisagunan").removeAttr('disabled');
    $("#formAguTanah").trigger("reset");
});


    



$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

   
    //########## show table collateral tanah & bangunan
    showAgunanTanah();
    
    //########### save collateral tanah & bangunan #########
    $("#btnSimpanAgunanTanah").click(function(e) {
        e.preventDefault();

        const jenis = $('#jenisagunan').val();

        if(jenis == 6){
            //============== ARRAY AGUNAN TANAH ==============//
            if($("select[name='jenis_pemilik']").val() == ''    ||
                $("input[name='no_pemilik']").val() == ''      || 
                $("select[name='IMB']").val()   == ''          ||
                $("input[name='nilai_taksasi']").val() == ''   ||
                $("input[name='luas_tanah_bangunan']").val() == '' ||
                $("input[name='jatuh_tempo_shgb']").val() == '' ||
                $("input[name='lokasi']").val()   == ''
                ){
                toastr.error('Mohon di isi dengan lengkap.',  'Info', 
                            { positionClass: 'toast-top-right', timeOut: 3000 }
                        );
            }else{
                var object = {
                    jenisagunan     : jenis,
                    idagunan        : $("input[name='idagunan']").val(),
                    id_debitur      :$("#id_debitur_step2").val(),
                    jenis_pemilik   : $("select[name='jenis_pemilik']").val(),
                    no_pemilik      :$("input[name='no_pemilik']").val(),
                    nama_pemilik    :$("input[name='nama_pemilik']").val(),
                    IMB             :$("select[name='IMB']").val(),
                    luas_tanah_bangunan   :$("input[name='luas_tanah_bangunan']").val(),
                    jatuh_tempo_shgb   :$("input[name='jatuh_tempo_shgb']").val(),
                    lokasi          :$("input[name='lokasi']").val(),
                    nilai_taksasi   :$("input[name='nilai_taksasi']").val(),
                    alamat          :$("textarea[name='alamatagunan']").val(),
                    deskripsi       :$("textarea[name='deskripsiTanah']").val()
                };
                
            }
        }else if(jenis == 5){
          
            //============== ARRAY AGUNAN KENDARAAN ==============//
                if($("select[name='jenis_kendaraan']").val() == '' ||
                    $("input[name='merk']").val()           == '' || 
                    $("input[name='tahun']").val()          == '' ||
                    $("input[name='nobpkb']").val()         == '' ||
                    $("input[name='nomesin']").val()        == '' ||
                    $("input[name='norangka']").val()       == '' ||
                    $("input[name='nopolisi']").val()       == '' ||
                    $("input[name='nilaitaksasi']").val()   == '' ||
                    $("input[name='namapemilik2']").val()    == '' 
                    
                    ){
                    toastr.error('Mohon di isi dengan lengkap.',  'Info', 
                                { positionClass: 'toast-top-right', timeOut: 3000 }
                            );
                    }else{
                    var object = {
                        id_debitur        :$("#id_debitur_step2").val(),
                        idagunan        : $("input[name='idagunan']").val(),
                        jenisagunan       : jenis,
                        jenis_kendaraan   : $("select[name='jenis_kendaraan']").val(),
                        merk              :$("input[name='merk']").val(),
                        tahun             :$("input[name='tahun']").val(),
                        nobpkb            :$("input[name='nobpkb']").val(),
                        nomesin           :$("input[name='nomesin']").val(),
                        norangka          :$("input[name='norangka']").val(),
                        nopolisi          :$("input[name='nopolisi']").val(),
                        nilai_taksasi     :$("input[name='nilaitaksasi']").val(),
                        nama_pemilik       :$("input[name='namapemilik2']").val(),
                        deskripsi         :$("textarea[name='deskripsiTanah']").val(),
                        alamat            :$("textarea[name='alamatagunan']").val(),
                    };  
                    
                }

        }else{
            //============== ARRAY AGUNAN LAINNYA ==============//

            if($("input[name='jenisjaminan3']").val()   == ''    ||
                $("input[name='namapemilik3']").val()    == ''    || 
                $("input[name='jumlah_tunjangan']").val()    == ''){
                    toastr.error('Mohon di isi dengan lengkap.',  'Info', 
                        { positionClass: 'toast-top-right', timeOut: 3000 }
                    );
            }else{
                var object = {
                    jenisjaminan    : $("input[name='jenisjaminan3']").val(),
                    jenisagunan     : jenis,
                    id_debitur      : $("#id_debitur_step2").val(),
                    idagunan        : $("input[name='idagunan']").val(),
                    nama_pemilik    :$("input[name='namapemilik3']").val(),
                    deskripsi       :$("textarea[name='deskripsiTanah']").val(),
                    nilai_taksasi   : $("input[name='jumlah_tunjangan']").val(),
                    alamat          :$("textarea[name='alamatagunan']").val(),
                };
            }
        }

        $.ajax({
            type: "POST",
            url: base_url+"/agunan/store",
            data: object,
            success: function(hasil) {

                $('.modal').each(function(){
                    $(this).modal('hide');
                });

                showAgunanTanah();
                
                toastr.success('Data berhasil disimpan.',  'Info', 
                    { positionClass: 'toast-top-right', timeOut: 3000 }
                );    
            },
            error: function(err) {
                console.log(err)
                toastr.error('Data gagal disimpan.',  'Info', 
                    { positionClass: 'toast-top-right', timeOut: 3000 }
                );
                    
            },
        });  
    
    });

  
});


//###################### function agunan tanah & bangunan ####################

function showAgunanTanah(){
   
    const id_debitur = $("#id_debitur_step2").val();
    $.get(base_url+"/agunan/tanah/"+ id_debitur ,{}, function(data,status){
      
        $("#showAgunanTanah").html(data);
    })
}


function editAgunan(idagunan){
    
        $.ajax({
            url: base_url+"/agunan/"+idagunan+'/'+id_debitur,
            type:'GET',
            data: { }
        }).done(function(data){
        
        if(data.data.jenisagunan == 6){
            $(".agunantanah").show();
            $(".agunankend").hide();
            $(".agunanlainnya").hide();

            $(".modal-title").text("Edit Jaminan Sertifikat Tanah");
            $("select[name='jenisagunan']").val(data.data.jenisagunan);
            $("select[name='jenis_pemilik']").val(data.data.jenis_kepemilikan);
            $("input[name='nama_pemilik']").val(data.data.nama_pemilik);
            $("input[name='no_pemilik']").val(data.data.no_pemilik);
            $("select[name='IMB']").val(data.data.IMB);
            $("input[name='luas_tanah_bangunan']").val(data.data.luas_tanah_bangunan);
            $("input[name='jatuh_tempo_shgb']").val(data.data.jatuh_tempo_shgb);
            $("input[name='lokasi']").val(data.data.lokasi);
            $("input[name='nilai_taksasi']").val(data.data.nilai_taksasi);
            $("input[name='iddebituredit']").val(data.data.id_debitur);
            $("textarea[name='alamatagunan']").val(data.data.alamat);
            $("textarea[name='deskripsiTanah']").val(data.data.deskripsi);

           
        }else if(data.data.jenisagunan == 5){
            console.log(data)
            $(".agunantanah").hide();
            $(".agunankend").show();
            $(".agunanlainnya").hide();
            
            $(".modal-title").text("Edit Jaminan BPKB");
            $("select[name='jenis_kendaraan']").val(data.data.jenis_kendaraan);
            $("select[name='jenisagunan']").val(data.data.jenisagunan);

            $("input[name='merk']").val(data.data.merk);
            $("input[name='tahun']").val(data.data.tahun);
            $("input[name='nobpkb']").val(data.data.no_bpkb);
            $("input[name='nomesin']").val(data.data.no_mesin);
            $("input[name='norangka']").val(data.data.no_rangka);
            $("input[name='nopolisi']").val(data.data.no_polisi);
            $("input[name='nilaitaksasi']").val(data.data.nilai_taksasi);
            $("input[name='iddebituredit']").val(data.data.id_debitur);
            $("textarea[name='alamatagunan']").val(data.data.alamat);
            $("input[name='namapemilik2']").val(data.data.nama_pemilik);
            $("textarea[name='deskripsiTanah']").val(data.data.deskripsi);
        }else{
            $(".agunantanah").hide();
            $(".agunankend").hide();
            $(".agunanlainnya").show();

            $(".modal-title").text("Edit BPKB");
           
            $("select[name='jenisagunan']").val(data.data.jenisagunan);
            $("input[name='jenisjaminan3']").val(data.data.jaminan);
            $("input[name='namapemilik3']").val(data.data.nama_pemilik);
            $("input[name='jumlah_tunjangan']").val(data.data.nilai_taksasi);
            $("input[name='deskripsi3']").val(data.data.deskripsi2);
            $("input[name='alamatagunan']").val(data.data.alamat);
            $("textarea[name='alamatagunan']").val(data.data.alamat);
            $("textarea[name='deskripsiTanah']").val(data.data.deskripsi);
            $("input[name='iddebituredit']").val(data.data.id_debitur);
            
        }
        $("input[name='idagunan']").val(data.data.id);
        $("select[name='jenisagunan']").attr('disabled',true)
        $("#tanahbangunan").modal({show: true});
        
        
    });

}


//###################### function agunan kendaraan ####################
function showAgunanKendaraan(){
    $.get(base_url+"/agunan/kendaraan/"+ id_debitur,{}, function(data,status){
        $("#showAgunanKendaraan").html(data);
    })
}

function editAguKendaraan(idagunan,id_debitur){
    
    $.ajax({
        url: base_url+"/agunan/kendaraan/"+idagunan+'/'+id_debitur,
        type:'GET',
        data: { }
    }).done(function(data){
        console.log(data)

        $(".modal-title").text("Edit BPKB");
        $("input[name='idagunankend']").val(data.data.id);
        $("select[name='jenis_kendaraan']").val(data.data.jenis_kendaraan);
        $("input[name='merk']").val(data.data.merk);
        $("input[name='tahun']").val(data.data.tahun);
        $("input[name='nobpkb']").val(data.data.no_bpkb);
        $("input[name='nomesin']").val(data.data.no_mesin);
        $("input[name='norangka']").val(data.data.no_rangka);
        $("input[name='nopolisi']").val(data.data.no_polisi);
        $("input[name='nilaitaksasi']").val(data.data.nilai_taksasi1);
        $("input[name='namapemilik']").val(data.data.pemilikmotor);

        $("#kendaraan").modal({show: true});
        
    });

}

//###################### function agunan lainnya ####################
function showAgunanLainnya(){
    $.get(base_url+"/agunan/lainnya/"+ id_debitur,{}, function(data,status){
        
        $("#showAgunanLainnya").html(data);
    });
}

function editAguLainnya(idlainnya,id_debitur){
    
    $.ajax({
        url: base_url+"/agunan/lainnya/"+idlainnya+'/'+id_debitur,
        type:'GET',
        data: { }
    }).done(function(data){
        console.log(data);

        $(".modal-title").text("Edit BPKB");
        $("input[name='idlainnya']").val(data.data.id);
        $("input[name='jenisjaminan3']").val(data.data.jaminan);
        $("input[name='namapemilik3']").val(data.data.nama_pemilik2);
        $("input[name='jumlah_tunjangan']").val(data.data.jumlah_tunjangan);
        $("input[name='deskripsi3']").val(data.data.deskripsi2);
      

        $("#jenislainnya").modal({show: true});
        
    });

}