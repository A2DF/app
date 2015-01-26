<html>

    <?php
    include ('html/head.html');
    include ('private/requetes.php');

    date_default_timezone_set('UTC');
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <script src="lib/sorttable.js"></script>

    <body>
        <div class="ribbon-wrapper">
            <a  href="ajoutAppel.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" /></a>
            <div class="ribbon-front"><div>Liste des appels</div></div>
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
            echo "<th id='date'>Date</th>";
            echo "<th id='priorite'>Priorite</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='tel'>Fixe</th>";
            echo "<th id='portable'>Portable</th>";
            echo "<th id='pour'>Pour</th>";
            echo "<th id='commentaire'>Motif</th>";
            echo "<th id='commentaire'>Commentaire</th>";
            echo "<th id='traite'>Traité</th>";

            echo "</tr>";

            $listeAppel = listeAppel();
            foreach ($listeAppel as $appel) {

                //Récupération des données dans la base
                $idAppel = $appel['idAppel'];
                $date = $appel['date'];
                $nomClient = $appel['nomClient'];
                $prenomClient = $appel['prenomClient'];
                $tel = $appel['tel'];
                $portable = $appel['portable'];
                $personnel = $appel['personnel'];
                $motif = $appel['motif'];
                $priorite = $appel['libelle'];
                $traite = $appel['traite'];
                $commentaire = $appel['commentaire'];

                if ($traite == 0) {

                    $dateConvert = date_create($date);
                    $dateFr = date_format($dateConvert, 'd/m/Y');
                    //Affichage des données dans le tableau
                    echo "<tr>";
                    echo "<td>" . $dateFr . "</td>";

                    if ($priorite == "Urgent") {
                        echo "<td class='urgent'>" . $priorite . "</td>";
                    } else if ($priorite == "Important") {
                        echo "<td class='important'>" . $priorite . "</td>";
                    } else if ($priorite == "Normal") {
                        echo "<td class='normal'>" . $priorite . "</td>";
                    }

                    echo "<td>" . $nomClient . " " . $prenomClient . "</td>";
                    echo "<td>" . $tel . "</td>";
                    echo "<td>" . $portable . "</td>";
                    echo "<td>" . $personnel . "</td>";
                    echo "<td>" . $motif . "</td>";
                    
                    if ($commentaire == "") {
                        ?><td><a href="listeAppel.php"><img src='img/pencil_add.png' title='Ajouter un commentaire' onclick="window.open('ajoutCommentaire.php?id=<?php echo $idAppel; ?>', 'search', '\
                                                                                                                                                                    left=500, \n\
                                                                                                                                                                    top=150, \n\
                                                                                                                                                                    width=500, \n\
                                                                                                                                                                    height=190, \n\
                                                                                                                                                                    scrollbars=no, \n\
                                                                                                                                                                    resizable=no, \n\
                                                                                                                                                                    dependant=yes')"/></a></td><?php
                    } else {
                        echo "<td>" . $commentaire . "</td>";
                    }
                    
                    ?><td><a href="listeAppel.php?id=<?php echo $idAppel ?>"><img src='img/tick_light_blue.png' title='Appel traité' onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet appel ?'));"/></a></td><?php
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

        <?php
        $id = filter_input(INPUT_GET, 'id');
        if (($_SERVER["REQUEST_METHOD"] == "GET") && ($id > 0)) {
            traiterAppel($id);
            ?>
            <script language="javascript">window.self.location = "listeAppel.php";</script>    
            <?php
        }
        ?>

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