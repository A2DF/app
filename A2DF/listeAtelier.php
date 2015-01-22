<html>

    <?php
    include ('html/head.html');
    include ('private/requetes.php');
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <script src="lib/sorttable.js"></script>

    <body>
        <div class="ribbon-wrapper">
            <a  href="ajoutAtelier.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" /></a>
            <div class="ribbon-front"><div>Liste de suivi d'atelier</div></div>
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
            echo "<th id='dateEntree'>Date d'entrée</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='formule'>Service</th>";
            echo "<th id='typeProduit'>Type</th>";
            echo "<th id='marqueProduit'>Marque</th>";
            echo "<th id='couleurProduit'>Couleur</th>";
            echo "<th id='mdpProduit'>Mot de passe</th>";
            echo "<th id='probleme'>Commentaire</th>";
            echo "</tr>";

            $listeAtelier = listeAtelier();
            foreach ($listeAtelier as $atelier) {

                //Récupération des données dans la base
                $dateEntree = $atelier['dateEntree'];
                $nomClient = $atelier['nomClient'];
                $libelleFormule = $atelier['libelleFormule'];
                $typeProduit = $atelier['typeProduit'];
                $marqueProduit = $atelier['marqueProduit'];
                $couleurProduit = $atelier['couleurProduit'];
                $mdpProduit = $atelier['mdpProduit'];
                $probleme = $atelier['probleme'];

                if ($traite == 0) {
                    //Affichage des données dans le tableau
                    echo "<tr>";
                    echo "<td>" . $dateEntree . "</td>";
                    echo "<td>" . $nomClient . " " . $prenomClient . "</td>";
                    echo "<td>" . $libelleFormule . "</td>";
                    echo "<td>" . $typeProduit . "</td>";
                    echo "<td>" . $marqueProduit . "</td>";
                    echo "<td>" . $couleurProduit . "</td>";
                    echo "<td>" . $mdpProduit . "</td>";
                    echo "<td>" . $probleme . "</td>";


                    ?>
                    <?php
                    echo "</tr>";
                }
            }

            echo "</table>";
            ?>
        </div>
        <a class="backtotop" href="#" onclick="backtotop();
                return false;"><img src="img/up6.png" onclick="backtotop();
                        return false;" alt="Retour haut de page">
        </a>

            <script language="javascript">window.self.location = "listeAtelier.php";</script>    

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