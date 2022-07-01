var controls = {
    leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
    rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
}



//button add to clear form
$("#resetModal").click(function(){

    $("#form").trigger("reset");

    $(".modal-title").text("Tambah Konfigurasi");

    $("#kode").attr("readonly",false);

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
    
    if(bagianForm == "konfigurasi"){
        urlTemp = "konfigurasi";
        judul   = "Konfigurasi";
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
            if(url == "konfigurasi"){
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

//show modal data
function showModal(data,url){

    if(url == "konfigurasi"){
        id = data.data.id;
        $("#id").val(id);
        $("#isi").val(data.data.isi);
        $("#kode").val(data.data.kode);
        $("#kode").attr('readonly',true);
        $("#keterangan").val(data.data.keterangan);
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
                url:  "konfigurasi/store",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    
                
                    toastr.success('Data berhasil disimpan.',  'Info', 
                        { "closeButton": true,"progressBar": true,positionClass: 'toast-top-center', timeOut: 5000 }
                    );
                    
                    $('.modal').each(function(){
                        $(this).modal('hide');
                    });

                    setInterval(function () {
                        location.reload();
                    }, 2000); // Execute somethingElse() every 2 seconds.
                    
                
                    
                },
                error:function(error){
                    console.log(error.responseJSON.message)
                    toastr.error('Jaringan internet terputus.','Info', { positionClass: 'toast-top-center', timeOut: 10000 });
                }
            })
        

    });


});

