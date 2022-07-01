
$("#getPengajuan").click(function(e){
    e.preventDefault();

    fetch_customer_data();
        
});

// $("#getPengajuan").click(function(e){
//     e.preventDefault();

//     fetch_customer_data();
        
// });

//################################## get data debitur ########################
function fetch_customer_data(query = '') {
    
    $.ajax({
            url: 'getPengajuanKredit',
            method: 'GET',
            data: {query: query},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                // $("#formAdd").trigger("reset");
                
                $("#showDebitur").modal('show');
                $('#js-contacts').html(data.table_data);
                                  
            },error: function (error){
                
                toastr.error('Maaf, jaringan koneksi gagal.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });

            }
        })
}


// ##################### get credits data complete 
function selectCheckData(id){

    console.log(id.toString());
    var query = '';
    query = id;

  
    $.ajax({

        url: 'analisa/selectCheckData',
        method: 'GET',
        data: {query: query},
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

            $("#formAdd").trigger("reset");
            $('#js-contacts').html('');

            if(data.status == 1){
                $('#js-contacts').html(data.info);
            }else{
                window.location.href= 'nasabah/edit/'+data.info+'/1';
                
            }
                              
        }

    });
}


$(document).ready(function(){

    $("form#formLpdu1").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);
        $ajax({
            url:'storelpdu',
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
                console.log(hasil);
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

})

