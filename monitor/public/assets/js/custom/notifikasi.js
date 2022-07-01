
var url;

var controls = {
    leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
    rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
}


//button add to clear form
$("#resetModal").click(function(){

    $("#form").trigger("reset");

    var bagianForm = $("#judul").val();

    if(bagianForm == "tabungan"){
        $("#no_rekening").val("").change();
        $("#kode").val("").change();
        $("#jenis_notif").val("").change();
        $("#status").val("").change();
    }
    
    url = getUrl(bagianForm);

    $(".modal-title").text("Tambah "+url.judul);

});


function getModalEdit($id){

    var bagianForm = $("#judul").val();

    url = getUrl(bagianForm);

    console.log(url);

    $(".modal-title").text("Edit Data "+url.judul);

    openBox($id,hapus=false,url.url);

}

 // Get URL Form
 function getUrl(bagianForm){

    var urlTemp,judul; 
    if(bagianForm == "daftarnasabah"){
        urlTemp = "daftarnasabah";
        judul   = "Daftar Nasabah";
    }else 
    if(bagianForm == "master"){
        urlTemp = "master";
        judul   = "Master";
    }else
    if(bagianForm == "tabungan"){
        urlTemp = "notifikasi/tabungan";
        judul   = "Notifikasi Transaksi Tabungan";
    }

    return { judul : judul , url : urlTemp };
    
}
// modal pop up show //
function openBox(id,hapus,url) {
            
    if(id && hapus == false){
        $.ajax({
            url: url+"/show/"+id,
            type:'GET',
            data: { }
        }).done(function(data){
            
            console.log(data)
            //show in modal pop up
            showModal(data,url);
            
        });
    }if(id && hapus == true){
        $.ajax({
            url: url+"/delete/"+id,
            type:'GET',
            data: { }
        }).done(function(data){
            
            toastr.success('Data berhasil dihapus.')
            location.reload();
        })
    } if(id == null && hapus == false){
        $.ajax({
        url: url+"/getlastid",
            type:'GET',
            data: { }
        }).done(function(data){
            
            var id = "";
            if(url == "jabatan"){
                id = data.data.id_jab;
            }else
            if(url == "mutasi"){
                
                if(data.data == null){
                    id = 1;
                }else{
                    id = data.data.id;
                }
                
            }else
            if(url == "menu"){
                
                if(data.data == null){
                    id = 1;
                }else{
                    id = data.data.id;
                }
            }
            console.log("cek");
            console.log(data);
            $("#id").val(id+1);
            $("#pilih").modal({show: true});
        });
        
    }
    
}

//show modal data to edit
function showModal(data,url){
    
    if(url == "daftarnasabah"){
        id = data.data.id;
        $("#id").val(id);
        $("#no_rekening").val(data.data.no_rekening);
        $("#no_phone").val(data.data.no_hp);
        $("#no_wa").val(data.data.no_wa);
        $("#status").val(data.data.status);
        var mulaitanggal =   moment(data.data.tgl_daftar).format("MM/DD/Y");
        var tgl_akhir =   moment(data.data.tgl_akhir).format("MM/DD/Y");
        if(data.data.status_wa == "on"){
            $("#status_wa").attr("checked","checked");
        }

        if(data.data.status_sms == "on"){
            $("#status_sms").attr("checked","checked");
        }
        
        
        $("#mulaitanggal").val(mulaitanggal);
        $("#tanggalakhir").val(tgl_akhir);
        $("#keterangan").val(data.data.keterangan);
    }else
    if(url == "notifikasi/tabungan"){
        $("#id").val(id);
        $("#no_rekening").val(data.data.no_rekening).change();
        $("#kode").val(data.data.kode_trans).change();
        $("#jenis_notif").val(data.data.jenis_notif).change();
        $("#status").val(data.data.status_notif).change();
        var mulaitanggal =   moment(data.data.tgl_aktif).format("MM/DD/Y");
        var tgl_akhir =   moment(data.data.sampai_tgl).format("MM/DD/Y");
        $("#mulaitanggal").val(mulaitanggal);
        $("#tanggalakhir").val(tgl_akhir);
    }else
    if(url == "master"){
        $("#kode").val(data.data.kode_trans).change();
        $("#keterangan").val(data.data.keterangan);
        $("#isi").val(data.data.isi_pesan);
    }
        

    $("#daftar").modal({show: true});
}

var runDatePicker = function()
 {

     $('.tanggal').datepicker(
     {
         orientation: "top left",
         todayHighlight: true,
         templates: controls
     });
 }


$(document).ready(function()
{   

    $(function()
    {
        $('.select2').select2();

    });
    
    runDatePicker();;

    // initialize Master notifikasi sms
    $('#tabelNasabah').dataTable(
    {
        responsive: true,
        
    });

    //initialize History Notif Sms
    $('#tabelHistoryTransaksiNotifSms').dataTable(
    {
        responsive: true,
        
    });


    $("form#form").submit(function(e){
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
                url:  url.url+"/store",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    
                    console.log(result);
                    console.log(result.status.message);

                    if(result.status == 'failed'){
                        
                        toastr.warning(result.message,  'Info', 
                            { "closeButton": true,"progressBar": true,positionClass: 'toast-top-center', timeOut: 5000 }
                        );

                    }else{

                        toastr.success('Data berhasil disimpan.',  'Info', 
                            { "closeButton": true,"progressBar": true,positionClass: 'toast-top-center', timeOut: 5000 }
                        );
                        
                        $('.modal').each(function(){
                            $(this).modal('hide');
                        });

                        setInterval(function () {
                            location.reload();
                        }, 2000); // Execute somethingElse() every 2 seconds.
                        
                    }

                    // toastr.success('Data berhasil disimpan.',  'Info', { positionClass: 'toast-top-center', timeOut: 10000 })
                    
                    
                },
                error:function(error){
                    console.log(error.responseJSON.message)
                    toastr.error('Jaringan internet terputus.',  'Info', 
                        { "closeButton": true,"progressBar": true,positionClass: 'toast-top-center', timeOut: 10000 }
                    );
                    
                }
            })
        

    });


});

