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
    
    if(isset($_GET['kupnjaID'])){
        $veza = new Baza();
        $veza->spojiDB();

        $kupnjaID = $_GET['kupnjaID'];
        $datum = date("Y-m-d H:i:s");
        
        $upit = "update kupnja set status_id = 1, datum_vrijeme_promjene_statusa = '{$datum}' where id = {$kupnjaID}"; //status_id = 1 -> Prihvaćena kupnja 
        $rezultat = $veza->selectDB($upit);

        $veza->zatvoriDB();
        
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Administator odobrava kupnju (ID kupnje: $kupnjaID).", $_SESSION['id']);
        
        header("Location: ?rezultat={$rezultat}");
    }
    
    if(isset($_GET['odbijID'])){
        $veza = new Baza();
        $veza->spojiDB();

        $odbijID = $_GET['odbijID'];
        $datum = date("Y-m-d H:i:s");
        
        $upit = "update kupnja set status_id = 2, datum_vrijeme_promjene_statusa = '{$datum}' where id = {$odbijID}"; //status_id = 1 -> Prihvaćena kupnja 
        $rezultat = $veza->selectDB($upit);

        $veza->zatvoriDB();
        
        $dnevnik = new Dnevnik();
        $dnevnik->zapisi("Administator odbija kupnju (ID kupnje: $odbijID).", $_SESSION['id']);
        
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
            <h2> <span class = "zutiTekst"> Pregled zahtjeva za kupnju </span></h2>
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
                <h3> Popis zahtjeva za kupnju </h3>
                <?php 
                    if(isset($_GET['rezultat'])){
                            if($_GET['rezultat'] == '1'){
                                echo '<p style="color:green"> Podaci su uspješno ažurirani u bazi podataka.</p>';
                                header("refresh:4;url=LicencaKupnjaZahtjevi.php");
                            }
                        }
                ?>
                
                <table style="margin: auto; text-align:center" border="0">
                <tr><th>ID</th><th>Korisnik</th><th>Licenca</th><th>Količina</th><th>Iznos</th><th>Status</th><th></th></tr>
                <?php
                    $veza = new Baza();
                    $veza->spojiDB();

                    $upit =   "select ku.id, ku.korisnik_id, ku.status_id, ku.kolicina, ku.iznos, ku.datum_od, ku.datum_do, k.korisnicko_ime, l.naziv as 'licNaziv', s.naziv as 'statNaziv' "
                            . "from kupnja ku "
                            . "join korisnik k on ku.korisnik_id = k.id "
                            . "join licenca l on ku.licenca_id = l.id "
                            . "join status s on ku.status_id = s.id "
                            . "where ku.status_id = 6"; // 6 - Na čekanju
                    $rezultat = $veza->selectDB($upit);

                    $nizZapisa = [];
                    while($red = mysqli_fetch_array($rezultat)){
                        $element = [];
                        $element['id'] = $red['id'];
                        $element['korisnik_id'] = $red['korisnik_id'];
                        $element['status_id'] = $red['status_id'];
                        $element['iznos'] = $red['iznos'];
                        $element['kolicina'] = $red['kolicina'];
                        $element['licNaziv'] = $red['licNaziv'];
                        $element['statNaziv'] = $red['statNaziv'];
                        $element['korisnicko_ime'] = $red['korisnicko_ime'];
                        
                        $nizZapisa[] = $element;
                    }
                    $veza->zatvoriDB();
                    
                    foreach ($nizZapisa as $value) {
                        echo '<tr>';
                        echo  "<td> {$value['id']} </td> "
                            . "<td> {$value['korisnicko_ime']} </td> "
                            . "<td> {$value['licNaziv']} </td>"
                            . "<td> {$value['kolicina']} </td>"
                            . "<td> {$value['iznos']} </td>"
                            . "<td> {$value['statNaziv']} </td>"
                            . "<td> <button type='button' onclick=location.href='LicencaKupnjaZahtjevi.php?kupnjaID={$value['id']}'> Odobri </button></td>"
                            . "<td> <button type='button' onclick=location.href='LicencaKupnjaZahtjevi.php?odbijID={$value['id']}'> Odbij </button></td>";
                        echo '</tr>';
                    }                
                ?>
                </table>
            </div>
    </section>
    </body>
</html>