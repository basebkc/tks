var id_deb;
    $( window ).on( "load", function() {
        var url = window.location.href;
        var url_array = url.split('/') // Split the string into an array with / as separator
        id_deb = url_array[url_array.length-2];  // Get the last part of the array (-1)
    });

    //===================== upload KTP ========================//
    FilePond.setOptions({
        server: {
            url: 'analisa/uploadFile',
        
            process: {
                
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                withCredentials: false,
                onload: (response) => response.key,
                onerror: (response) => response.data,
                ondata: (formData) => {
                    formData.append('id_debitur', id_deb);
                
                    return formData;
                },
            },
            revert: {
                url: '/deleteFile/'+id_deb,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                onload: function (x) {

                    // X - empty, why????
                    console.log(x)

                }
            }
        }
    });
    const inputElementktp = document.querySelector('input[name="datapendukung"]');
    const pondktp = FilePond.create( inputElementktp );
