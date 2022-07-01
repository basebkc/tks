$(function()
{
    $('.select2').select2();

});


$("form#step1").submit(function(e) {
    e.preventDefault();
    var formData    = new FormData(this);
    var url         = 'store';
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

            // if(hasil.message == 0){
            //     toastr.error('Maaf, proses simpan data gagal .',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });
            // }else{

            //     //end step
                toastr.success('Step 1 Berhasil disimpan.',  'Info', { positionClass: 'toast-bottom-right', timeOut: 6000, "progressBar": true });
                setTimeout(function(){ 
                    window.location = 'edit/'+hasil.message.id+'/2';
                }, 5000);
                
                // window.location.replace("edit/"+hasil.message.id); 
                

            // }
            
        },
        error: function(err) {
            
            toastr.error('Silakan dilengkapi kolom yang masih kosong.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });

        },
        complete:function(data){
            // Hide image container
            
            $("#btnShow1").text('Next').attr('disabled',false);
        }
    });

});