function filtriraj(){
    var elements = document.getElementsByTagName('tr');
    var pretrazi = document.getElementById('pretrazi').value;
    
    // Pretrazivanje po nazivu korisnika u inputu
    for (var i = 1; i < elements.length; i++){
        if(elements[i].firstChild.innerHTML.indexOf(pretrazi) >= 0){
            elements[i].style.display = "table-row";
        }
        else{
            elements[i].style.display = "none";
        }
    } 
}

function filtrirajDatum(){
    var elements = document.getElementsByTagName('tr');
    var datum_od = new Date(document.getElementById('datum_od').value);
    var datum_do = new Date(document.getElementById('datum_do').value);
    
    for (var i = 1; i < elements.length; i++){
        var datum = new Date(elements[i].lastChild.innerHTML);
        
        console.log(datum);
        
        if(datum >= datum_od && datum <= datum_do){
            elements[i].style.display = "table-row";
        }
        else{
            elements[i].style.display = "none";
        }
    } 
}

function reset(){
    
    document.getElementById('datum_od').value = "";
    document.getElementById('datum_do').value = "";
    document.getElementById('pretrazi').value = "";
    
    var elements = document.getElementsByTagName('tr');
    for (var i = 1; i < elements.length; i++){
        elements[i].style.display = "table-row";
    } 
}



