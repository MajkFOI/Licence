<?php
    require 'baza.class.php';
    require 'sesija.class.php';
    require 'dnevnik.class.php';
    Sesija::dajKorisnika();
    
    //var_dump($_SESSION);
    
    if(isset($_GET['odjava'])){
        
        Sesija::dajKorisnika();
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Odjava sa sustava.", $_SESSION['id']);
        
        Sesija::obrisiSesiju();
        header("Location: obrasci/prijava.php");
    }
    
    if(isset($_POST['kupnjaID'])){
        $veza = new Baza();
        $veza->spojiDB();
        
        $kupnjaID = $_POST['kupnjaID'];
            
        $upit = "insert into korištenje(korisnik_id, status_id, kupnja_id) "
                    . "values({$_SESSION['id']}, 6, {$kupnjaID})"; 
                     // 6 - NA ČEKANJU (POTVRDE OD MODERATORA)
        $rezultat = $veza->updateDB($upit);
        $veza->zatvoriDB();
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Korisnik šalje zahtjev za korištenjem licence (ID kupnje: $kupnjaID).", $_SESSION['id']);
        header("Location: index.php?rezultat={$rezultat}");
    }
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <title> Početna stranica </title>
    <meta charset="utf-8">
    <meta name="author" content="Meikl Marić">
    <meta name="keywords" content="Pocetna stranica, članci, predstavljanje">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mmaric_1100.css" media="(max-width: 1100px)">
    <link rel="stylesheet" type="text/css" href="css/mmaric_960.css" media="(max-width: 960px)">
    <link rel="stylesheet" type="text/css" href="css/mmaric_780.css" media="(max-width: 780px)">
    <link rel="stylesheet" type="text/css" href="css/mmaric_480.css" media="(max-width: 480px)">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>  
    
    <script src="javascript/Index.js"></script>
    <script src="javascript/Index_jquery.js"></script>
</head>
<body>
    <header>
        <div class = "container">
            <h2> <span class = "zutiTekst"> Početna </span> stranica </h2>
            <nav>
                <ul>
                    <li><a href="obrasci/prijava.php"> Prijava </a></li>
                    <li><a href="obrasci/registracija.php"> Registracija </a></li>
                    <li><a href="o_autoru.html"> O autoru </a></li>
                    <li><a href="dokumentacija.html"> Dokumentacija </a></li>
                    <?php 
                        if(isset($_SESSION['uloga'])){
                            // 1 - administrator
                            if($_SESSION['uloga'] == '1'){
                                echo '<div class="dropdown">
                                            <button class="dropbtn">ADMIN &#9661;</button>
                                            <div class="dropdown-content">
                                              <a href="forme/KategorijaUnos.php"> Unesi kategoriju </a>
                                              <a href="forme/KategorijaPopis.php"> Popis kategorija </a>
                                              <a href="forme/LicencaUnos.php"> Unesi licencu </a>
                                              <a href="forme/LicencaPopis.php"> Popis licenci </a>
                                              <a href="forme/PopisBlokiranih.php"> Popis blokiranih </a>
                                              <a href="forme/PopisKorisnika.php"> Popis korisnika </a>
                                              <a href="forme/LicencaKupnjaZahtjevi.php"> Pregledaj zahtjeve za kupnju</a>
                                              <a href="forme/Dnevnik.php"> Dnevnik </a>
                                              <a href="forme/Konfiguracija.php"> Konfiguracija </a>
                                              <a href="forme/Statistika.php"> Statistika </a>
                                            </div>
                                       </div>';
                            }
                            if($_SESSION['uloga'] == '2'){
                                echo '<div class="dropdown">
                                            <button class="dropbtn">MODERATOR &#9661;</button>
                                            <div class="dropdown-content">
                                              <a href="forme/MojiKupnjaZahtjevi.php"> Moji kupnja zahtjevi </a>
                                              <a href="forme/LicencaKoristenjeZahtjevi.php"> Pregledaj zahtjeve za korištenje</a>
                                              <a href="forme/MojiKorisniciLicenci.php"> Moji korisnici</a>
                                            </div>
                                       </div>';
                            }
                            if($_SESSION['uloga'] == '3'){
                                echo '<div class="dropdown">
                                            <button class="dropbtn">KORISNIK &#9661;</button>
                                            <div class="dropdown-content">
                                              <a href="forme/MojiKoristenjeZahtjevi.php"> Moji zahtjevi za korištenje</a>
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
    <?php
        if(isset($_GET['rezultat'])){
            if($_GET['rezultat'] == '1'){
                echo "<p style='color:green; text-align:center'> Kreirali ste zahtjev za korištenje licence, trebate pričekati da ju moderator odobri. </p>";
                header("refresh:4;url=index.php");
            }
        }
    ?>    
    <?php if(isset($_SESSION['uloga'])) { if($_SESSION['uloga'] <= 2){ ?>
        <section id = "sekcija1" style="padding-bottom: 100px; padding-top:50px">
        <table style="margin: auto; max-width: 70%; text-align: center;" border="0">
        <tr><th>ID</th><th>Naziv</th><th>Opis</th><th>Slika</th><th>Kategorija</th><th></th><th></th></tr>
        <?php
            $veza = new Baza();
            $veza->spojiDB();

            $upit = "select l.id, k.naziv as 'katNaziv', l.naziv, l.opis, l.slika from licenca l join kategorija k on l.kategorija_id = k.id";
            $rezultat = $veza->selectDB($upit);

            $nizZapisa = [];
            while($red = mysqli_fetch_array($rezultat)){
                $element = [];
                $element['id'] = $red['id'];
                $element['katNaziv'] = $red['katNaziv'];
                $element['naziv'] = $red['naziv'];
                $element['opis'] = $red['opis'];
                $element['slika'] = $red['slika'];
                $nizZapisa[] = $red;
            }
            $veza->zatvoriDB();
            foreach ($nizZapisa as $value) {
                echo '<form method="post" action="forme/LicencaKupnjaZahtjev.php">';
                echo '<tr>';
                echo  "<td> {$value['id']} </td>"
                    . "<td> {$value['naziv']} </td>"
                    . "<td> {$value['opis']} </td>"
                    . "<td> {$value['slika']} </td>"
                    . "<td> {$value['katNaziv']} </td>"
                    . "<td> <button type='submit' name='licencaID' value='{$value['id']}'> Kreiraj zahtjev </button></td>";
                echo '</tr></form>';
            }
        ?>
        </table>
        </section>
    <?php }} ?>  
    <section id = "sekcija2" style="min-height: 1000px">
        <div style="width: 90%">
            <div style="float: right; padding-left: 50px; padding-bottom: 20px">
                <label> Pretraži po nazivu licence </label><br><br>
                <input style="height: 30px" type="text" id="pretrazi" name="pretrazi">
            </div>
            <div style="float: right">
                <label> Filtriraj prema kategoriji: </label><br><br>
                <select id="filtriraj">
                    <option value="0kategorija">Sve</option>
                    <?php
                        $veza = new Baza();
                        $veza->spojiDB();

                        $upit = "select id, naziv from kategorija";
                        
                        $rezultat = $veza->selectDB($upit);
                        
                        while($red = mysqli_fetch_array($rezultat)){
                            echo "<option value={$red['id']}kategorija>{$red['naziv']}</option>";
                        }
                    
                        $veza->zatvoriDB();
                    ?>
                </select>
            </div>
        </div>
        <?php
            $veza = new Baza();
            $veza->spojiDB();

            $datum = date('Y-m-d');
            $upit = "select count(*) as 'brojac' "
                    . "from kupnja ku "
                    . "join korisnik ko on ku.korisnik_id = ko.id "
                    . "join licenca l on ku.licenca_id = l.id "
                    . "join kategorija k on l.kategorija_id = k.id "
                    . "where ku.status_id = 1 and ku.datum_do > '{$datum}' and ku.kolicina > 0 "; // dohvati samo one koji kupnje koje su odobrene (status=1) i koji vrijede i kolicina >0
            $rezultat = $veza->selectDB($upit);

            $red = mysqli_fetch_array($rezultat);
            $brojacZapisa = 
            
            $veza->zatvoriDB();
            
            // Sve licence ajaxom dodane
            echo '<div class = "container">';
            
            echo '</div>';  
        ?>
        <div style="min-height: 50px">
        <?php
            // Dohvat broja stranica
            $veza = new Baza();
            $veza->spojiDB();

            $upit = 'select stranicenje from konfiguracija where id=1';
            $rezultat = $veza->selectDB($upit);
            
            $red = mysqli_fetch_array($rezultat);
            $broj_stranica = $red['stranicenje'];
            
            $veza->zatvoriDB();
            
            // Stranicenje
            echo '<div class="pagination" style="width: 20%; margin:auto">';
            
            echo '</div>';
        ?>
        </div>
    </section>
</body>
</html>