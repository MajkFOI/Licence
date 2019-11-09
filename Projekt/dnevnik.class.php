<?php
    require_once 'baza.class.php';
    
    class Dnevnik{
        function zapisi($opis, $korisnik_id = "null"){
            $veza = new Baza();
            $veza->spojiDB();

            $datum = date("Y-m-d H:i:s");
            
            $opis .= " (IP: {$_SERVER['REMOTE_ADDR']})";
            
            $upit = "insert into dnevnik_rada(korisnik_id, datum_vrijeme, opis) values('$korisnik_id', '$datum', '$opis');";

            $veza->selectDB($upit);
            
            $veza->zatvoriDB();
        }
    }
?>
