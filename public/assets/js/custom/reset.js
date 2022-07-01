$("#reset").click(function(){
    var formData = new FormData();
    formData.append("tgl_trans",$("input[name='tanggaltransaksi']").val());
    formData.append("kode_kantor",$("select[name='kodekantor']").val());
    formData.append("cara_hitung",$("select[name='carahitung']").val());
    var cabang = "";

    if($("select[name='kodekantor']").val() == "Konsole"){
        cabang = "Kode Cabang Konsole";
    }else{
        var cb = $("select[name='kodekantor'] option:selected").text();
        cabang = "Cabang "+cb;
    }

    var swalWithBootstrapButtons = Swal.mixin(
        {
            customClass:
            {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger mr-2"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons
        .fire(
        {
            title: "<h6>Apakah anda yakin reset TKS Transaksi tanggal "+$("input[name='tanggaltransaksi']").val()+
                    " "+cabang+" ?</h6>",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, reset.",
            cancelButtonText: "Tidak",
            reverseButtons: true
        })
        .then(function(result)
        {
            if (result.value)
            {

                $.ajax({
                    url: url+'api/tks/reset',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){

                        Swal.fire(
                        {
                            title: "Silakan menunggu...",
                            onBeforeOpen: function onBeforeOpen()
                            {
                                Swal.showLoading();
                            },
                            onClose: function onClose()
                            {
                                clearInterval(timerInterval);
                            }
                        }).then(function(result)
                        {
                            
                        });
                    },
                    success: function(hasil) {
                        Swal.fire(
                            {
                                type: "success",
                                title: "Sukses di reset ulang, silakan hitung kembali.",
                                showConfirmButton: false,
                                timer: 5000
                            });
                    },
                    error: function(err) {
                        console.log(err)
                    }
                });
               
            }
            else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            )
            {
                swalWithBootstrapButtons.fire(
                    "Batal",
                    "Reset dibatalkan",
                    "error"
                );
            }
        });
   
});