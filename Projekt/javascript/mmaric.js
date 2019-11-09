
function kreirajDogadaje() {
    
    var zupanija = document.getElementById("zupanija");
    if(navigator.userAgent.indexOf("Chrome") !== -1 )
        zupanija.value = "bb";
    else if(navigator.userAgent.indexOf("Firefox") !== -1 ) 
        zupanija.value = "vz";
    else 
        zupanija.value = "zg";
    
    var odobriUnos = {};
    
    odobriUnos["godine"] = "neispravan";
    odobriUnos["odabir"] = "neispravan";
    document.getElementById("submit1").disabled = true;

    document.getElementById("godine").addEventListener("focusout", provjeriBroj);
    document.getElementById("odabirAutomobila").addEventListener("focusout", provjeriBrojOznacenih);
    document.getElementById("unosTeksta").addEventListener("keyup", provjeriBrojZnakova);
    
    function provjeriBroj() {
        var element = document.getElementById("godine");
        var poljeZaUnosTeksta = document.getElementById("unosTeksta");

        if (element.value < 1 || element.value > 100) {
            poljeZaUnosTeksta.disabled = true;
            alert("Nedozvoljena vrijednost.");
            element.style.backgroundColor = "red";
            odobriUnos["godine"] = "neispravan";
        } else {
            poljeZaUnosTeksta.disabled = false;
            element.style.backgroundColor = "white";
            document.getElementById("odabirAutomobila").disabled = false;
            document.getElementById("labelaAutomobila").innerHTML = "(OMOGUĆENO) Vrste automobila";
            odobriUnos["godine"] = "ispravan";
        }
        
        omoguciGumbZaSlanje();
        console.log(odobriUnos);
    }

    function provjeriBrojOznacenih() {
        var odabirAutomobila = document.getElementById("odabirAutomobila");

        var brojacOznacenih = 0;
        for (var i = 0; i < odabirAutomobila.length - 1; i++)
            if (odabirAutomobila[i].selected)
                brojacOznacenih++;

        if (brojacOznacenih > 3) {
            alert("Molimo odaberite najviše tri vrijednosti.");
            odobriUnos["odabir"] = "neispravan";
            odabirAutomobila.style.backgroundColor = "red";
        } else {
            odobriUnos["odabir"] = "ispravan";
            odabirAutomobila.style.backgroundColor = "white";
        }
        
        omoguciGumbZaSlanje();
        console.log(odobriUnos);
    }
    
    
    function provjeriBrojZnakova() {
        var poljeZaUnosTeksta = document.getElementById("unosTeksta");
        var maksimalanBrojZnakova = document.getElementById("godine").value;

        if (poljeZaUnosTeksta.value.length > maksimalanBrojZnakova) {
            alert("Tekst smije imati maksimalno " + maksimalanBrojZnakova + " znakova");

            // ----- AKO IMA VIŠE OD DOPUŠTENO ZNAKOVA, IZBIŠI ZNAKOVE VIŠKA -----
            var vrijednostPolja = "";
            for (var i = 0; i < maksimalanBrojZnakova; i++) {
                vrijednostPolja += poljeZaUnosTeksta.value[i];
            }
            poljeZaUnosTeksta.value = vrijednostPolja;
        }
        
        omoguciGumbZaSlanje();
    }

    function omoguciGumbZaSlanje() {
        var gumbZaSlanje = document.getElementById("submit1");
        
        // ----- AKO SU SVE VRIJEDNOSTI U RIJECNIKU ISPRAVNE OMOGUĆI SUBMIT  -----
        for (var i in odobriUnos) {
            if (odobriUnos[i] === "neispravan"){
                return;
            }
        }
        gumbZaSlanje.disabled = false;
    }
}

