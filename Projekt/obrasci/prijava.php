<?php
    require '../baza.class.php';
    require '../sesija.class.php';
    require '../dnevnik.class.php';
    
    if($_SERVER["HTTPS"] != "on")
    {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
    
    Sesija::dajKorisnika();
    //var_dump($_SESSION);

    if(isset($_GET['odjava'])){
        
        Sesija::dajKorisnika();
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Odjava sa sustava.", $_SESSION['id']);
        
        Sesija::obrisiSesiju();
        header("Location: ../obrasci/prijava.php");
    }
    $zadnjiKorisnik = "";
    if(isset($_COOKIE['zadnjiKorisnik'])){
        $zadnjiKorisnik = $_COOKIE['zadnjiKorisnik'];
    }
    
    if(isset($_POST['submit'])){
        $greska = "";
        
        // Ako sesija nije prazna => već je prijavljen netko
        if(!empty($_SESSION)){
            $greska .= '<p style="color:red"> GREŠKA: Već ste prijavljeni </p>';
        }
        
        foreach ($_POST as $k => $v) {
            //echo $k . " => " . $v . "<br>";
            if(empty($v)){
                $greska .= '<p style="color:red"> GREŠKA: ' . $k . " nije unesen" . '</p>';
            }
        }
        
        if(empty($greska)){
            $korime = $_POST['korime'];
            $lozinka = $_POST['lozinka'];
            $veza = new Baza();
            $veza->spojiDB();
     
            $upit = "select * from korisnik where korisnicko_ime='{$korime}' and lozinka='{$lozinka}' and aktiviran = 1" ;
            $rezultat = $veza->selectDB($upit);
            
            $autenticiran = false;
            $red = mysqli_fetch_array($rezultat);
            
            
            if($red && intval($red['pokusaji_logiranja']) <= 2){
                $autenticiran = true;
                $tip = $red['uloga_id'];
                $id = $red['id'];
                $upit = "update korisnik set pokusaji_logiranja = 0 where korisnicko_ime='{$korime}'";
                $rezultat = $veza->selectDB($upit);
            }
            
            if($autenticiran){
                Sesija::kreirajKorisnika($id, $korime, $tip);
                
                $dnevnik = new Dnevnik();
                $dnevnik->zapisi('Korisnik se uspješno prijavio.', $id);
                
                setcookie("zadnjiKorisnik", $korime);
                header("Location: prijava.php?uspjesnaPrijava");
                
            }
            else{
                $upit = "select * from korisnik where korisnicko_ime='{$korime}' and aktiviran = 1" ;
                $rezultat = $veza->selectDB($upit);
                $red = mysqli_fetch_array($rezultat);
                
                if(intval($red['pokusaji_logiranja']) >= 3){
                    $greska = "<p style='color:red'> GREŠKA: Blokiran vam je račun zbog previše netočnih logiranja. </p>";
                }
                else if($red){        
                    $dnevnik = new Dnevnik();
                    $dnevnik->zapisi('Neuspješna prijava.', $red['id']);
                    
                    $pokusajiLogiranja = intval($red['pokusaji_logiranja']) + 1;
                    
                    $upit = "update korisnik set pokusaji_logiranja = pokusaji_logiranja + 1 where korisnicko_ime='{$korime}' and aktiviran = 1";
                    $rezultat = $veza->selectDB($upit);
                    
                    if($pokusajiLogiranja >= 3){
                        $greska = "<p style='color:red'> GREŠKA: {$korime}, sada ćemo vam blokirati račun zbog prevište netočnih pokušaja logiranja. </p>";
                        $dnevnik = new Dnevnik();
                        $dnevnik->zapisi('Korisnik je blokiran zbog previše neuspješnih logiranja.', $red['id']);
                    }
                    else {
                        $greska = "<p style='color:red'> GREŠKA: {$korime}, neispravni pokušaji logiranja: {$pokusajiLogiranja}/3 </p>";
                    }
                }
                else{
                    $greska .= '<p style="color:red"> GREŠKA: Račun ne postoji ili nije aktiviran.</p>';
                }
            }
            $veza->zatvoriDB();
        }
    }
?>﻿
<!DOCTYPE html>
<html lang="hr">
    <head>
        <title> Prijava </title>
        <meta charset="utf-8">
        <meta name="author" content="Meikl Marić">
        <meta name="keywords" content="Prijava, slanje podataka, post">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_1100.css" media="(max-width: 1100px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_960.css" media="(max-width: 960px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_780.css" media="(max-width: 780px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_480.css" media="(max-width: 480px)">
    </head>
    <body>
 
    <header id="headerPrijava">
       <div class = "container">
            <h2> <span class = "zutiTekst"> Prijava </span></h2>
            <nav>
                <ul>
                    <li><a href="../index.php"> Početna </a></li>
                    <li><a href="registracija.php"> Registracija </a></li>
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
    <section>
        <form novalidate id="form1" method="post" name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class = "odjeljak">
                <h2> Unesite svoje podatke </h2>
                <?php
                    if(isset($greska)){
                       echo $greska; 
                    }
                    if(isset($_GET['uspjesnaPrijava'])){
                        echo '<p style="color:green"> Uspješna prijava. Dobrodošao/la <b>' . $_SESSION['korisnik'] . '</b>!</p>';
                    }  
                    if(isset($_GET['uspjesnaRegistracija'])){
                        echo '<p style="color:green"> Uspješno ste se registrirali. Poslan vam je email sa linkom za aktivaciju.  </p>';
                    }  
                ?>
                <label for="korime">Korisničko ime: </label>
                <input type="text" id="korime" name="korime" placeholder="Korisničko ime" autofocus="autofocus" value="<?php echo $zadnjiKorisnik; ?>"><br>
            </div>
            <div class = "odjeljak">
                <label for="lozinka">Lozinka: </label>
                <input type="password" id="lozinka" name="lozinka" size="20" maxlength="20" placeholder="Lozinka" value="" required="required"><br>
            </div>   
            <div id="gumbOdjeljak" class = "odjeljak">
                <!--<input style="margin-bottom: 20px" type="checkbox" name="vozac" value="1" checked="checked"> Upamti korisničko ime<br>-->
                <input name="submit" id="submit1" type="submit" value=" Prijavi se "> 
            </div>
            <div class = "odjeljak">
                <p> Admin: pperic-1234 </p>
                <p> Moderator: mmirkic-42asd </p>
                <p> Registrirani korisnik: aantic-5436 </p>
            </div>  
        </form>
    </section>
    </body>
</html>