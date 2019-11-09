<?php
    require '../baza.class.php';
    header('Content-Type: text/xml');

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "select korisnicko_ime, email from korisnik";
    $rezultat = $veza->selectDB($upit);

    $veza->zatvoriDB();
    
    $xml = new SimpleXMLElement('<korisnici/>');
    while($red = mysqli_fetch_array($rezultat)){
        $user = $xml->addChild('korisnik');
        
        $user->addChild('korisnicko_ime', $red['korisnicko_ime']);
        $user->addChild('email', $red['email']);
    }
   
    echo $xml->asXML();
?>
