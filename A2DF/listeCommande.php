<html>

    <?php
    include ('html/head.html');
    include ('private/requetes.php');

    date_default_timezone_set('UTC');
    $today_int = date("Y-m-d");
    $today_date = date_create($today_int);
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css'>
    <script src="lib/sorttable.js"></script>
    <script type="text/javascript" src="lib/nhpup_1.1.js"></script>
    <body>
        <div class="ribbon-wrapper">
            <a  href="ajoutCommande.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" /></a>
            <div class="ribbon-front"><div>Liste des commandes</div></div>
            <div class="ribbon-edge-topleft"></div>
            <div class="ribbon-edge-topright"></div>
            <div class="ribbon-edge-bottomleft"></div>
            <div class="ribbon-edge-bottomright"></div>
            <div class="ribbon-back-left"></div>
            <div class="ribbon-back-right"></div>
        </div>
        <div class="tableaux">
            <?php
            //Affichage de la première ligne du tableau
            echo "<table border='1' class='sortable'>";
            echo "<tr>";
            echo "<th id='dateCommande'>Date commande</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='prix'>Prix</th>";
            echo "<th id='traitement'>Paiement éffectué</th>";
            echo "</tr>";

            $listeCommande = listeCommande();
            foreach ($listeCommande as $commande) {

                //Récupération des données dans la base
                $idCommande = $commande['idCommande'];
                $dateCommande = $commande['dateCommande'];
                $dateBonCommande = $commande['dateBonCommande'];
                $idClient = $commande['idClient'];
                $nomClient = $commande['nomClient'];
                $prenomClient = $commande['prenomClient'];
                $typeProduit = $commande['typeProduit'];
                $marqueProduit = $commande['marqueProduit'];
                $couleurProduit = $commande['couleurProduit'];
                $prix = $commande['prix'];
                $idTraitement = $commande['idTraitement'];
                $traite = $commande['traite'];
                $dateConvert = date_create($date);
                $dateFr = date_format($dateConvert, 'd/m/Y');

                if ($traite == 0) {


                    //Affichage des données dans le tableau
                    echo "<tr>";
                    echo "<td>" . $dateCommande . "</td>";
                    echo "<td>" . $nomClient . " " . $prenomClient . "</td>";
                    echo "<td>" . $typeProduit . " " . $marqueProduit . " " . $couleurProduit . "</td>";
                    echo "<td>" . $prix . "</td>";
                    echo "<td>" . $idTraitement . "</td>";
                }
            }

            echo "</table>";
            ?>
        </div>

            <?php
            $id = filter_input(INPUT_GET, 'id');
            if (($_SERVER["REQUEST_METHOD"] == "GET") && ($id > 0)) {
                traiterCommande($id);
                ?>
            <script language="javascript">window.self.location = "listeCommande.php";</script>    
            <?php
        }
        ?>
        <a class="backtotop" href="#" onclick="backtotop();
                return false;"><img src="img/up6.png" onclick="backtotop();
                        return false;" alt="Retour haut de page">
        </a>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
        <script src="lib/chosen.jquery.js" type="text/javascript"></script>
        <script type="text/javascript">
                    var config = {
                        '.chosen-select': {},
                        '.chosen-select-deselect': {allow_single_deselect: true},
                        '.chosen-select-no-single': {disable_search_threshold: 10},
                        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                        '.chosen-select-width': {width: "95%"}
                    }
                    for (var selector in config) {
                        $(selector).chosen(config[selector]);
                    }
        </script>
        <script>
            var timeOut;
            function backtotop() {
                if (document.body.scrollTop !== 0 || document.documentElement.scrollTop !== 0) {
                    window.scrollBy(0, -50);
                    timeOut = setTimeout('backtotop()', 25);
                }
                else
                    clearTimeout(timeOut);
            }
        </script>
    </body>
</html>