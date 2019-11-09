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
    
    $greska = "";
    
    $userfile_name = "";
    if(isset($_POST['submit'])){
        if(empty($_POST['naziv'])){
            $greska .= '<p style="color:red">GREŠKA: Naziv nije unesen!</p>';
        }
        if(empty($_POST['opis'])){
            $greska .= '<p style="color:red">GREŠKA: Opis nije unesen!</p>';
        }
        
        $userfile = $_FILES['userfile']['tmp_name'];
        $userfile_name = $_FILES['userfile']['name'];
        $userfile_size = $_FILES['userfile']['size'];
        $userfile_type = $_FILES['userfile']['type'];
        $userfile_error = $_FILES['userfile']['error'];
        $upfile = '../slike/' . $userfile_name;
        if(!empty($userfile_name)){
            if($userfile_name){
                if ($userfile_error > 0){
                    echo 'Problem: ';
                    switch ($userfile_error) {
                        case 1: $greska .= 'Veličina veća od ' . ini_get('upload_max_filesize');
                            break;
                        case 2: $greska .=  'Veličina veća od ' . $_POST["MAX_FILE_SIZE"] . 'B';
                            break;
                        case 3: $greska .=  'Datoteka djelomično prenesena';
                            break;
                        case 4: $greska .=  'Datoteka nije prenesena';
                            break;
                    }
                }
  
                //Prijenos slika samo
                $dozvoljene_datoteke = array("image/png", "image/jpg", "image/jpeg");
                if (!in_array(strtolower($userfile_type), $dozvoljene_datoteke)) {
                    $greska .= '<p style="color:red">GREŠKA: Datoteka (' . $userfile_type . ') nije slika!</p>';
                }
            }
        }
            
        if(empty($greska)){
            if(!empty($userfile_name)){ 
                if (is_uploaded_file($userfile)){
                    move_uploaded_file($userfile, $upfile);
                }
            }
            else{
                $userfile_name = 'unaprijedPripremljena.jpg';
            }
            $veza = new Baza();
            $veza->spojiDB();

            $kategorija_id = intval($_POST['kategorija']);

            $upit = "insert into licenca(kategorija_id, naziv, opis, slika) "
                    . "values({$kategorija_id},'{$_POST['naziv']}', '{$_POST['opis']}', '{$userfile_name}')";
            $rezultat = $veza->updateDB($upit);
            $veza->zatvoriDB();
            
            $dnevnik = new Dnevnik();
            $dnevnik->zapisi("Administrator unosi novu licencu: {$_POST['naziv']} u kategoriju $kategorija_id.", $_SESSION['id']);

            header("Location: ?rezultat={$rezultat}");   
        }
    }
    
?>
<!DOCTYPE html>
<html lang="hr" >
    <head>
        <title> Unos licence </title>
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
    <body onload="kreirajDogadaje();">
    <header id="headerObrazac">
	   <div class = "container">
            <h2> <span class = "zutiTekst"> Unos licence </span></h2>
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
    
        <form novalidate id="form1" enctype="multipart/form-data" method="post" action="">
            <div class="odjeljak">
                <h3> Unesite podatke </h3>
                <?php
                    if(isset($_GET['rezultat'])){
                        if($_GET['rezultat'] == '1'){
                            echo '<p style="color:green"> Podaci su zapisani u bazu podataka. (Gumb posalji disablean, redirect za 4 sec) </p>';
                            header( "refresh:4;url=LicencaPopis.php" );
                        }
                    }
                    if(!empty($greska)){
                        echo $greska;
                    }
                ?>
            </div>
            <div class="odjeljak" name="kategorija">
                
                <label> Odaberite kategoriju </label>
                <select name="kategorija">
                    <?php
                        $veza = new Baza();
                        $veza->spojiDB();

                        $upit = "select id,naziv from kategorija";
                        $rezultat = $veza->selectDB($upit);

                        $nizZapisa = [];
                        while($red = mysqli_fetch_array($rezultat)){
                            $element = []; 
                            $element['id'] = $red['id'];
                            $element['naziv'] = $red['naziv'];
                            $nizZapisa[] = $element;
                        }
                        $veza->zatvoriDB();
                        
                        foreach ($nizZapisa as $value) {
                            echo "<option value='{$value['id']}'>{$value['naziv']}</option>";
                        }                
                    ?>
                </select>
            </div>
            <div class="odjeljak" >
                <label> Naziv  </label>
                <input type="text" name="naziv" value="">
            </div>
            
            <div class="odjeljak">
                <label> Opis  </label>
                <textarea style="width:100%; max-width: 100%; height: 100px" type="text" name="opis"></textarea>
            </div>
            
            <div class="odjeljak">
                <label> Slika  </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <input name="userfile" type="file" />
            </div>

            <div id="gumbOdjeljak" class = "odjeljak">
                <input name="submit" id="submit1" type="submit" value="Unesi" <?php if(isset($_GET['rezultat'])) { ?> disabled <?php } ?>>
                <input id="reset" type="reset">
            </div>
        </form>
    </section>
    </body>
</html>