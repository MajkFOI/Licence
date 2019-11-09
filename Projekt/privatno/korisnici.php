<!DOCTYPE html>
<html lang="hr">
<head>
    <title> Početna stranica </title>
    <meta charset="utf-8">
    <meta name="author" content="Meikl Marić">
    <meta name="keywords" content="Pocetna stranica, članci, predstavljanje">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/mmaric_1100.css" media="(max-width: 1100px)">
    <link rel="stylesheet" type="text/css" href="../css/mmaric_960.css" media="(max-width: 960px)">
    <link rel="stylesheet" type="text/css" href="../css/mmaric_780.css" media="(max-width: 780px)">
    <link rel="stylesheet" type="text/css" href="../css/mmaric_480.css" media="(max-width: 480px)">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>  
</head>
<body>
    <header>
        <div class = "container">
            <h2> <span class = "zutiTekst"> Početna </span> stranica </h2>
            <nav>
                <ul>
                    <li><a href="../index.php"> Početna </a></li>
                    <li><a href="../obrasci/prijava.php"> Prijava </a></li>
                    <li><a href="../obrasci/registracija.php"> Registracija </a></li>
                    <li><a href="../obrasci/obrazac.php"> Obrazac </a></li>
                </ul>
            </nav>
        </div>
    </header>
        <section id = "sekcija1" style="padding-bottom: 100px; padding-top:50px">
        <table style="margin: auto; max-width: 70%; text-align: center;" border="0">
        <tr><th>id</th><th>korisnicko_ime</th><th>lozinka</th><th>email</th></tr>
        <?php
            require '../baza.class.php';
            $veza = new Baza();
            $veza->spojiDB();

            $upit = "select * from korisnik";
            $rezultat = $veza->selectDB($upit);

            $nizZapisa = [];
            while($red = mysqli_fetch_array($rezultat)){
                $element = [];
                $element['id'] = $red['id'];
                $element['korisnicko_ime'] = $red['korisnicko_ime'];
                $element['lozinka'] = $red['lozinka'];
                $element['email'] = $red['email'];
                $nizZapisa[] = $red;
            }
            $veza->zatvoriDB();
            foreach ($nizZapisa as $value) {
                echo '<form method="post" action="forme/LicencaKupnjaZahtjev.php">';
                echo '<tr>';
                echo  "<td> {$value['id']} </td>"
                    . "<td> {$value['korisnicko_ime']} </td>"
                    . "<td> {$value['lozinka']} </td>"
                    . "<td> {$value['email']} </td>";
                echo '</tr></form>';
            }
        ?>
        </table>
        </section>
</body>
</html>
