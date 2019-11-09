<?php
    require '../baza.class.php';
    require '../sesija.class.php';
    require '../dnevnik.class.php';
    
    // Odjava
    if(isset($_GET['odjava'])){
        
        Sesija::dajKorisnika();
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Odjava sa sustava.", $_SESSION['id']);
        
        Sesija::obrisiSesiju();
        header("Location: ../obrasci/prijava.php");
    }
    
    // Provjera korisnika
    Sesija::dajKorisnika();

    
    if(!isset($_SESSION['korisnik'])){
        header("Location: ../obrasci/prijava.php");
    }
    else if(($_SESSION['uloga']) > 2){
        header("Location: ../index.php");
    }

    $greska = "";
    if(isset($_POST['submit'])){
        $veza = new Baza();
        $veza->spojiDB();
        
        $licencaID = $_POST["licenca"];

        $upit = "select id from korisnik where korisnicko_ime = '{$_SESSION['korisnik']}'";
        
        $rezultat = $veza->selectDB($upit);
        
        $red = mysqli_fetch_array($rezultat);
        $korisnik_id = $red['id'];
            
        $upit = "insert into kupnja(korisnik_id, licenca_id, status_id, kolicina, iznos, datum_od, datum_do) "
                    . "values({$korisnik_id},{$licencaID}, 6, '{$_POST['kolicina']}', {$_POST['iznos']}, '{$_POST['datum_od']}', '{$_POST['datum_do']}')"; 
                     // 6 - NA ČEKANJU (POTVRDE OD ADMINISTRATORA)
        $rezultat = $veza->updateDB($upit);
        
        $veza->zatvoriDB();
        
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Moderator šalje zahtjev za kupnjom licence (ID licence: $licencaID).", $_SESSION['id']);

        header("Location: MojiKupnjaZahtjevi.php?rezultat={$rezultat}");
    }
?>
﻿<!DOCTYPE html>
<html lang="hr" >
    <head>
        <title> Unesi kategoriju </title>
        <meta charset="utf-8">
        <meta name="author" content="Meikl Marić">
        <meta name="keywords" content="Obrazac, dokument, get">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_1100.css" media="(max-width: 1100px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_960.css" media="(max-width: 960px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_780.css" media="(max-width: 780px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_480.css" media="(max-width: 480px)">
        <script src="../javascript/LicencaKupnjaZahtjevProvjera.js"></script>
        
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="../javascript/mmaric.js"></script>-->    
    </head>
    <body onload="postaviMinDatumOd(); postaviMinDatumDo()">
    <header id="headerObrazac">
	   <div class = "container">
            <h2> <span class = "zutiTekst"> Obrazac </span></h2>
            <nav>
                <ul>
                    <li><a href="../index.php"> Početna </a></li>
                    <?php 
                        if(isset($_SESSION['uloga'])){
                            // 1 - administrator
                            if($_SESSION['uloga'] == '1'){
                                echo '<div class="dropdown">
                                            <button class="dropbtn">ADMIN &#9661;</button>
                                            <div class="dropdown-content">
                                              <a href="KategorijaUnos.php"> Unesi kategoriju </a>
                                              <a href="KategorijaPopis.php"> Popis kategorija </a>
                                              <a href="LicencaUnos.php"> Unesi licencu </a>
                                              <a href="LicencaPopis.php"> Popis licenci </a>
                                              <a href="PopisBlokiranih.php"> Popis blokiranih </a>
                                              <a href="PopisKorisnika.php"> Popis korisnika </a>
                                              <a href="LicencaKupnjaZahtjevi.php"> Pregledaj zahtjeve za kupnju</a>
                                              <a href="Dnevnik.php"> Dnevnik </a>
                                              <a href="Konfiguracija.php"> Konfiguracija </a>
                                              <a href="Statistika.php"> Statistika </a>
                                            </div>
                                       </div>';
                            }
                            if($_SESSION['uloga'] == '2'){
                                echo '<div class="dropdown">
                                            <button class="dropbtn">MODERATOR &#9661;</button>
                                            <div class="dropdown-content">
                                              <a href="MojiKupnjaZahtjevi.php"> Moji kupnja zahtjevi </a>
                                              <a href="LicencaKoristenjeZahtjevi.php"> Pregledaj zahtjeve za korištenje</a>
                                              <a href="MojiKorisniciLicenci.php"> Moji korisnici</a>
                                            </div>
                                       </div>';
                            }
                            if($_SESSION['uloga'] == '3'){
                                echo '<div class="dropdown">
                                            <button class="dropbtn">KORISNIK &#9661;</button>
                                            <div class="dropdown-content">
                                              <a href="MojiKoristenjeZahtjevi.php"> Moji zahtjevi za korištenje</a>
                                            </div>
                                       </div>';
                            }
                        }
                        if(isset($_SESSION['korisnik'])){ 
                            echo "<li><a href=" . "?odjava" . "> Odjava </a></li>";
                        } 
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    <section>
        <form id="form1" method="post" action="">
            <div class="odjeljak">
                <h3> Kategorija </h3>
                <?php
                    if(isset($_GET['rezultat'])){
                        if($_GET['rezultat'] == '1'){
                            echo '<p style="color:green"> Podaci su zapisani u bazu podataka. (Gumb posalji disablean, redirect za 4 sec) </p>';
                            header("refresh:4;url=../ostalo/popis.php");
                        }
                    }
                    if(isset($_POST['submit'])){
                        if(!empty($greska)){
                             echo $greska; 
                         }
                    }
                ?>
                <?php
                    if(isset($_POST["licencaID"])){
                        echo '<input id="licenca" name="licenca" value="' . $_POST['licencaID'] . '" style="display:none" readonly>';
                    }
                ?>
            </div>
            <div class="odjeljak">
                <label> Unesite količinu </label>
                <input id="kolicina" name="kolicina" type="number" placeholder="Npr. 10" oninput="provjeriKolicinu()">
            </div>
            <div class="odjeljak">
                <label> Unesite iznos koji ste spremni platiti </label>
                <input id="iznos" name="iznos" type="text" placeholder="Npr. 199.99" oninput="provjeriIznos()">
            </div>
            <div class="odjeljak">
                <label> Unesite datum od kad želite </label>
                <input id="datum_od" name="datum_od" type="date" onclick="postaviMinDatumOd()">
            </div>
            <div class="odjeljak">
                <label> Unesite datum do kad želite </label>
                <input id="datum_do" name="datum_do" type="date" onclick="postaviMinDatumDo()">
            </div>
            <div id="gumbOdjeljak" class = "odjeljak">
                <input name="submit" id="submit1" type="submit" onclick="return omoguciGumb()" value=" Unesi ">
                <input id="reset" type="reset">
            </div>
        </form>
    </section>
    </body>
</html>
