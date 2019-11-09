<?php
    require '../baza.class.php';
    require '../sesija.class.php';
    require '../dnevnik.class.php';

    Sesija::dajKorisnika();
    
    if(isset($_GET['odjava'])){
        
        Sesija::dajKorisnika();
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Odjava sa sustava.", $_SESSION['id']);
        
        Sesija::obrisiSesiju();
        header("Location: ../obrasci/prijava.php");
    }
    
    if(isset($_POST['submit'])){
        //var_dump($_POST);
        $greska = "";
        foreach ($_POST as $k => $v) {
            if(empty($v) && $k != 'g-recaptcha-response'){
                $greska .= '<p style="color:red">'. 'GREŠKA: ' . $k . " nije unesen";
            }
            else if(strpos($v, "'") !== false || strpos($v, "!") !== false || strpos($v, "?") !== false || strpos($v, "#") !== false){
                $greska .= '<p style="color:red">'. 'GREŠKA: ' . $k . " sadrži nedopušten znak";
            }
        }
        
        $email = $_POST['email'];
        // NE smije biti
        $re = preg_match("/(?:\.\.)|(?:[^a-zA-Z0-9@_.])|(?:@\.)|(?:\..\.)|(?:^\.)/", $email);
        // Mora biti
        $re2 = preg_match("/(?:@.*[\.].{2,})/", $email);
        
        if($re || !$re2){
            $greska .= '<p style="color:red">'. 'GREŠKA: Neispravan format maila.'; 
        }
        
        if(strlen($_POST['korime']) > 45){
            $greska .= '<p style="color:red">'. 'GREŠKA: Korisničko ime predugačko.'; 
        }
        if(strlen($_POST['lozinka1']) > 45){
            $greska .= '<p style="color:red">'. 'GREŠKA: Lozinka predugačka.'; 
        }
        if($_POST['lozinka1'] != $_POST['lozinka2']){
            $greska .= '<p style="color:red">'. 'GREŠKA: Lozinke različite.'; 
        }

        $public_key = '6Ld1-qUUAAAAANd_stE8VWTigZKdZkdIh8aqd775';
        $private_key = '6Ld1-qUUAAAAAEk3p7TpZYNLKhmD3YPwNBYq4H4L';
        $url = "https://www.google.com/recaptcha/api/siteverify";

        // CAPTCHA
        $res = $_POST['g-recaptcha-response'];
            
        $response = file_get_contents($url . '?secret=' . $private_key . '&response=' . $res . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
        
        $response = json_decode($response);
        //var_dump($response);
        
        if($response->success != 1){
            $greska .= '<p style="color:red">'. 'GREŠKA: CAPTCHA nije ispravna!';
        }

        if(empty($greska)){
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $korime = $_POST['korime'];
            $lozinka = $_POST['lozinka1'];
            $email = $_POST['email'];
            $kriptirana_lozinka = sha1($lozinka);
            
            $veza = new Baza();
            $veza->spojiDB();
            
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 15; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            
            $upit = "insert into korisnik(uloga_id, ime, prezime, korisnicko_ime, lozinka, email, kriptirana_lozinka, kod_aktivacije) "
                    . "values('3','{$ime}', '{$prezime}', '{$korime}', '{$lozinka}', '{$email}', '{$kriptirana_lozinka}', '{$randomString}')" ;
            $rezultat = $veza->updateDB($upit);

            $mail_to = "mmaric@foi.hr";
            $mail_from = "From: WebDiP_2018@foi.hr";
            $mail_subject = "Aktivacija";
            $mail_body = "Link za aktivaciju: https://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x091/forme/Aktivacija.php?kod=$randomString";

            mail($mail_to, $mail_subject, $mail_body, $mail_from);
            
            $upit = "select id from korisnik where korisnicko_ime = '{$korime}'";
            $rezultat = $veza->selectDB($upit);

            $red = mysqli_fetch_array($rezultat);
            
            $veza->zatvoriDB();
            
            $dnevnik = new Dnevnik();
            $dnevnik->zapisi("Korisnik je registriran i poslan mu je kod($randomString) za aktivaciju.", $red['id']);
            
            header("Location: prijava.php?uspjesnaRegistracija=1");
        }
    }
?>﻿
<!DOCTYPE html>
<html lang="hr">
    <head>  
        <title> Registracija </title>
        <meta charset="utf-8">
        <meta name="author" content="Meikl Marić">
        <meta name="keywords" content="Registracija, slanje podataka, post ">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_1100.css" media="(max-width: 1100px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_960.css" media="(max-width: 960px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_780.css" media="(max-width: 780px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_480.css" media="(max-width: 480px)">
        
        <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>  
        
        <script type="text/javascript" src="../javascript/mmaric_jquery.js"></script>
        <script type="text/javascript" src="../javascript/Registracija.js"></script>
    </head>
    <body>
     <header id="headerRegistracija">
         <div class = "container">
             <h2> <span class = "zutiTekst"> Registracija </span></h2>
             <nav>
                 <ul>
                     <li><a href="../index.php"> Početna </a></li>
                     <li><a href="prijava.php"> Prijava </a></li>
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
                <div id="greske">
                    <?php
                        if(isset($greska)){
                           echo $greska; 
                        }
                        if(isset($_GET['rezultat'])){
                            echo '<p style="color:green"> Poslan vam je mail sa linkom za aktivaciju </p>';
                            header( "refresh:4;url=../ostalo/multimedija.php" );
                        }
                    ?>
                </div>
                <h2> Unesite tražene podatke </h2>
            </div>
            <div class = "odjeljak">
                <label for="ime"> Ime: </label>
                <input type="text" id="ime" name="ime" placeholder="Ime" autofocus="autofocus" onkeyup="provjeriIme()" required="required"><br>
            </div>
            <div class = "odjeljak">
                <label for="prezime"> Prezime: </label>
                <input type="text" id="prezime" name="prezime" placeholder="Prezime" onkeyup="provjeriPrezime()" autofocus="autofocus" required="required"><br>
            </div>
            <div class = "odjeljak">
                <label for="korime">Korisničko ime: </label>
                <input type="text" id="korime" name="korime" placeholder="Korisničko ime" onkeyup="provjeriKorIme()" autofocus="autofocus" required="required"><br>
            </div>
            <div class = "odjeljak">
                <label for="lozinka1">Lozinka: </label>
                <input type="text" id="lozinka1" name="lozinka1" size="15" placeholder="Lozinka" onkeyup="provjeriLozinku1()" required="required"><br>
            </div>
            <div class = "odjeljak">
                <label for="lozinka2">Lozinka: </label>
                <input type="text" id="lozinka2" name="lozinka2" size="15" placeholder="Lozinka" onkeyup="provjeriLozinku2()" required="required"><br>
            </div>  
            <div class = "odjeljak">
                <label for="email">Email adresa: </label>
                <input type="email" id="email" name="email" size="35" placeholder="ime.prezime@posluzitelj.xxx" onkeyup="provjeriLozinku2()" required="required"><br>
            </div>
            <div class = "odjeljak">
                <div class="g-recaptcha" data-sitekey="6Ld1-qUUAAAAANd_stE8VWTigZKdZkdIh8aqd775"></div>
                <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
                       ...
                    });
                });
                </script>
            </div>
            <div id="gumbOdjeljak" class = "odjeljak">
                <input name="submit" id="submit1" type="submit" value=" Registriraj se " <?php if(isset($_GET['rezultat'])) { ?> disabled <?php } ?>> 
            </div>
        </form>
    </section>
    </body>
</html>