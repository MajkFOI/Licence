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
    //var_dump($_SESSION);
    
    if(!isset($_SESSION['korisnik'])){
        header("Location: ../obrasci/prijava.php");
    }
    else if(intval(($_SESSION['uloga'])) > 1){
        header("Location: ../index.php");
    }
    
    if(isset($_POST['submit'])){
        var_dump($_POST);
        var_dump($_GET);
        $veza = new Baza();
        $veza->spojiDB();
        $id = (int)$_POST['id'];
        $kategorija_id = (int)$_POST['kategorija_id'];

        $upit = "update licenca set "
                . "naziv = '{$_POST['naziv']}', "
                . "kategorija_id = {$kategorija_id},"
                . "opis = '{$_POST['opis']}', "
                . "slika = '{$_POST['slika']}' "
                . "where id = $id";
        $rezultat = $veza->updateDB($upit);
        
        $veza->zatvoriDB();
        
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Administrator uređuje licencu (ID licence: $id).", $_SESSION['id']);
        
        header("Location: LicencaPopis.php?rezultat={$rezultat}");
    }
    else if(isset($_GET['licencaID'])){
        $licencaID = $_GET['licencaID'];
        $veza = new Baza();
        $veza->spojiDB();

        $upit = "select * from licenca where id = {$licencaID}";
        $rezultat = $veza->selectDB($upit);

        $red = mysqli_fetch_array($rezultat);
        $veza->zatvoriDB();
    }
    else{//Ako se uđe bez get i post
        header("Location: LicencaPopis.php");
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
        
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="../javascript/mmaric.js"></script>-->    
    </head>
    <body>
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
        <form id="form1" enctype="multipart/form-data" method="post" action="">
            <div class="odjeljak">
                <h3> Uredi licencu <?php echo $red['naziv'] ?></h3>
                <input name="id" type="text" value="<?php echo $red['id']; ?>" readonly>
            </div>
             <div class="odjeljak">
                <label>Uredi kategoriju</label>
                <input name="kategorija_id" type="number" value="<?php echo $red['kategorija_id']; ?>">
            </div>
            <div class="odjeljak">
                <label>Uredi naziv</label>
                <input name="naziv" type="text" value="<?php echo $red['naziv']; ?>">
            </div>
            <div class="odjeljak">
                <label>Uredi opis</label>
                <textarea style="width:100%; max-width: 100%; height: 100px" name="opis" type="text"><?php echo $red['opis']; ?></textarea>
            </div>
            <div class="odjeljak">
                <label>Uredi sliku</label>
                <input name="slika" type="text" value="<?php echo $red['slika']; ?>">
            </div>
            <div id="gumbOdjeljak" class = "odjeljak">
                <input name="submit" id="submit1" type="submit" value="Spremi">
            </div>
        </from>
    </section>
    </body>
</html>