function postaviMinDatumOd(){ //onload
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //Sijecanj = 0
    var yyyy = today.getFullYear();
    
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    
    today = yyyy+'-'+mm+'-'+dd;
    document.getElementById("datum_od").setAttribute("min", today);
}

function postaviMinDatumDo(){ //onload
    var iznosOd = document.getElementById("datum_od").value;
    var datumOd = new Date(iznosOd);
   
    var dd = datumOd.getDate()+2;
    var mm = datumOd.getMonth()+1;
    var yyyy = datumOd.getFullYear();
    
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    
    var minDatum = yyyy+'-'+mm+'-'+dd;
    document.getElementById("datum_do").setAttribute("min", minDatum);
}

function provjeriKolicinu(){
    var kolicina = document.getElementById("kolicina");
    if(!kolicina.value){
        kolicina.style.backgroundColor = "red";
        return false;
    }
    else{
        kolicina.style.backgroundColor = "white";
        return true;
    }
}

function provjeriIznos(){
    var iznos = document.getElementById("iznos");
    
    if(!iznos.value){
        iznos.style.backgroundColor = "red";
        return false;
    }
    else{
        iznos.style.backgroundColor = "white";
    }
            
    var re = new RegExp(/([^0-9\.])|(\.[0-9]{3,})|([0-9]{10,})/);
    
    var neSmijeBiti = re.test(iznos.value);
    
    if(neSmijeBiti){
        iznos.style.color = "red";
        return false;
    }
    else{
        iznos.style.color = "black";
        return true;
    }
}

function provjeriDatumOd(){
    var datumOd = document.getElementById("datum_od");
    
    if(!datumOd.value){
        datumOd.style.backgroundColor = "red";
        return false;
    }
    else{
        datumOd.style.backgroundColor = "white";
        return true;
    }
}
function provjeriDatumDo(){
    var datumDo = document.getElementById("datum_do");
    if(!datumDo.value){
        datumDo.style.backgroundColor = "red";
        return false;
    }
    else{
        datumDo.style.backgroundColor = "white";
        return true;
    }
}

function omoguciGumb(){
    var kolicina = provjeriKolicinu();
    var iznos = provjeriIznos();
    var datumOd = provjeriDatumOd();
    var datumDo = provjeriDatumDo();
    
    if(kolicina && iznos && datumOd && datumDo){
        return true;
    }
    else{
        return false;
    }
}




