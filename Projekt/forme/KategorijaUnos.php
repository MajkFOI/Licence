<?php
    require '../baza.class.php';
    require '../sesija.class.php';
    require '../dnevnik.class.php';
    
    // Odjava
    if(isset($_GET['odjava'])){
        var_dump($_GET);
        
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
    
    $greska = "";
    
    if(isset($_POST['submit'])){
        
        if(empty($_POST['naziv'])){
            $greska .= '<p style="color:red"> Naziv ne može biti prazan. </p>';
        }
        else{
            $naziv = $_POST['naziv'];
            
            $veza = new Baza();
            $veza->spojiDB();

            $upit = "insert into kategorija(naziv) values('{$naziv}')";
            $rezultat = $veza->updateDB($upit);
            
            $veza->zatvoriDB();
            
            $dnevnik = new Dnevnik();
            $dnevnik->zapisi("Administrator unosi novu kategoriju: $naziv", $_SESSION['id']);
            
            //header("Location: ?rezultat={$rezultat}");
        }
    }
?>
<!DOCTYPE html>
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
    </head>
    <body>
    <header id="headerObrazac">
	   <div class = "container">
            <h2> <span class = "zutiTekst"> Unos kategorije </span></h2>
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
                <h3> Unesite naziv nove kategorije </h3>
                <?php
                    if(isset($_GET['rezultat'])){
                        if($_GET['rezultat'] == '1'){
                            echo '<p style="color:green"> Podaci su zapisani u bazu podataka. (Gumb posalji disablean, redirect za 4 sec) </p>';
                            header( "refresh:4;url=KategorijaPopis.php" );
                        }
                    }
                    if(isset($_POST['submit'])){
                        if(!empty($greska)){
                             echo $greska; 
                         }
                    }
                ?>
            </div>
            <div class="odjeljak">
                <input name="naziv" type="text">
            </div>
            <div id="gumbOdjeljak" class = "odjeljak">
                <input name="submit" id="submit1" type="submit" value=" Unesi " <?php if(isset($_GET['rezultat'])) { ?> disabled <?php } ?>>
                <input id="reset" type="reset">
            </div>
        </form>
    </section>
    </body>
</html>