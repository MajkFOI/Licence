<?php
    require '../baza.class.php';
    require '../sesija.class.php';
    require '../dnevnik.class.php';
?>
<!DOCTYPE html>
<html lang="hr" >
    <head>
        <title> Pregled zahtjeva </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_1100.css" media="(max-width: 1100px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_960.css" media="(max-width: 960px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_780.css" media="(max-width: 780px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_480.css" media="(max-width: 480px)">
    </head>
    <body>
    <header id="headerObrazac">
	   <div class = "container">
            <h2> <span class = "zutiTekst"> Pregled zahtjeva </span></h2>
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
                <h3> Popis zahtjeva </h3>
                
                <table style="margin: auto; text-align:center" border="0">
                <?php
                
                    if(isset($_GET['kod'])){
    
                        $kod = $_GET['kod'];

                        $veza = new Baza();
                        $veza->spojiDB();

                        $upit = "select id from korisnik where kod_aktivacije = '$kod'";

                        $rezultat = $veza->selectDB($upit);
                        $red = mysqli_fetch_array($rezultat);

                        $korisnikID = $red['id'];
                        
                        $upit = "update korisnik set aktiviran = 1, kod_aktivacije = null where id = $korisnikID";

                        $rezultat = $veza->selectDB($upit);
                        

                        $veza->zatvoriDB();
                        
                        if($rezultat == 1) 
                            echo '<p style="color:green">Račun vam je aktiviran, sada se možete prijaviti. </p>';
                    
                         
                        $dnevnik = new Dnevnik();
                        $dnevnik->zapisi("Korisnik je aktivirao svoj račun.", $korisnikID);
                    }
                ?>
                </table>
            </div>
    </section>
    </body>
</html>
