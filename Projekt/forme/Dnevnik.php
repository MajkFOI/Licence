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
    if(isset($_GET['rezultat'])){
        echo $_GET['rezultat'];
    }
    
    // Provjera korisnika
    Sesija::dajKorisnika();
    //var_dump($_SESSION);
    
    if(!isset($_SESSION['korisnik'])){
        header("Location: ../obrasci/prijava.php");
    }
    else if(intval(($_SESSION['uloga'])) > 2){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="hr" >
    <head>
        <title> Ispis dnevnika </title>
        <meta charset="utf-8">
        <meta name="author" content="Meikl Marić">
        <meta name="keywords" content="Obrazac, dokument, get">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_1100.css" media="(max-width: 1100px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_960.css" media="(max-width: 960px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_780.css" media="(max-width: 780px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_480.css" media="(max-width: 480px)">
        <script src="../javascript/Dnevnik.js"></script> 
    </head>
    <body>
    <header id="headerObrazac">
	   <div class = "container">
            <h2> <span class = "zutiTekst"> Ispis dnevnika </span></h2>
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
                                              <a href="../forme/KategorijaUnos.php"> Unesi kategoriju </a>
                                              <a href="../forme/KategorijaPopis.php"> Popis kategorija </a>
                                              <a href="../forme/LicencaUnos.php"> Unesi licencu </a>
                                              <a href="../forme/LicencaPopis.php"> Popis licenci </a>
                                              <a href="../forme/PopisBlokiranih.php"> Popis blokiranih </a>
                                              <a href="../forme/PopisKorisnika.php"> Popis korisnika </a>
                                              <a href="../forme/LicencaKupnjaZahtjevi.php"> Pregledaj zahtjeve za kupnju</a>
                                              <a href="../forme/Dnevnik.php"> Dnevnik </a>
                                              <a href="../forme/Konfiguracija.php"> Konfiguracija </a>
                                              <a href="../forme/Statistika.php"> Statistika </a>
                                            </div>
                                       </div>';
                            }
                            if($_SESSION['uloga'] == '2'){
                                echo '<div class="dropdown">
                                            <button class="dropbtn">MODERATOR &#9661;</button>
                                            <div class="dropdown-content">
                                              <a href="../forme/MojiKupnjaZahtjevi.php"> Moji kupnja zahtjevi </a>
                                              <a href="../forme/LicencaKoristenjeZahtjevi.php"> Pregledaj zahtjeve za korištenje</a>
                                              <a href="../forme/MojiKorisniciLicenci.php"> Moji korisnici</a>
                                            </div>
                                       </div>';
                            }
                            if($_SESSION['uloga'] == '3'){
                                echo '<div class="dropdown">
                                            <button class="dropbtn">KORISNIK &#9661;</button>
                                            <div class="dropdown-content">
                                              <a href="../forme/MojiKoristenjeZahtjevi.php"> Moji zahtjevi za korištenje</a>
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
    <section style="text-align:center">
            <div class="odjeljak">
                <h3> Popis svih kategorija </h3>
                <?php 
                    if(isset($_GET['rezultat'])){
                            if($_GET['rezultat'] == '1'){
                                echo '<p style="color:green"> Podaci su uspješno ažurirani u bazi podataka.</p>';
                                header( "refresh:4;url=KategorijaPopis.php" );
                            }
                        }
                ?>
                <div style="min-height: 100px;width: 90%">
                    <div style="float: right; padding-left: 20px; padding-bottom: 20px">
                        <br><br>
                        <input style="height: 30px" onclick="reset();" value="Reset" type="button">
                    </div>
                    <div style="float: right; padding-left: 20px; padding-bottom: 20px">
                        <label> Pretraži po nazivu korisnika </label><br><br>
                        <input style="height: 30px" type="text" id="pretrazi" onkeyup="filtriraj()" name="pretrazi">
                    </div>
                    <div style="float: right; padding-left: 20px; padding-bottom: 20px">
                        <label> Datum do </label><br><br>
                        <input style="height: 30px" id="datum_do" onchange="filtrirajDatum();" type="date">
                    </div>
                    <div style="float: right; padding-left: 20px; padding-bottom: 20px">
                        <label> Datum od </label><br><br>
                        <input style="height: 30px" id="datum_od" onchange="filtrirajDatum();" type="date">
                    </div>
                    
                </div>
                
                <table style="margin: auto" border="0">
                <tr><th>Korisnik</th><th>Opis</th><th>Datum i vrijeme</th></tr>
                <?php
                    $veza = new Baza();
                    $veza->spojiDB();

                    $upit = "select k.korisnicko_ime, dr.opis, dr.datum_vrijeme from dnevnik_rada dr join korisnik k on dr.korisnik_id = k.id order by dr.id desc";
                    $rezultat = $veza->selectDB($upit);

                    $nizZapisa = [];
                    while($red = mysqli_fetch_array($rezultat)){
                        $element = [];
                        $element['korisnicko_ime'] = $red['korisnicko_ime'];
                        $element['opis'] = $red['opis'];
                        $element['datum_vrijeme'] = $red['datum_vrijeme'];
                        $nizZapisa[] = $red;
                    }
                    $veza->zatvoriDB();
                    
                    foreach ($nizZapisa as $value) {
                        echo '<tr>';
                        echo  "<td>{$value['korisnicko_ime']}</td> "
                            . "<td>{$value['opis']}</td> "
                            . "<td>{$value['datum_vrijeme']}</td>";  
                        echo '</tr>';
                    }                
                ?>
                </table>
            </div>
    </section>
    </body>
</html>

