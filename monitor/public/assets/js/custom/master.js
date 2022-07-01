

var url = "";

//button add to clear form
$("#resetModal").click(function(){

    $("#formUser").trigger("reset");

    var bagianForm = $("#judul").val();
    
    $("#password").prop('required',true);
    $(".password").show();
    $("#password_confirmation").prop('required',true);



});

function getModalEdit($id){
    var bagianForm = $("#judul").val();
    url = getUrl(bagianForm);
    console.log(url);
    $(".modal-title").text("Edit Data "+bagianForm);
    openBox($id,hapus=false,url);
}

function getModalEditUser(id){

    
    $.ajax({
        url: "user/show/"+id,
        type:'GET',
        data: { }
    }).done(function(data){
        
        $(".modal-title").text("Edit Data User");
        $("#judul").val("edit");
        //show in modal pop up
        id = data.data.id;
        $("#id").val(id);
        $("#name").val(data.data.name);
        $("#email").val(data.data.email);
        $("#kantor").val(data.data.kode_kantor).change();
        $("#role_id").val(data.data.role_id).change();

        $("#password").removeAttr("required");
        $(".password").hide();
        $("#password_confirmation").removeAttr("required");

        $("#pilih").modal({show: true});
        
    });
    

}

 // Get URL Form
 function getUrl(bagianForm){
    var urlTemp; 
    if(bagianForm == "mutasi"){
        urlTemp = "mutasi";
    }else 
    if(bagianForm == "Jabatan"){
        urlTemp = "jabatan";
    }else
    if(bagianForm == "Menu"){
        urlTemp = "menu";
    }else
    if(bagianForm == "User"){
        urlTemp = "user";
    }

    return urlTemp;

}

    // modal pop up show //
    function openBox(id,hapus,url) {
            
        if(id && hapus == false){
            $.ajax({
                url: url+"/show/"+id,
                type:'GET',
                data: { }
            }).done(function(data){
               
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
                }else
                if(url == "user"){
                    
                    if(data.data == null){
                        id = 1;
                    }else{
                        id = data.data.id;
                    }
                }
                $("#id").val(id+1);
                $("#pilih").modal({show: true});
            });
            
        }
        
    }

    function showModal(data,url){
        console.log(data);
        if(url == "jabatan"){
            id = data.data.id_jab;
            $("#id").val(id);
            $("#kode").val(data.data.kode);
            $("#nama").val(data.data.jabatan);
            $("#tunjangan").val(data.data.tunjangan);
            $("#gaji").val(data.data.gapok);
            $("#masa").val(data.data.m_kerja);
        }else
        if(url == "mutasi"){
            id = data.data.id;
            $("#id").val(id);
            $("#nip").val(data.data.nip);
            $("#nama").val(data.data.nip).change();
            $("#kan_asal").val(data.data.id_kan_asal).change();
            $("#jab_asal").val(data.data.id_jab_asal).change();
            $("#satgas_asal").val(data.data.id_satgas_asal).change();
            $("#kan_baru").val(data.data.id_kan_baru).change();
            $("#jab_baru").val(data.data.id_jab_baru).change();
            $("#satgas_baru").val(data.data.id_satgas_baru).change();
            $("#gol").val(data.data.gol).change();
            $("#jenis_mut").val(data.data.jenis_mutasi).change();
            var tmno_surat  = data.data.no_surat
            var no_surat = tmno_surat.split('/');
           
            $("#no_surat").val(no_surat[0]);
          
            var no_sur = "";
            for(i=1;i<no_surat.length;i++){
                
                if(no_surat[i] == "undefined"){
                    no_sur = "";
                }else {
                    no_sur += "/"+no_surat[i]; 

                }
            }

          
            $("#surat").text(no_sur);
            $("#jenis_mut").val(data.data.jenis_mutasi);
           
            var date = data.data.tgl_efektif;
            var arr = date.split(/ |,/);
            $("#tgl_efektif").val(arr[0]);

            var date1 = data.data.tgl_surat;
            var arr1 = date1.split(/ |,/);
            $("#tgl_surat").val(arr1[0]);

            $("#keterangan").val(data.data.keterangan);
            

        }else   
        if(url == "menu"){
            id = data.data.id;
            $("#id").val(id);
            $("#nama").val(data.data.name);
            $("#icon").val(data.data.icon);
            $("#url").val(data.data.url);
            $("#root").val(data.data.root);
        }

        $("#pilih").modal({show: true});
    }


    function getRomawi(no){
        if(no == "01"){
            result = "I";
        }else if(no == "02"){
            result = "II";
            
        }else if(no == "02"){
            result = "II";
        
        }else if(no == "03"){
            result = "III";
        
        }else if(no == "04"){
            result = "IV";
        
        }else if(no == "05"){
            result = "V";
        
        }else if(no == "06"){
            result = "VI";
        
        }else if(no == "07"){
            result = "VII";
        
        }else if(no == "08"){
            result = "VIII";
        
        }else if(no == "09"){
            result = "IX";
        
        }else if(no == "10"){
            result = "X";
        
        }else if(no == "11"){
            result = "XI";
        
        }else if(no == "12"){
            result = "XII";
        }

        return result;
    }


$(document).ready(function() {
    
    $(function()
    {
        $('.select2').select2();

    });

    var table;
    var hapus = false;
    

    table = $('#example').DataTable({
        lengthChange: false,
        scrollX: true,
        paging : false
    });

    table = $('#example2').DataTable({
        lengthChange: false,
        scrollX: true
    });

    $("#satgas_baru").change(function(){
        var jab_baru    = $("#jab_baru").val();
        var satgas      = $(this).val();
        $.ajax({
            url: "mutasi/master/cekdokumentsk/"+jab_baru+"/"+satgas,
            type:'GET',
            data: { }
        }).done(function(data){
            
            if(data.data == "ada"){

            }else{
                Swal.fire("Informasi.!", data.message, "error");
                $('.modal').each(function(){
                    $(this).modal('hide');
                });

            }
            
        });
    });

    // $( ".btnEditAction").click(function() {
    //     var bagianForm = $("#judul").val();
    //     url = getUrl(bagianForm);
        
    //     $(".modal-title").text("Edit Data "+bagianForm);
	// 	openBox($(this).attr("id"),hapus=false,url);
	// });
    
    $( ".btnTambahAction").button().on( "click", function() {
        $('#nama').val(null).trigger('change');
        var bagianForm = $("#judul").val();
        url = getUrl(bagianForm);
        
        $("#form").trigger("reset");
        
        $(".modal-title").text("Tambah Data "+bagianForm);
        openBox(id=null,hapus=false,url);
	});

    // $( ".btnDeleteAction").button().on( "click", function() {
    //     var result = confirm("Apakah data ini ingin dihapus?");

    //     var bagianForm = $("#judul").val();
    //     url = getUrl(bagianForm);

    //     if (result) {
    //         openBox($(this).attr("id"),hapus=true,url);
    //     }
	// });

  
    $("#tgl_efektif").change(function(){
        var a = $(this).val();
        console.log(a);
        var arr1 = a.split('-');
        console.log(arr1[0]);
        var bulan = getRomawi(arr1[1]);
        console.log("/KEP.DIR/PUD-BKC/MP/"+bulan+"/"+arr1[0]);
        $("#surat").text("/KEP.DIR/PUD-BKC/MP/"+bulan+"/"+arr1[0]);
    });
   

    $("form#form").submit(function(e){
        e.preventDefault();
        
        var formData = new FormData(this);
        var nosurat  = $("#no_surat").val()+$("#surat").text();

        formData.append("nip",$("#nip").val());
        formData.append("gol",$("#gol").val());
        formData.append("kan_asal",$("#kan_asal").val());
        formData.append("jab_asal",$("#jab_asal").val());
        formData.append("satgas_asal",$("#satgas_asal").val());
        formData.append("kan_baru",$("#kan_baru").val());
        formData.append("jab_baru",$("#jab_baru").val());
        formData.append("jenis_mut",$("#jenis_mut").val());
        formData.append("tgl_efektif",$("#tgl_efektif").val());
        formData.append("tgl_surat",$("#tgl_surat").val());
        formData.append("no_surat",nosurat);
        formData.append("keterangan",$("#keterangan").val());
        
        $.ajax({
                url:  url+"/store",
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
                        { positionClass: 'toast-top-center', timeOut: 5000 }
                    );
                
                    // toastr.success('Data berhasil disimpan.',  'Info', { positionClass: 'toast-top-center', timeOut: 10000 })
                    
                    $('.modal').each(function(){
                        $(this).modal('hide');
                    });
    
                    location.reload();
                    
                },
                error:function(error){
                    toastr.error('Jaringan internet terputus.','Info', { positionClass: 'toast-top-center', timeOut: 10000 });
                }
            })
        

    });

    $("form#formMenu").submit(function(e){
        e.preventDefault();
        
        var formData = new FormData(this);
        var nosurat  = $("#no_surat").val()+$("#surat").text();

        formData.append("id",$("#id").val());
        formData.append("nama",$("#nama").val());
        formData.append("url",$("#url").val());
        formData.append("icon",$("#icon").val());
        formData.append("root",$("#root").val());
        
        $.ajax({
                url:  url+"/store",
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
                        { positionClass: 'toast-top-center', timeOut: 5000 }
                    );
                    
                    $('.modal').each(function(){
                        $(this).modal('hide');
                    });
    
                    location.reload();
                    
                },
                error:function(error){
                    toastr.danger('Jaringan internet terputus.');
                }
            })
        

    });

    $("form#formUser").submit(function(e){
        e.preventDefault();

        var formData    = new FormData(this);

        passsword       = $("#password").val();
        password_confirmation = $("#password_confirmation").val();

        if(passsword != password_confirmation){
            toastr.warning('Passwords tidak sama.',  'Info', 
                { positionClass: 'toast-top-center', timeOut: 3000 }
            );
        }

        $.ajax({

            url:  "user/create",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response)
               
                    toastr.success('Data berhasil disimpan.',  'Info', 
                        { positionClass: 'toast-top-center', timeOut: 5000, progressBar: true }
                    );
                    
                    $('.modal').each(function(){
                        $(this).modal('hide');
                    });

                    location.reload();
               
                
            },error: function(error){
                console.log(error);
                toastr.error(error.responseText,  'Info', 
                    { positionClass: 'toast-top-center', timeOut: 5000, progressBar: true, }
                );
            }
        });
        
    });    


    

});









  

