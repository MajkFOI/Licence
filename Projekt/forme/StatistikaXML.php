<?php
    require '../sesija.class.php';
    require '../baza.class.php';
    
    Sesija::dajKorisnika();
    if(!isset($_SESSION['korisnik'])){
        header("Location: ../obrasci/prijava.php");
    }
    else if(intval(($_SESSION['uloga'])) > 1){
        header("Location: ../index.php");
    }
    
    header('Content-Type: text/xml');

    $veza = new Baza();
    $veza->spojiDB();
    
    $kategorijaID = $_GET['kategorijaID'];
    
    if($kategorijaID == 0){
        $upit = "select * from kupnja k join licenca l on k.licenca_id = l.id where status_id != 6";  
    }
    else{
        $upit = "select * from kupnja k join licenca l on k.licenca_id = l.id where status_id != 6 and kategorija_id = $kategorijaID";  
    }
  
    $rezultat = $veza->selectDB($upit);

    $xml = new SimpleXMLElement('<kupnje/>');
    while($red = mysqli_fetch_array($rezultat)){
        $kupnja = $xml->addChild('kupnja');
        
        $kupnja->addChild('id', $red['id']);
        $kupnja->addChild('status_id', $red['status_id']);
        $kupnja->addChild('kategorija_id', $red['kategorija_id']);
        $kupnja->addChild('iznos', $red['iznos']);
        $kupnja->addChild('datum_vrijeme_promjene_statusa', $red['datum_vrijeme_promjene_statusa']);
    }
    
    $veza->zatvoriDB();

    echo $xml->asXML();
?>


