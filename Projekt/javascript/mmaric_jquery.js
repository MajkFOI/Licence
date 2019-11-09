$(document).ready(function (){
    if (document.title.indexOf("Registracija") !== -1) {
        
        $("#email").keyup(provjeriEmailRegExp);
        $("#korime").keyup(provjeriKorIme);
        
        function provjeriEmailRegExp() {
            $.ajax({
                url: '../forme/Korisnici.php',
                type: 'POST',
                success: function (xml) {
                            emailovi = [];
                            $(xml).find('email').each(function () {
                                emailovi.push($(this).text());
                            });
                            if($.inArray($("#email").val(), emailovi) !== -1){

                                $("#email").css("color", "red");
                            }
                            else{
                                $("#email").css("color", "black");
                                
                                var re = new RegExp(/(?:\.\.)|(?:[^a-zA-Z0-9@_.])|(?:@\.)|(?:\..\.)|(?:^\.)/);
                                var re2 = new RegExp(/(?:@.*[\.].{2,})/);
                                console.log($("#email").val());
                                var neSmijeBiti = re.test($("#email").val());
                                var moraBiti = re2.test($("#email").val());

                                // Ako ima elemente koje ne smije ILI ako nema elemente koje mora imati
                                if(neSmijeBiti || !moraBiti){
                                    $("#email").css("color", "red");
                                }
                            }
                    }
            }); 
        }
            
        function provjeriKorIme(){
            $.ajax({
                url: '../forme/Korisnici.php',
                type: 'POST',
                dataType: 'xml',
                success: function (xml) {
                        korisnickaImena = [];
                        $(xml).find('korisnicko_ime').each(function () {
                            korisnickaImena.push($(this).text());
                        });

                        if($.inArray($("#korime").val(), korisnickaImena) !== -1){
                            console.log("ASD");
                            $("#korime").css("color", "red");
                        }
                        else{
                            $("#korime").css("color", "black");
                        }
                }
            }); 
        }
    }
    
});
