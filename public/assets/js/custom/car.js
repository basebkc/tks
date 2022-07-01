

function getCar(formData){
    //check sudah dihitung atau belum

    var check = "";

        $.ajax({
                url: url+'api/getcar',
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
                        title: "Silakan menunggu sedang proses menghitung..",
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

                        if (result.value)
                        {
                            swalWithBootstrapButtons.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                        }
                        else if (
                            result.dismiss === Swal.DismissReason.cancel
                        )
                        {
                            swalWithBootstrapButtons.fire(
                                "Cancelled",
                                "Your imaginary file is safe :)",
                                "error"
                            );
                            console.log("error cek");
                        }
                    });
                },
                success: function(hasil) {
                    check = hasil.data.length;
                    var kredit     = 0;
                    var debit      = 0;
                    var jumlah     = 0;
                    
                    console.log("get car "+hasil)
                    console.log("count "+check)

                    if(check > 0){
                            console.log("cek sudah ada data")
                           
                            console.log(hasil.data)

                            $.each(hasil.data,function(key,value){
                                console.log(value)

                                if(value.jumlah != null){
                                    jumlah = value.jumlah;
                                }
                               

                                //------------- akumulasi anak kode perkiraan 100 -----------//
                                if(value.kode == 100){
                                    kredit += parseFloat(jumlah);
                                }else
                                
                                //------------- akumulasi anak kode perkiraan 200 -----------//
                                if(value.kode == 200){
                                    debit += parseFloat(jumlah);
                                }

                            });

                            console.log(kredit);
                            console.log(debit);

                            //----------- pembilang  ------------// 
                            $("#carRumus").html("("+kredit+"/"+debit+")*100%")

                            $("#btnShow1").removeAttr('disabled',true).text('Hitung');
                            
                            //----------- proses cek nilai  ------------// 
                            var showLDR = (kredit/debit)*100;
                            if(isNaN(showLDR)){     
                                Swal.fire(
                                {
                                    type: "error",
                                    title: "Maaf, Cash Ration untuk check di interval ulang.",
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                
                            }else{
                                // toastr.success('Sukses.',  'Informasi', { closeButton: true, positionClass: 'toast-bottom-right' });
                                Swal.fire(
                                {
                                    type: "success",
                                    title: "Sukses dihitung.",
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                $("#showcar").html(showLDR.toFixed(2) + " %");
                            }

                            
                    }else{
                        // hitung(formData,"car");
                        var nominal = 0;
                        var cara_hitung = $("#carahitung").val();
                        console.log("mulai hitung")
                    
                        $.ajax({
                                    url: url+'api/gettranscar',
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    data: formData,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: function(){
                                        var timerInterval;
                                        Swal.fire(
                                        {
                                            title: "Silakan menunggu sedang proses menghitung..",
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

                                            if (result.value)
                                            {
                                                swalWithBootstrapButtons.fire(
                                                    "Deleted!",
                                                    "Your file has been deleted.",
                                                    "success"
                                                );
                                            }
                                            else if (
                                                result.dismiss === Swal.DismissReason.cancel
                                            )
                                            {
                                                swalWithBootstrapButtons.fire(
                                                    "Cancelled",
                                                    "Your imaginary file is safe :)",
                                                    "error"
                                                );
                                                console.log("error cek");
                                            }
                                        });
                                    },
                                    success: function(hasil) {
                                        var id          ="";
                                        var kode        ="";
                                        var string        = "";
                                        let nilai = 0;
                                        
                                        //----- proses simpan transaksi ----------//
                                        for(i=0;i<hasil.data[0].length;i++){
                                            
                                            nilai = hasil.data[0][i].nominal;
                                            
                                            string = hasil.data[0][i].kode;
                                            //------------- akumulasi anak kode perkiraan 100 -----------//
                                            if(string.includes('10') == true || string.includes('110') == true || string.includes('111') == true){
                                                kredit += parseFloat(hasil.data[0][i].nominal);
                                            }else
                                            
                                            //------------- akumulasi anak kode perkiraan 200 -----------//
                                            if(string.includes('20') == true || string.includes('210') == true){
                                                debit += parseFloat(hasil.data[0][i].nominal);
                                            }

                                            $.ajax({
                                                url: url+'api/car/store',
                                                type: 'POST',
                                                data: {
                                                    'kode'              : hasil.data[0][i].kode,
                                                    'nama_perkiraan'    : hasil.data[0][i].nama_perkiraan,
                                                    'komponen'          : hasil.data[0][i].komponen,
                                                    'jumlah'            : Number(nilai).toFixed(2),
                                                    'kode_perk'         : hasil.data[0][i].kode_perk,
                                                    'cara_hitung'       : cara_hitung,
                                                    'kode_kantor'       : hasil.data[0][i].kode_kantor,
                                                    'tgl_trans'         : hasil.data[0][i].tanggal
                                                },
                                                dataType:'json',
                                                success: function (response) {
                                                   
                                                    console.log(response.data.id);
                                                    console.log("kode : "+response.data.kode);
                                                    if(response.data.kode == 100 || response.data.kode == 200){
                                                        id = response.data.id;
                                                        kode = response.data.kode;
                                                        if(kode == "100"){
                                                            nominal = kredit;
                                                            $("#modalinti").val(kredit);

                                                            console.log("modal inti "+ $("#modalinti").val());
                                                        
                                                        }else if(kode == "200"){
                                                            nominal = debit;
                                                        }

                                                        var form = new FormData();
                                                        form.append("id",id);
                                                        form.append("kode",kode);
                                                        form.append("jumlah",nominal);
                                                    
                                                        $.ajax({
                                                                    url: url+'api/car/update',
                                                                    type: 'POST',
                                                                    headers: {
                                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                    },
                                                                    data: form,
                                                                    dataType:'json',
                                                                    cache: false,
                                                                    contentType: false,
                                                                    processData: false,
                                                                    success: function(hasil) {
                                                                        console.log("update sukses");
                                                                    },
                                                                    error: function(error){
                                                                        console.log("update error : "+ error);
                                                                    }
                                                                });
                                                    }
                                                    
                                                },
                                                error: function(error){
                                                    console.log(error);
                                                    toastr.error('Maaf, penyimpanan data gagal.',  'Informasi', { closeButton: true, positionClass: 'toast-bottom-right' });
                                                }
                                            });

                                        }

                                        //----------- pembilang  ------------// 
                                        $("#carRumus").html("("+kredit.toFixed(2)+"/"+debit.toFixed(2)+")*100%")


                                        $("#btnShow1").removeAttr('disabled',true).text('Hitung');
                                    
                                        //----------- proses cek nilai  ------------// 
                                        var show = (kredit.toFixed(2)/debit.toFixed(2))*100;
                                        if(isNaN(show)){     
                                                toastr.error('Maaf, CAR untuk check di interval ulang.',  'Informasi', {  closeButton: true, positionClass: 'toast-bottom-right' });

                                        }else{
                                                toastr.success('Sukses.',  'Informasi', { closeButton: true, positionClass: 'toast-bottom-right' });
                                        }

                                        $("#showcar").html(show.toFixed(2) + " %");
                                        Swal.fire(
                                        {
                                            type: "success",
                                            title: "Sukses dihitung.",
                                            showConfirmButton: false,
                                            timer: 3000
                                        });
                                        
                                    },
                                    error: function(err) {
                                        console.log(err)
                                        $("#btnShow1").removeAttr('disabled',true).text('Hitung');
                                    
                                        toastr.error('Proses hitung gagal,silakang cek koneksi internet anda.',  'Informasi', { closeButton: true, positionClass: 'toast-bottom-right' });
                                        Swal.fire(
                                            {
                                                type: "error",
                                                title: "Gagal dihitung.",
                                                showConfirmButton: false,
                                                timer: 3000
                                            });
                                    }
                                });
                    }
                   
                },
                error: function(err) {
                    console.log(err)
                }
            });
      
}