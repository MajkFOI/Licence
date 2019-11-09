
function prosiriDetalje(id){    
    var datum = document.getElementById('datum'+id);
    datum.style.display = 'block';
    
    var opis = document.getElementById('opis'+id);
    opis.style.display = 'block';
    
    var vlasnik = document.getElementById('vlasnik'+id);
    vlasnik.style.display = 'block';
}

function sakrijDetalje(id){
    var datum = document.getElementById('datum'+id);
    datum.style.display = 'none';
    
    var opis = document.getElementById('opis'+id);
    opis.style.display = 'none';
    
    var vlasnik = document.getElementById('vlasnik'+id);
    vlasnik.style.display = 'none';
}




