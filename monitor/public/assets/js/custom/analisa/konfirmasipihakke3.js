
$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function()
    {
        $('.select2').select2();

    });
    
    //########## show table showKonfirmasi
    showKonfirmasi();
});

function showKonfirmasi(){
   
    const nopengajuan = $("input[name='nopengajuan']").val();
    $.get(base_url+"/analisa/konfirmasi/"+ nopengajuan ,{}, function(data,status){
        $("#showKonfirmasi").html(data);
    })
}


$("form#formkonfirmasiorang").submit(function(e){
    e.preventDefault();
    
    var formData = new FormData(this);
    
    $.ajax({
        type : "POST",
        url : base_url + "/analisa/storekonfirmasi",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data : formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(hasil) {
            console.log(hasil)
            $('.modal').each(function(){
                $(this).modal('hide');
            });

            showKonfirmasi();
            
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