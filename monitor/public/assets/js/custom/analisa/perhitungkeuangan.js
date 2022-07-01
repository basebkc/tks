$(document).ready(function(){
    $( '.uang' ).mask('000.000.000.000', {reverse: true});
});


// =============== hitung analisa keuangan pertanian padi ===============//
$("input[name='pendapatanusaha']").keyup(function(){
    const input = $(this).val();
    $("input[name='jumlahinvestasi']").val(input);
});

$("input[name='pengeringpadi']").keyup(function(){
     
    const sewa = $("input[name='sewalahan']").val(),
     benih = $("input[name='benihpadi']").val(),
     pestisida = $("input[name='pestisida']").val(),
     pemupukan = $("input[name='pemupukan']").val(),
     upah = $("input[name='upahpegawai']").val(),
     pengolahan = $("input[name='pengolahanlahan']").val(),
     pupuk = $("input[name='pupuk']").val(),
     penanam = $("input[name='penanambenih']").val(),
     penyemprotan = $("input[name='penyemprotan']").val(),
     pengeringpadi = $(this).val();

     const hasil = parseInt(sewa) + 
                parseInt(benih) + 
                parseInt(pestisida) + 
                parseInt(pemupukan) + 
                parseInt(upah) + 
                parseInt(pengolahan) + 
                parseInt(pupuk) + 
                parseInt(penanam) + 
                parseInt(penyemprotan) +
                parseInt(pengeringpadi);
    $("input[name='totalbiayaproduksi']").val(hasil);
});

$("input[name='hargapadi']").keyup(function(){
    const qty = $("input[name='qty']").val(), hargapadi = $("input[name='hargapadi']").val();
    const hasilpanen = parseInt(qty) * parseInt(hargapadi);
    $("input[name='hasilpanen']").val(hasilpanen);

    const totalbiayaproduksi = $("input[name='totalbiayaproduksi']").val();
    const total = parseInt(hasilpanen)-parseInt(totalbiayaproduksi)
    $("input[name='keuntunganusaha']").val(total);
})


//============== hitung analisa keuangan palawija jagung =======//
$("input[name='peralatan']").keyup(function(){
    const peralatan = $(this).val(),
    semprot = $("input[name='semprot']").val(),
    timbangan = $("input[name='timbangan']").val(),
    cangkul = $("input[name='cangkul']").val(),
    golok  = $("input[name='golok']").val(),
    terpal = $("input[name='terpal']").val(),
    bibit = $("input[name='bibit']").val(),
    timba = $("input[name='timba']").val(),
    selang = $("input[name='selang']").val(),
    pompa = $("input[name='pompa']").val(),
    pengolahan = $("input[name='pengolahan']").val(),
    gerobak = $("input[name='gerobak']").val(),
    keranjang = $("input[name='keranjang']").val();
    const jumlahinvestasi = parseInt(peralatan)+
                        parseInt(semprot)+
                        parseInt(timbangan)+
                        parseInt(cangkul)+
                        parseInt(golok)+
                        parseInt(terpal)+
                        parseInt(bibit)+
                        parseInt(timba)+
                        parseInt(selang)+
                        parseInt(pompa)+
                        parseInt(gerobak)+
                        parseInt(pengolahan)+
                        parseInt(keranjang);
                        console.log(jumlahinvestasi);
    $("input[name='penyusutanpembukaan']").val(Math.ceil(1/12*parseInt(pengolahan))); 
    $("input[name='penyusutanalat']").val(Math.ceil(1/62*parseInt(semprot))); 
    $("input[name='penyusutantimbangan']").val(Math.ceil(1/44*parseInt(timbangan))); 
    $("input[name='penyusutancangkul']").val(Math.ceil(1/44*parseInt(cangkul))); 
    $("input[name='penyusutangerobak']").val(Math.ceil(1/62*parseInt(gerobak))); 
    $("input[name='penyusutankeranjang']").val(Math.ceil(1/44*parseInt(keranjang))); 
    $("input[name='penyusutanbibit']").val(Math.ceil(1/62*parseInt(bibit))); 
    $("input[name='penyusutantimba']").val(Math.ceil(1/44*parseInt(timba))); 
    $("input[name='penyusutanselang']").val(Math.ceil(1/62*parseInt(selang))); 
    $("input[name='penyusutanpompa']").val(Math.ceil(1/62*parseInt(pompa))); 
    $("input[name='penyusutanterpal']").val(Math.ceil(1/62*parseInt(terpal))); 
    $("input[name='penyusutanalattambahan']").val(Math.ceil(1/44*parseInt(peralatan))); 
   
    $("input[name='jumlahinvestasipalawija']").val(jumlahinvestasi);
});

$("input[name='upahkerja']").keyup(function(){
    const upah = $(this).val();
    const penyusutanpembukaan = $("input[name='penyusutanpembukaan']").val(); 
    const penyusutanalat = $("input[name='penyusutanalat']").val(); 
    const penyusutantimbangan = $("input[name='penyusutantimbangan']").val(); 
    const penyusutancangkul = $("input[name='penyusutancangkul']").val(); 
    const penyusutangerobak = $("input[name='penyusutangerobak']").val(); 
    const penyusutankeranjang = $("input[name='penyusutankeranjang']").val(); 
    const penyusutanbibit = $("input[name='penyusutanbibit']").val(); 
    const penyusutantimba = $("input[name='penyusutantimba']").val(); 
    const penyusutanselang = $("input[name='penyusutanselang']").val(); 
    const penyusutanpompa = $("input[name='penyusutanpompa']").val(); 
    const penyusutanterpal = $("input[name='penyusutanterpal']").val(); 
    const penyusutanalattambahan = $("input[name='penyusutanalattambahan']").val(); 
    const hasil = parseInt(upah)+
                    parseInt(penyusutanpembukaan)+
                    parseInt(penyusutanalat)+
                    parseInt(penyusutantimbangan)+
                    parseInt(penyusutancangkul)+
                    parseInt(penyusutangerobak)+
                    parseInt(penyusutankeranjang)+
                    parseInt(penyusutanbibit)+
                    parseInt(penyusutantimba)+
                    parseInt(penyusutanselang)+
                    parseInt(penyusutanpompa)+
                    parseInt(penyusutanterpal)+
                    parseInt(penyusutanalattambahan);
    $("input[name='totalbiayatetap']").val(hasil);
    // const totalbiayaoperasional = hasil + 
});

$("input[name='BBM']").keyup(function(){
   
    const totalbiayavariable = parseInt($("input[name='hasilpupukalami']").val()) +
                parseInt($("input[name='hasilpupukkimia']").val()) +
                parseInt($("input[name='hasilpestisida']").val()) +
                parseInt($("input[name='hasillainnya']").val()) +
                parseInt($("input[name='hasiltransportasi']").val()) +
                parseInt($("input[name='hasilpengemas']").val()) + 
                parseInt($("input[name='hasilBBM']").val());
    $("input[name='totalbiayavariable']").val(totalbiayavariable);  
    $("input[name='totalbiayaopr']").val(parseInt(totalbiayavariable)+parseInt($("input[name='totalbiayatetap']").val()));
});

$("input[name='pupukalamihari']").keyup(function(){
    const hari = $(this).val();
    const pupukalami = $("input[name='pupukalami']").val(); 
    const hasil = parseInt(hari)*parseInt(pupukalami);
    
    $("input[name='hasilpupukalami'").val(hasil)
});

$("input[name='pupukkimiahari']").keyup(function(){
    const hari = $(this).val();
    const pupukkimia = $("input[name='pupukkimia']").val(); 
    const hasil = parseInt(hari)*parseInt(pupukkimia);
    
    $("input[name='hasilpupukkimia'").val(hasil)
});

$("input[name='pestisidahari']").keyup(function(){
    const hari = $(this).val();
    const pestisida = $("input[name='pestisidapalawija']").val(); 
    const hasil = parseInt(hari)*parseInt(pestisida);
    
    $("input[name='hasilpestisida'").val(hasil)
});

$("input[name='lainnyahari']").keyup(function(){
    const hari = $(this).val();
    const biayalainnya = $("input[name='lainnya']").val(); 
    const hasil = parseInt(hari)*parseInt(biayalainnya);
    
    $("input[name='hasillainnya'").val(hasil)
});

$("input[name='transportasihari']").keyup(function(){
    const hari = $(this).val();
    const transportasi = $("input[name='transportasipalawija']").val(); 
    const hasil = parseInt(hari)*parseInt(transportasi);
    
    $("input[name='hasiltransportasi'").val(hasil)
});

$("input[name='pengemashari']").keyup(function(){
    const hari = $(this).val();
    const pengemas = $("input[name='pengemas']").val(); 
    const hasil = parseInt(hari)*parseInt(pengemas);
    
    $("input[name='hasilpengemas'").val(hasil)
});

$("input[name='BBMhari']").keyup(function(){
    const hari = $(this).val();
    const pengemas = $("input[name='BBM']").val(); 
    const hasil = parseInt(hari)*parseInt(pengemas);
    
    $("input[name='hasilBBM'").val(hasil)
});

$("input[name='hargaperkilo']").keyup(function(){
    const panen =  $("input[name='panen']").val();
    const harga = $(this).val();
  
    $("input[name='totalpendapatan']").val(parseInt(panen)*parseInt(harga))

    $("input[name='totalpendapatanakhir']").val(parseInt($("input[name='totalpendapatan']").val()));
    $("input[name='totalbiayaoprakhir']").val(parseInt($("input[name='totalbiayaopr']").val()));
    $("input[name='hasillaba']").val(parseInt($("input[name='totalpendapatan']").val())-parseInt($("input[name='totalbiayaopr']").val()));

});

//============== hitung analisa keuangan unggas bebek =======//
$("input[name='hargasediakandang']").keydown(function(){
    const qty = $("input[name='qtysediakandang']").val();
    const harga = $(this).val();
    const hasil = parseInt(qty) * parseInt(harga);
    $("input[name='hasilsediakandang']").val(hasil);
});

$("input[name='hargabebek']").keydown(function(){
    const qty = $("input[name='qtybelibebek']").val();
    const harga = $(this).val();
    const hasil = parseInt(qty) * parseInt(harga);
    $("input[name='hasilbelibebek']").val(hasil);
});

$("input[name='qtypenjualan']").keydown(function(){
    const hasil1 = $("input[name='hasilsediakandang']").val();
    const hasil2 = $("input[name='hasilbelibebek']").val();
  
    const hasil = parseInt(hasil1) + parseInt(hasil2);
    $("input[name='totalinvestasibebek']").val(hasil);
});

$("input[name='hargajual']").keydown(function(){
    const hasil1 = $("input[name='qtypenjualan']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasilpenjualan']").val(hasil);
});

$("input[name='hargaafkir']").keydown(function(){
    const hasil1 = $("input[name='qtyafkir']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasilafkir']").val(hasil);
});

$("input[name='qtypakan']").keydown(function(){
    const hasil1 = $("input[name='hasilpenjualan']").val();
    const hasil2 = $("input[name='hasilafkir']").val();
  
    const hasil = parseInt(hasil1) + parseInt(hasil2);
    $("input[name='totalafkir']").val(hasil);
});

$("input[name='hargapakan']").keydown(function(){
    const hasil1 = $("input[name='qtypakan']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasilpakan']").val(hasil);
});

$("input[name='hargatenaga']").keydown(function(){
    const hasil1 = $("input[name='qtytenaga']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasiltenaga']").val(hasil);

    //total Biaya Operasional 
    $("input[name='totalbiayaoprbebek']").val(parseInt($("input[name='hasilpakan']").val())+parseInt($("input[name='hasiltenaga']").val()));
    $("input[name='totalpendapatanbebek']").val($("input[name='totalafkir']").val());
    $("input[name='biayaoprbebek']").val($("input[name='totalbiayaoprbebek']").val());
    $("input[name='pendapatanbersihbebek']").val(parseInt($("input[name='totalafkir']").val())-parseInt($("input[name='totalbiayaoprbebek']").val()));
    
});

//============== hitung analisa keuangan peternakan kambing =======//
$("input[name='hargakandang']").keydown(function(){
    const qty = $("input[name='qtybuatkandang']").val();
    const harga = $(this).val();
    const hasil = parseInt(qty) * parseInt(harga);
    $("input[name='hasilinvestasikandang']").val(hasil);
});

$("input[name='hargakambing']").keydown(function(){
    const qty = $("input[name='qtybelikambing']").val();
    const harga = $(this).val();
    const hasil = parseInt(qty) * parseInt(harga);
    $("input[name='hasilbelikambing']").val(hasil);
});

$("input[name='qtyhijauan']").keydown(function(){
    const hasil1 = $("input[name='hasilinvestasikandang']").val();
    const hasil2 = $("input[name='hasilbelikambing']").val();
  
    const hasil = parseInt(hasil1) + parseInt(hasil2);
    $("input[name='investasikambing']").val(hasil);
});

$("input[name='hargahijauan']").keydown(function(){
    const hasil1 = $("input[name='qtyhijauan']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasilhijaun']").val(hasil);
});

$("input[name='nilaiupahkerja']").keydown(function(){
    const hasil1 = $("input[name='qtyupahkerja']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasilupahkerja']").val(hasil);
});

$("input[name='hargakesehatankambing']").keydown(function(){
    const hasil1 = $("input[name='qtykesehatankambing']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasilkesehatankambing']").val(hasil);
});

$("input[name='qtypendapatankambing']").keydown(function(){
    const hasil1 = $("input[name='hasilhijaun']").val();
    const hasil2 = $("input[name='hasilupahkerja']").val();
    const hasil3 = $("input[name='hasilkesehatankambing']").val();
  
    const hasil = parseInt(hasil1) + parseInt(hasil2) + parseInt(hasil3);
    $("input[name='totalbiayaoprkambing']").val(hasil);
});

$("input[name='hargapenjualankambing']").keydown(function(){
    const hasil1 = $("input[name='qtypendapatankambing']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasilpenjualankambing']").val(hasil);
});

$("input[name='hargakotoran']").keydown(function(){
    const hasil1 = $("input[name='qtykotoran']").val();
    const hasil2 = $(this).val();
  
    const hasil = parseInt(hasil1) * parseInt(hasil2);
    $("input[name='hasilkotoran']").val(hasil);

    //total Biaya Operasional 
    $("input[name='totalpendapatankotoran']").val(parseInt($("input[name='hasilpenjualankambing']").val())+parseInt($("input[name='hasilkotoran']").val()));
    $("input[name='pendapatankotoran']").val($("input[name='totalpendapatankotoran']").val());
    $("input[name='totalbiayaoprkambing']").val($("input[name='totalbiayaoprbebek']").val());
    $("input[name='pendaptankambing']").val(parseInt($("input[name='totalpendapatankotoran']").val())-parseInt($("input[name='totalbiayaoprbebek']").val()));
    
});

//============== hitung analisa keuangan peternakan kambing =======//


$("input[name='Peralatanayam']").keydown(function(){
    const bibitayam = $("input[name='bibitayam']").val(); 
    const kandangayam = $("input[name='kandangayam']").val(); 
    const sewalahanayam = $("input[name='sewalahanayam']").val(); 
    const rakayam = $("input[name='rakayam']").val(); 
    const ayakanayam = $("input[name='ayakanayam']").val(); 
    const  Timbanganayam = $("input[name='Timbanganayam']").val(); 
    const  Selangayam = $("input[name='Selangayam']").val(); 
    const gilingpakanayam = $("input[name='gilingpakanayam']").val(); 
    const timbaayam = $("input[name='timbaayam']").val(); 
    const makanayam = $("input[name='makanayam']").val(); 
    const Peralatanayam = $("input[name='Peralatanayam']").val(); 
   
    const hasil = parseInt(bibitayam)+
                    parseInt(kandangayam)+
                    parseInt(sewalahanayam)+
                    parseInt(rakayam)+
                    parseInt(ayakanayam)+
                    parseInt(Timbanganayam)+
                    parseInt(Selangayam)+
                    parseInt(gilingpakanayam)+
                    parseInt(timbaayam)+
                    parseInt(makanayam)+
                    parseInt(Peralatanayam);
                   
    $("input[name='Investasiayam']").val(hasil);
});


$("input[name='upahkerjaayam']").keyup(function(){
    const upah = $(this).val();
    const Penyusutanbibitayam = $("input[name='Penyusutanbibitayam']").val(); 
    const Penyusutanlahanayam = $("input[name='Penyusutanlahanayam']").val(); 
    const Penyusutanayakanayam = $("input[name='Penyusutanayakanayam']").val(); 
    const Penyusutanselangayam = $("input[name='Penyusutanselangayam']").val(); 
    const Penyusutantimbaayam = $("input[name='Penyusutantimbaayam']").val(); 
    const Penyusutantambahanayam = $("input[name='Penyusutantambahanayam']").val(); 
    const Penyusutankandangayam = $("input[name='Penyusutankandangayam']").val(); 
    const Penyusutanrakayam = $("input[name='Penyusutanrakayam']").val(); 
    const Penyusutantimbanganayam = $("input[name='Penyusutantimbanganayam']").val(); 
    const Penyusutangilingayam = $("input[name='Penyusutangilingayam']").val(); 
    const Penyusutanmakanayam = $("input[name='Penyusutanmakanayam']").val(); 
   
   const totalbiayatetapayam = parseInt(upah)+
                    parseInt(Penyusutanbibitayam)+
                    parseInt(Penyusutanlahanayam)+
                    parseInt(Penyusutanayakanayam)+
                    parseInt(Penyusutanselangayam)+
                    parseInt(Penyusutantimbaayam)+
                    parseInt(Penyusutantambahanayam)+
                    parseInt(Penyusutankandangayam)+
                    parseInt(Penyusutanrakayam)+
                    parseInt(Penyusutantimbanganayam)+
                    parseInt(Penyusutangilingayam)+
                    parseInt(Penyusutanmakanayam);
    $("input[name='totalbiayatetapayam']").val(totalbiayatetapayam);
   
});


$("input[name='airayam']").keyup(function(){
    $("input[name='pendapatanayam']").removeAttr("readonly");
    $("input[name='hargaayam']").removeAttr("readonly");
    
    const airayam = $(this).val();
    const pakanayam = $("input[name='pakanayam']").val(); 
    const alathabisayam = $("input[name='alathabisayam']").val(); 
    const minumanayam = $("input[name='minumanayam']").val(); 
    const vaksinayam = $("input[name='vaksinayam']").val(); 
    const pakantambahan = $("input[name='pakantambahan']").val(); 
    const vitaminayam = $("input[name='vitaminayam']").val(); 
    const karungayam = $("input[name='karungayam']").val(); 
    const tempatayam = $("input[name='tempatayam']").val(); 
    const Penyusutantimbanganayam = $("input[name='Penyusutantimbanganayam']").val(); 
    const Penyusutangilingayam = $("input[name='Penyusutangilingayam']").val(); 
    const Penyusutanmakanayam = $("input[name='Penyusutanmakanayam']").val(); 
   
    const totalbiayavariableayam = parseInt(airayam)+
                    parseInt(pakanayam)+
                    parseInt(alathabisayam)+
                    parseInt(minumanayam)+
                    parseInt(vaksinayam)+
                    parseInt(pakantambahan)+
                    parseInt(vitaminayam)+
                    parseInt(karungayam)+
                    parseInt(Penyusutantimbanganayam)+
                    parseInt(Penyusutangilingayam)+
                    parseInt(tempatayam)+
                    parseInt(Penyusutanmakanayam);
                   
    $("input[name='totalbiayavariableayam']").val(totalbiayavariableayam);
   
});

$("input[name='pendapatanayam']").keydown(function(){
    const totalbiayavariableayam = $("input[name='totalbiayavariableayam']").val();
    const totalbiayatetapayam = $("input[name='totalbiayatetapayam']").val();
  
    $("input[name='totalbiayaoprayam']").val(parseInt(totalbiayavariableayam)+parseInt(totalbiayatetapayam));
});

$("input[name='hargaayam']").keydown(function(){
    const totalbiayavariableayam = $("input[name='pendapatanayam']").val();
    const hargaayam = $(this).val();
    const hasilpendapatanayam = parseInt(totalbiayavariableayam)*parseInt(hargaayam);
    // const totalbiayaoprayam = $("input[name='totalbiayavariableayam']").val() 
    $("input[name='hasilpendapatanayam']").val(hasilpendapatanayam);
    console.log("ok "+hasilpendapatanayam)
    const totalpendapatanayam = $("input[name='totalpendapatanayam']").val(hasilpendapatanayam);
    $("input[name='totalbiayaoprayam2']").val($("input[name='totalbiayaoprayam']").val());
    const totalbiayaopr = $("input[name='totalbiayaoprayam']").val();
    console.log("leg  "+totalbiayaopr)

    // $("input[name='pendapatanayam']").val(parseInt(totalbiayavariableayam)*parseInt(hargaayam));
    $("input[name='lamapendapatanayam']").val(parseInt(hasilpendapatanayam)-parseInt(totalbiayaopr));
    
});


// ======== perhitungan perdagangan umum ========== //
$("input[name='bungapertahun']").keydown(function(){
    
    //Harga Pokok Penjualan 
    let pendapatan = $("input[name='pendapatanusahaumum']").val();
    let hasil = parseInt(pendapatan) * 80 / 100;
    $("input[name='hargapokok']").val(hasil);

    // Pengeluaran Usaha 
    let hargapokok = hasil; //  $("input[name='hargapokok']").val();
    let sewakontrak = $("input[name='sewakontrak']").val();
    let gaji = $("input[name='gaji']").val();
    let listriktelepon2 = $("input[name='listriktelepon2']").val();
    let transportasi2 = $("input[name='transportasi2']").val();
    let pengeluaranlainnya2 = $("input[name='pengeluaranlainnya2']").val();
    let pengeluaranusaha = parseInt(hargapokok)+
                parseInt(sewakontrak)+
                parseInt(gaji)+
                parseInt(listriktelepon2)+
                parseInt(transportasi2)+
                parseInt(pengeluaranlainnya2);
    $("input[name='pengeluaranusaha']").val(pengeluaranusaha);

    // keuntungan usaha 
    let keuntunganusaha = parseInt(pendapatan)-parseInt(pengeluaranusaha);
    $("input[name='keuntunganusaha']").val(keuntunganusaha);

    //Total Penghasilan
    let penghasilpasangan = $("input[name='penghasilpasangan']").val(); 
    let penghasilanlainnya = $("input[name='penghasilanlainnya']").val(); 
    let totalpenghasilan = keuntunganusaha + parseInt(penghasilpasangan) + parseInt(penghasilanlainnya);
    $("input[name='totalpenghasilan']").val(totalpenghasilan);


    // Total Pengeluaran 
    let belanjart = $("input[name='belanjart']").val();
    let sewarumah = $("input[name='sewarumah']").val();
    let pendidikan = $("input[name='pendidikan']").val();
    let listriktelepon = $("input[name='listriktelepon']").val();
    let transportasi = $("input[name='transportasi']").val();
    let pengeluaranlainnya = $("input[name='pengeluaranlainnya']").val();
    let totalpengeluaran = parseInt(belanjart) + 
                            parseInt(sewarumah) +
                            parseInt(pendidikan) +
                            parseInt(listriktelepon) +
                            parseInt(transportasi) +
                            parseInt(pengeluaranlainnya);
    $("input[name='totalpengeluaran']").val(totalpengeluaran);

    //Sisa Penghasilan
    let sisapenghasilan = totalpenghasilan - totalpengeluaran;
    $("input[name='sisapenghasilan']").val(sisapenghasilan);

    //Rekomendasi Angsuran Pinjaman
    let bunga = $(this).val();
    let jangkawaktu =  $("input[name='jangkawaktu'").val();
    let rekomendasiplafond = $("input[name='rekomendasiplafond'").val(); 
    let hasil1 = parseInt(rekomendasiplafond) / parseInt(jangkawaktu);
    let hasil2 = parseInt(rekomendasiplafond) * parseInt(bunga) / 100;
    let rekomendasiangsuran = hasil1 + hasil2;
    $("input[name='rekomendasiangsuran'").val(rekomendasiangsuran);


    let angsuranusahasaatini = $("input[name='angsuranusahasaatini'").val();
    let disposableincome = sisapenghasilan - angsuranusahasaatini - rekomendasiangsuran;
    $("input[name='disposableincome'").val(disposableincome);

    // rpc 
    console.log(angsuranusahasaatini);
    console.log(rekomendasiangsuran);
    console.log(disposableincome);

    let temprpc = angsuranusahasaatini + rekomendasiangsuran;
    console.log(temprpc)
    let tempdispo = temprpc / disposableincome;
    console.log(tempdispo)
    let rpc     = tempdispo * 100;
    console.log(rpc);
    $("input[name='rpc'").val(rpc);
    
    
})


$("input[name='utangdagang']").keydown(function(){
    let inventory = $("input[name='inventory']").val();
    let hargapokok = $("input[name='hargapokok']").val();
    let dohinventory = parseInt(inventory)/parseInt(hargapokok)*30;
    $("input[name='dohinventory']").val(dohinventory);


    let pendapatanusahaumum = $("input[name='pendapatanusahaumum']").val();
    let piutangdagang =  $("input[name='piutangdagang']").val();
    let dohpiutangdagang = parseInt(pendapatanusahaumum)/parseInt(piutangdagang)*30;
    $("input[name='dohpiutang']").val(dohpiutangdagang);

    let utangdagang = $(this).val();
    let dohutangdagang = parseInt(utangdagang)/parseInt(hargapokok)*30;
    $("input[name='dohutang']").val(dohutangdagang);

    let workinvesment = parseInt(inventory)+parseInt(piutangdagang)+parseInt(utangdagang);
    $("input[name='workinvesment']").val(workinvesment);
    
});










