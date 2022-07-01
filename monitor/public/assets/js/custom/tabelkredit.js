 //################################## reset data debitur ########################
 $(".resetsearch").click(function(){
    $("#js-filter-contacts").val("");
    document.getElementById('js-filter-contacts').focus();
    $('#js-contacts').html('');
})

//################################## check data debitur ########################
$("#js-filter-contacts").keyup(function(){
    var query = $(this).val();

    if(query.length > 2){
        fetch_customer_data(query);
    }
});


//################################## get data debitur ########################
function fetch_customer_data(query = '') {
    
    $.ajax({
            url: 'nasabah/selectDebtor',
            method: 'GET',
            data: {query: query},
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $("#formAdd").trigger("reset");
                
                $('#js-contacts').html(data.table_data);
                                  
            },error: function (error){
                
                toastr.error('Maaf, jaringan koneksi gagal.',  'Informasi', { positionClass: 'toast-bottom-right', timeOut: 10000, "progressBar": true });

            }
        })
}

// ##################### check data from local
function selectCheckData(id){

    console.log(id.toString());
    var query = '';
    query = id;

  
    $.ajax({

        url: 'nasabah/selectCheckData',
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