$(document).ready(function (){
    dohvatiPodatke();
    
    $("#datum_do").on("change", dohvatiPodatke);
    $("#datum_od").on("change", dohvatiPodatke);
    
    $("#kategorija").on("change", dohvatiPodatke);
    
    function dohvatiPodatke(){
        
        var ukupnoZahtjeva = 0;
        var brojOdobrenih = 0;
        var brojNeodobrenih = 0;
        var ukupanIznos = 0;
        var datum_do = $('#datum_do').val();
        var datum_od = $('#datum_od').val();
     
        $.ajax({
            url: 'StatistikaXML.php',
            dataType: 'xml',
            contentType : 'xml',
            type: 'GET',
            data: { 'kategorijaID' : $("#kategorija").val()},
            success: function (xml) {
                //console.log(xml);
                $(xml).find('kupnja').each(function() {

                    var id = $(this).children('id').text();
                    var status_id = $(this).children('status_id').text();
                    var kategorija_id = $(this).children('kategorija_id').text();
                    var iznos = $(this).children('iznos').text();
                    var datum_vrijeme = new Date($(this).children('datum_vrijeme_promjene_statusa').text());
                    
                    if(datum_od && datum_do){
                        
                        datum_do = new Date(datum_do);
                        datum_od = new Date(datum_od);

                        if(status_id == 1 && datum_vrijeme > datum_od && datum_vrijeme < datum_do){
                            ukupnoZahtjeva++;
                            brojOdobrenih++;
                            ukupanIznos += parseFloat(iznos);
                        }
                        if(status_id == 2 && datum_vrijeme > datum_od && datum_vrijeme < datum_do){
                            ukupnoZahtjeva++;
                            brojNeodobrenih++;
                        }
                    }
                    else{
                        ukupnoZahtjeva++;

                        if(status_id == 1){
                            brojOdobrenih++;
                            ukupanIznos += parseFloat(iznos);
                        }
                        if(status_id == 2){
                            brojNeodobrenih++;
                        }
                    }
                    
                });
                var postotak = parseInt(brojOdobrenih/ukupnoZahtjeva*100);
                $("#tablica tr").remove();
                $("#tablica").append('<tr><th>Broj odobrenih</th><th>Broj neodobrenih</th><th>Postotak odobrenosti</th><th>Ukupan broj zahtjeva</th><th>Novaca zarađeno</th></tr>');
                $("#tablica").append('<tr><td>'+brojOdobrenih+'</td><td>'+brojNeodobrenih+'</td><td>'+postotak+'</td><td>'+ukupnoZahtjeva+'</td><td>'+ukupanIznos.toFixed(2)+'</td></tr>');
            }
        });
    }
});

