$("#printCr").click(function(){
    var tgl = $("input[name='tanggaltransaksi']").val();
    $(this).attr("href", base_url+"/tks/report/cr/"
        +tgl+"/"
        +$("select[name='kodekantor']").val()+"/"
        +$("select[name='carahitung']").val()
    );
});

$("#printCar").click(function(){
    var tgl = $("input[name='tanggaltransaksi']").val();
    $(this).attr("href", base_url+"/tks/report/car/"
        +tgl+"/"
        +$("select[name='kodekantor']").val()+"/"
        +$("select[name='carahitung']").val()
    );
});

$("#printLdr").click(function(){
    var tgl = $("input[name='tanggaltransaksi']").val();
    $(this).attr("href", base_url+"/tks/report/ldr/"
        +tgl+"/"
        +$("select[name='kodekantor']").val()+"/"
        +$("select[name='carahitung']").val()
    );
}); 