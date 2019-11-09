function provjeriIme(){
    var ime = document.getElementById('ime');

    if(ime.value == "" || ime.value.length > 45){
        ime.style.backgroundColor = 'red';
    }
    else{
        ime.style.backgroundColor = 'white'
    }
}

function provjeriPrezime(){
    var prezime = document.getElementById('prezime');

    if(prezime.value == "" || prezime.value.length > 45){
        prezime.style.backgroundColor = 'red';
    }
    else{
        prezime.style.backgroundColor = 'white'
    }
}

function provjeriKorIme(){
    var korime = document.getElementById('korime');

    if(korime.value == "" || korime.value.length > 45){
        korime.style.backgroundColor = 'red';
    }
    else{
        korime.style.backgroundColor = 'white'
    }
}

function provjeriLozinku1(){
    var lozinka1 = document.getElementById('lozinka1');

    if(lozinka1.value == "" || lozinka1.value.length > 45){
        lozinka1.style.backgroundColor = 'red';
    }
    else{
        lozinka1.style.backgroundColor = 'white'
    }
}

function provjeriLozinku2(){
    var lozinka2 = document.getElementById('lozinka2');
    var lozinka1 = document.getElementById('lozinka1');

    if(lozinka2.value == "" || lozinka2.value.length > 45 || lozinka1.value !== lozinka2.value){
        lozinka2.style.backgroundColor = 'red';
    }
    else{
        lozinka2.style.backgroundColor = 'white'
    }
    
    
}




