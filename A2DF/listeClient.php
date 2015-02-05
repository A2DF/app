<html>
    <?php
    include ('html/head.php');

    date_default_timezone_set('UTC');
    $today_int = date("Y-m-d");
    $today_date = date_create($today_int);
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css'>
    <script src="lib/sorttable.js"></script>

    <body onload="haltTimer();
            refreshOnIdle();" onmousemove="haltTimer();">
        <div class="ribbon-wrapper">
            <a  href="ajoutPersonnel.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" /></a>
            <div class="ribbon-front"><div>Liste des clients</div></div>
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
            echo "<th id='client'>Employé</th>";
            echo "<th id='date'>Date Embauche</th>";
            echo "<th id='commentaire'>Adresse</th>";
            echo "<th id='tel'>Fixe</th>";
            echo "<th id='tel'>Portable</th>";
            echo "<th id='tel'>Courriel</th>";
            echo "<th id='numSecu'>Numéro Sécu</th>";
            echo "<th id='contrat'>Contrat</th>";
            echo "<th id='salaire'>Salaire</th>";


            echo "</tr>";

            $listePersonnel = listePersonnel();
            foreach ($listePersonnel as $personnel) {

                //Récupération des données dans la base
                $idPersonnel = $personnel['idPersonnel'];
                $nom = $personnel['nom'];
                $prenom = $personnel['prenom'];
                $dateEmbauche = $personnel['dateEmbauche'];
                $adresse = $personnel['adresse'];
                $cp = $personnel['cp'];
                $ville = $personnel['ville'];
                $tel = $personnel['tel'];
                $portable = $personnel['portable'];
                $courriel = $personnel['courriel'];
                $numSecu = $personnel['numSecu'];
                $contrat = $personnel['contrat'];
                $salaire = $personnel['salaire'];



                $dateConvert = date_create($dateEmbauche);
                $dateFr = date_format($dateConvert, 'd/m/Y');

                if ($dateEmbauche == 0000 - 00 - 00) {
                    $dateFr = "";
                }
                //Affichage des données dans le tableau
                echo "<tr>";
                ?>
                <td class="info" ><?php echo $nom . " " . $prenom . " " ?><img src="img/information.png" title="Informations" onclick="window.open('infoPersonnel.php?id=<?php echo $idPersonnel ?>', 'search', '\
                                                                                                                                                                                                                        left=500, \n\
                                                                                                                                                                                                                        top=150, \n\
                                                                                                                                                                                                                        width=450, \n\
                                                                                                                                                                                                                        height=500, \n\
                                                                                                                                                                                                                        scrollbars=no, \n\
                                                                                                                                                                                                                        resizable=no, \n\
                                                                                                                                                                                                                        dependant=yes')"/>
                </td>
                <?php
                echo "<td>" . $dateFr . "</td>";
                echo "<td>" . $adresse . " " . $cp . " " . $ville . "</td>";
                echo "<td>" . $tel . "</td>";
                echo "<td>" . $portable . "</td>";
                echo "<td>" . $courriel . "</td>";
                echo "<td>" . $numSecu . "</td>";
                echo "<td>" . $contrat . "</td>";
                echo "<td>" . $salaire . "€</td>";
            }
            ?>
        </div>
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