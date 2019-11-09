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
    else if(intval(($_SESSION['uloga'])) > 3){
        header("Location: ../index.php");
    }
    
    if(isset($_POST['vratiID'])){
        $veza = new Baza();
        $veza->spojiDB();
        
        $vratiID = $_POST['vratiID'];
        // Kada se licenca vrati, postaje slobodna pa se količina povećava
        $upit = "select kupnja_id from korištenje where id = {$vratiID}";
        $rezultat = $veza->selectDB($upit);

        $red = mysqli_fetch_array($rezultat);
        
        $kupnjaID = $red['kupnja_id'];
        
        $upit = "update kupnja set kolicina = kolicina + 1 where id = {$kupnjaID}";
        $rezultat = $veza->selectDB($upit);

        // Postavljanje statusa 3 (vraćeno)
        $upit = "update korištenje set status_id = 3 where id = {$vratiID}";
        $rezultat = $veza->selectDB($upit);

        $veza->zatvoriDB();
        
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Korisnik vraća licencu (ID korištenja: $vratiID, ID kupnje: $kupnjaID).", $_SESSION['id']);
        
        header("Location: ?rezultat={$rezultat}");
    }
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
    <section style="text-align:center">
            <div class="odjeljak">
                <h3> Moji zahtjevi za korištenje </h3>
                <?php 
                    if(isset($_GET['rezultat'])){
                            if($_GET['rezultat'] == '1'){
                                echo '<p style="color:green"> Podaci su uspješno ažurirani u bazi podataka.</p>';
                                header("refresh:4;url=MojiKoristenjeZahtjevi.php");
                            }
                        }
                ?>
                
                <table style="margin: auto; text-align:center" border="0">
                <tr><th>id_koristenja</th><th>vlasnik</th><th>licenca</th><th>status</th><th>Preostalo</th><th>Vrijedi do</th><th>generirani_kljuc</th><th></th></tr>
                <?php
                    $veza = new Baza();
                    $veza->spojiDB();

                    $upit =   "select ko.id, ko.status_id, ko.kupnja_id, ko.generirani_ključ, ku.kolicina, ku.datum_do, l.naziv as 'licenca', s.naziv as 'status', k.korisnicko_ime as 'vlasnik' "
                            . "from korištenje ko "
                            . "join kupnja ku on ko.kupnja_id = ku.id "
                            . "join licenca l on ku.licenca_id = l.id "
                            . "join status s on ko.status_id = s.id "
                            . "join korisnik k on ko.korisnik_id = k.id "
                            . "where ko.korisnik_id = {$_SESSION['id']}"; // ku.korisnik_id = vlasnik kupnje(moderator)
                    $rezultat = $veza->selectDB($upit);

                    $nizZapisa = [];
                    while($red = mysqli_fetch_array($rezultat)){
                        $element = [];
                        $element['id'] = $red['id'];
                        $element['status_id'] = $red['status_id'];
                        $element['kupnja_id'] = $red['kupnja_id'];
                        $element['kolicina'] = $red['kolicina'];
                        $element['datum_do'] = $red['datum_do'];
                        $element['generirani_ključ'] = $red['generirani_ključ'];
                        $element['licenca'] = $red['licenca'];
                        $element['status'] = $red['status'];
                        $element['vlasnik'] = $red['vlasnik'];
                        
                        $nizZapisa[] = $element;
                    }
                    $veza->zatvoriDB();
                    
                    foreach ($nizZapisa as $value) {
                        echo '<tr>';
                        echo  "<td> {$value['id']} </td> "
                            . "<td> {$value['vlasnik']} </td> "
                            . "<td> {$value['licenca']} </td>"
                            . "<td> {$value['status']} </td>"
                            . "<td> {$value['kolicina']} </td>"
                            . "<td> {$value['datum_do']} </td>";
                            
                            // Ako je status 4 ili više ne vrijedi, ne prikaži generirani ključ
                            if(intval($value['status_id']) === 3 || $value['datum_do'] <= date(('Y-m-d'))){
                                echo "<td> </td>";
                            }
                            else echo "<td> {$value['generirani_ključ']} </td>";
                            // Ako je odobren (status 4) i preostalo je više od 3 dana prikazi gumb VRATI
                            if($value['status_id'] == 4 && $value['datum_do'] >= date(('Y-m-d'), strtotime(date('Y-m-d') . " + 3 day"))){
                                echo "<td><form method='post' action=''>"
                                    . "<button type='submit' name='vratiID' value='{$value['id']}'> Vrati </button>"
                                    . "</form></td>";  
                            }
                        echo '</tr>';
                    }                
                ?>
                </table>
            </div>
    </section>
    </body>
</html>
