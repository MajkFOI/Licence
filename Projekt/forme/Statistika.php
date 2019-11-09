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
    else if(intval(($_SESSION['uloga'])) > 1){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="hr" >
    <head>
        <title> Statistika </title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_1100.css" media="(max-width: 1100px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_960.css" media="(max-width: 960px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_780.css" media="(max-width: 780px)">
        <link rel="stylesheet" type="text/css" href="../css/mmaric_480.css" media="(max-width: 480px)">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>  
        <script src="../javascript/Statistika_jquery.js"></script>
        
    </head>
    <body>
    <header id="headerObrazac">
	   <div class = "container">
            <h2> <span class = "zutiTekst"> Statistika zahtjeva za kupnju </span></h2>
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
                <div style="min-height: 100px;width: 90%">
                    <div style="float: right; padding-left: 20px; padding-bottom: 20px">
                        <label> Datum do </label><br><br>
                        <input style="height: 30px" id="datum_do" type="date">
                    </div>
                    <div style="float: right; padding-left: 20px; padding-bottom: 20px">
                        <label> Datum od </label><br><br>
                        <input style="height: 30px" id="datum_od" type="date">
                    </div>  
                    <div style="float: right; padding-left: 20px; padding-bottom: 20px">
                        <label> Kategorija </label><br><br>
                        <select id="kategorija">
                        echo "<option value='0'>Sve</option>"
                        <?php
                            $veza = new Baza();
                            $veza->spojiDB();


                            $upit = "select id, naziv from kategorija";  

                            $rezultat = $veza->selectDB($upit);
                            while($red = mysqli_fetch_array($rezultat)){
                                echo "<option value='{$red['id']}'>{$red['naziv']}</option>";
                            }
                        
                        
                        ?>
                        </select>
                    </div>
                </div>
                
                <h3> Popis zahtjeva za kupnju </h3>
                <?php 
                    if(isset($_GET['rezultat'])){
                            if($_GET['rezultat'] == '1'){
                                echo '<p style="color:green"> Podaci su uspješno ažurirani u bazi podataka.</p>';
                                header("refresh:4;url=LicencaKupnjaZahtjevi.php");
                            }
                        }
                ?>
                
                <table id="tablica" style="margin: auto; text-align:center" border="0">
                
                
                </table>
            </div>
    </section>
    </body>
</html>

