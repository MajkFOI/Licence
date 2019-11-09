$(document).ready(function (){
        
        azurirajStranicu();
        //$(".pagination a").click(azurirajStranicu);
        
        $("#pretrazi").on("keyup", azurirajStranicu);
        $("#filtriraj").on("change", azurirajStranicu);
        
        $(".pagination").on("click", "a", azurirajStranicu);
        
        
        var brojacZapisaNaStranici = 0;
        function azurirajStranicu(){
            var id_elementa = event.target.id;
            var naziv = $("#pretrazi").val();
            var kategorija_id = parseInt($("#filtriraj").val(), 10);
            var brojacZaClearBoth = 1;
            //alert(kategorija_id);
            
            var ukupnoZapisa = 0;
            
            if(id_elementa == null || id_elementa == "pretrazi" || id_elementa == "filtriraj"){
                id_elementa = 0;
            }
            
            $('article').remove();
            
            $.ajax({
                url: 'forme/Licence.php',
                dataType: 'xml',
                contentType : 'xml',
                type: 'GET',
                data: { 'naziv' : naziv, 'stranica' : id_elementa, 'kategorija_id' : kategorija_id }, 
                success: function (xml) {
                            //console.log(xml);
                            var uloga = $(xml).find('uloga').children('uloga').text();
                            ukupnoZapisa = $(xml).find('ukupnoZapisa').children('brojacZapisa').text();
                            
                            // Bug na zadnjoj stranici kada ima manje zapisa od straničenja
                            if(brojacZapisaNaStranici < $(xml).find('licenca').length){
                                brojacZapisaNaStranici = $(xml).find('licenca').length;
                            } 
                            
                            $(xml).find('licenca').each(function() {
                                //console.log(brojacZapisaNaStranici);
                                var id = $(this).children('id').text();
                                var katNaziv = $(this).children('katNaziv').text();
                                var licNaziv = $(this).children('licNaziv').text();
                                var slika = $(this).children('slika').text();
                                var kolicina = $(this).children('kolicina').text();
                                var korisnicko_ime = $(this).children('korisnicko_ime').text();
                                var datum_od = $(this).children('datum_od').text();
                                var datum_do = $(this).children('datum_do').text();
                                var opis = $(this).children('opis').text();
                                
                                $("#sekcija2 .container").append(
                                        '<article id="artikl'+id+'" style="text-align:center; cursor: auto;" class = "kutija">' +
                                        '<h2>'+katNaziv+'</h2>' +
                                        '<h4>'+licNaziv+'</h4>' +
                                         '<div style="width: 100%; position:relative">' +
                                          '<img style="position:relative" src="slike/'+slika+'" width="90%">' +
                                          '<button id="'+id+'" class="gumb1" style="text-align:center; margin-top: 10px; position: absolute; top:50%; left:25%; width:50%; height: 40px" type="submit" onclick="prosiriDetalje(this.id)" onfocusout="sakrijDetalje(this.id)"> Detalji </button>' +
                                         '<form id="forma'+id+'" style="text-align:center; margin-top: 10px; position: absolute; top:30%; left:25%; width:50%; height: 40px" method="post" action="">' +
                                                '<button class="gumb1" style="height:100%; width:100%" type="submit" name="kupnjaID" value="'+id+'"> Koristi </button>' +
                                            '</form>'+
                                        '</div>' + 
                                         '<p> Preostalo: '+kolicina+' </p>' +
                                         '<p id="vlasnik'+id+'" style="display:none"> Vlasnik: '+korisnicko_ime+'</p>' +
                                         '<p id="datum'+id+'" style="display:none"> Vrijedi od '+datum_od+' do '+datum_do+'</p>' +
                                         '<p id="opis'+id+'" style="display:none"> Opis: '+opis+'</p>' +
                                        '</article>'
                                        );
                                if(brojacZaClearBoth%3===0){
                                     $("#sekcija2 .container").append("<div class='ciscenjeFloata'></div>");
                                }
                                var forma = "#forma"+id;
                                //alert(slika);
                                if(uloga==0){
                                    $(forma).remove();
                                }
                                brojacZaClearBoth++;
                                
                                if(ukupnoZapisa <= brojacZapisaNaStranici){
                                    $("#sekcija2 .pagination a").remove();
                                }
                                else{
                                // zaokruzivanje na veci (ako ima viška zapisa, da zadnja stranica može imati manje zapisa nego sto je stranicenje)
                                    var brojacStranica = Math.ceil(ukupnoZapisa/brojacZapisaNaStranici);

                                    $("#sekcija2 .pagination a").remove();
                                    $("#sekcija2 .pagination").append('<a href="#">&laquo;</a>');
                                    for(var i=0; i<brojacStranica; i++){
                                        $("#sekcija2 .pagination").append('<a id="'+i+'">'+(i+1)+'</a>');
                                    }  
                                    $("#sekcija2 .pagination").append('<a href="#">&raquo;</a>');

                                    $("#"+id_elementa).addClass("active");
                                }
                            });
                    }
            });   
        }
});

