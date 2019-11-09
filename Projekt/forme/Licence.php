<?php
    require '../sesija.class.php';
    require '../baza.class.php';
    
    Sesija::dajKorisnika();
    
    header('Content-Type: text/xml');

    $veza = new Baza();
    $veza->spojiDB();
    
    $datum = date('Y-m-d');
    
    $naziv = $_GET['naziv'];
    $stranica = $_GET['stranica'];
    $kategorija_id = $_GET['kategorija_id'];
    
    $upit = 'select stranicenje from konfiguracija';
    $rezultat = $veza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    
    $limit = $red['stranicenje'];
    $offset = $stranica * $red['stranicenje'];
    
    //Dohvat ukupnog broja zapisa za straničenje (bez limita i offset)
    if($kategorija_id != 0){
    $upit = "select count(*) as 'ukupnoZapisa' "
                . "from kupnja ku "
                . "join korisnik ko on ku.korisnik_id = ko.id "
                . "join licenca l on ku.licenca_id = l.id "
                . "join kategorija k on l.kategorija_id = k.id "
                . "where ku.status_id = 1 and ku.datum_do > '{$datum}' and ku.kolicina > 0 and k.id = {$kategorija_id} and l.naziv like '%{$naziv}%'";  
    }
    else{
    $upit = "select count(*) as 'ukupnoZapisa' "
                    . "from kupnja ku "
                    . "join korisnik ko on ku.korisnik_id = ko.id "
                    . "join licenca l on ku.licenca_id = l.id "
                    . "join kategorija k on l.kategorija_id = k.id "
                    . "where ku.status_id = 1 and ku.datum_do > '{$datum}' and ku.kolicina > 0 and l.naziv like '%{$naziv}%'";  
    }
    $rezultat = $veza->selectDB($upit);
    
    $red = mysqli_fetch_array($rezultat);
    $ukupnoZapisa = $red['ukupnoZapisa'];
    
    // Dohvat svih licenci za stranicenje
        
    if($kategorija_id != 0){
        // Upit s kategorijom
        $upit = "select ku.id, ku.licenca_id, ku.kolicina, ku.datum_od, ku.datum_do, ko.korisnicko_ime, l.naziv as 'licNaziv', l.opis, l.slika, k.naziv as 'katNaziv' "
                    . "from kupnja ku "
                    . "join korisnik ko on ku.korisnik_id = ko.id "
                    . "join licenca l on ku.licenca_id = l.id "
                    . "join kategorija k on l.kategorija_id = k.id "
                    . "where ku.status_id = 1 and ku.datum_do > '{$datum}' and ku.kolicina > 0 and l.naziv like '%{$naziv}%' and k.id = {$kategorija_id} limit $limit offset $offset;";
    }  
    else{
         $upit = "select ku.id, ku.licenca_id, ku.kolicina, ku.datum_od, ku.datum_do, ko.korisnicko_ime, l.naziv as 'licNaziv', l.opis, l.slika, k.naziv as 'katNaziv' "
                    . "from kupnja ku "
                    . "join korisnik ko on ku.korisnik_id = ko.id "
                    . "join licenca l on ku.licenca_id = l.id "
                    . "join kategorija k on l.kategorija_id = k.id "
                    . "where ku.status_id = 1 and ku.datum_do > '{$datum}' and ku.kolicina > 0 and l.naziv like '%{$naziv}%' limit $limit offset $offset;";
    }
                    
    $rezultat = $veza->selectDB($upit);
    
    $xml = new SimpleXMLElement('<licence/>');
    while($red = mysqli_fetch_array($rezultat)){
        $licenca = $xml->addChild('licenca');
        
        $licenca->addChild('id', $red['id']);
        $licenca->addChild('licenca_id', $red['licenca_id']);
        $licenca->addChild('kolicina', $red['kolicina']);
        $licenca->addChild('datum_od', $red['datum_od']);
        $licenca->addChild('datum_do', $red['datum_do']);
        $licenca->addChild('korisnicko_ime', $red['korisnicko_ime']);
        $licenca->addChild('licNaziv', $red['licNaziv']);
        $licenca->addChild('opis', $red['opis']);
        $licenca->addChild('slika', $red['slika']);
        $licenca->addChild('katNaziv', $red['katNaziv']);
    }
    
    $veza->zatvoriDB();
    
    $licenca = $xml->addChild('uloga');
    
    // Ako je postavljena sesija, dodaj id uloge, inace 0
    if(isset($_SESSION['uloga'])){
        $licenca->addChild('uloga', $_SESSION['uloga']);
    }
    else{
        $licenca->addChild('uloga', 0);
    }
    
    $licenca = $xml->addChild('ukupnoZapisa');
    $licenca->addChild('brojacZapisa', $ukupnoZapisa);
   
    echo $xml->asXML();
?>

