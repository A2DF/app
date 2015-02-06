<html>
    <?php
    include ('html/head.php');

    date_default_timezone_set('UTC');
    $today_int = date("Y-m-d");
    $today_date = date_create($today_int);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filterClient = filter_input(INPUT_POST, 'client');
        $filterEtat = filter_input(INPUT_POST, 'etat');
    } else if ((filter_input(INPUT_GET, 'fc')) || (filter_input(INPUT_GET, 'fe'))) {
        $filterClient = filter_input(INPUT_GET, 'fc');
        $filterEtat = filter_input(INPUT_GET, 'fe');
    } else {
        $filterClient = "";
        $filterEtat = 1;
    }
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css'>
    <script src="lib/sorttable.js"></script>
    <script type="text/javascript" src="lib/nhpup_1.1.js"></script>
    <body onload="haltTimer();
            refreshOnIdle();" onmousemove="haltTimer();">
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
            <div class="mousehover"<A HREF="#" onMouseOver="openPopUp('infoAtelier.php')" onMouseOut="closePopUp('infoAtelier.php')">Légende</A></div>
            <div class="filtres">
                <form action='listeAtelier.php' method='POST' name='formFiltreClient'>
                    <select class="chosen-select" tabindex="2" name="client" onChange="javascript:submit();">
                        <option selected hidden value=''>Tous les clients</option>
                        <?php
                        $comboboxClient = comboboxClient();
                        foreach ($comboboxClient as $client) {
                            $filterId = $client['idClient'];
                            $filterNom = $client['nom'];
                            $filterPrenom = $client['prenom'];
                            if ($filterClient == $filterId) {
                                echo "<option value=" . $filterId . " selected>" . $filterNom . " " . $filterPrenom . "</option>";
                            } else {
                                echo "<option value=" . $filterId . ">" . $filterNom . " " . $filterPrenom . "</option>";
                            }
                        }
                        ?></select>

                    <select class="chosen-select" tabindex="2" name="etat" onChange="javascript:submit();">
                        <?php
                        if ($filterEtat == 0) {
                            echo "<option value='0' selected>Tous les dépannages</option>";
                            echo "<option value='1'>Dépannages en cours</option>";
                            echo "<option value='4'>Clients prévenus</option>";
                            echo "<option value='5'>Dépannages terminés</option>";
                        } else if ($filterEtat == 1) {
                            echo "<option value='0'>Tous les dépannages</option>";
                            echo "<option value='1' selected>Dépannages en cours</option>";
                            echo "<option value='4'>Clients prévenus</option>";
                            echo "<option value='5'>Dépannages terminés</option>";
                        } else if ($filterEtat == 4) {
                            echo "<option value='0'>Tous les dépannages</option>";
                            echo "<option value='1'>Dépannages en cours</option>";
                            echo "<option value='4' selected>Clients prévenus</option>";
                            echo "<option value='5'>Dépannages terminés</option>";
                        } else if ($filterEtat >= 5) {
                            echo "<option value='0'>Tous les dépannages</option>";
                            echo "<option value='1'>Dépannages en cours</option>";
                            echo "<option value='4'>Clients prévenus</option>";
                            echo "<option value='5' selected>Dépannages terminés</option>";
                        }
                        ?>
                    </select>
                    <img src='img/cancel.png' title='Supprimer les filtres' onclick='window.self.location = "listeAtelier.php";'>
                </form>
            </div>
            <?php
            //Affichage de la première ligne du tableau
            echo "<table border='1' class='sortable'>";
            echo "<tr>";
            echo "<th id='numero'>N°</th>";
            echo "<th id='date'>Date</th>";
            echo "<th id='priorite'>Priorité</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='mdp'>MDP</th>";
            echo "<th id='probleme'>Problème</th>";
            echo "<th id='solution'>Solution</th>";
            echo "<th id='prix'>Prix</th>";
            echo "<th id='delai'>Délai</th>";
            echo "<th id='traite'>Etat</th>";
            echo "</tr>";

            $listeAtelier = listeAtelier();
            foreach ($listeAtelier as $atelier) {

                //Récupération des données dans la base
                $idAtelier = $atelier['idAtelier'];
                $dateEntree = $atelier['dateEntree'];
                $priorite = $atelier['libellePriorite'];
                $idClient = $atelier['idClient'];
                $nomClient = $atelier['nomClient'];
                $prenomClient = $atelier['prenomClient'];
                $typeProduit = $atelier['typeProduit'];
                $marqueProduit = $atelier['marqueProduit'];
                $couleurProduit = $atelier['couleurProduit'];
                $mdpProduit = $atelier['mdpProduit'];
                $probleme = $atelier['probleme'];
                $solution = $atelier['solution'];
                $prix = $atelier['prix'];

                $traitement = $atelier['idTraitement'];

                $dateConvert = date_create($dateEntree);
                $dateFr = date_format($dateConvert, 'd/m/Y');

                if ((($filterClient == $idClient) || ($filterClient == "")) && (($filterEtat == $traitement) || (($filterEtat == 1) && ($traitement < 4)) || ($filterEtat == 0))) {

                    //Affichage des données dans le tableau
                    echo "<tr>";
                    echo "<td>" . $idAtelier . "</td>";
                    echo "<td>" . $dateFr . "</td>";

                    if ($priorite == "Urgent") {
                        echo "<td class='urgent'>" . $priorite . "</td>";
                    } else if ($priorite == "Important") {
                        echo "<td class='important'>" . $priorite . "</td>";
                    } else if ($priorite == "Normal") {
                        echo "<td class='normal'>" . $priorite . "</td>";
                    }
                    ?>
                    <td class="info" ><?php echo $nomClient . " " . $prenomClient . " " ?><img src="img/information.png" title="Informations" onclick="window.open('infoClient.php?id=<?php echo $idClient ?>', 'search', '\
                                                                                                                                                                                                                                                                                                                                                            left=500, \n\
                                                                                                                                                                                                                                                                                                                                                            top=150, \n\
                                                                                                                                                                                                                                                                                                                                                            width=450, \n\
                                                                                                                                                                                                                                                                                                                                                            height=380, \n\
                                                                                                                                                                                                                                                                                                                                                            scrollbars=no, \n\
                                                                                                                                                                                                                                                                                                                                                            resizable=no, \n\
                                                                                                                                                                                                                                                                                                                                                            dependant=yes')"/>
                    </td>
                    <?php
                    echo "<td>" . $typeProduit . " " . $marqueProduit . " " . $couleurProduit . "</td>";
                    echo "<td>" . $mdpProduit . "</td>";
                    echo "<td>" . $probleme;
                    ?>
                    <img src='img/pencil.png' title='Modifier le problème' onclick="window.open('ajoutProbleme.php?id=<?php echo $idAtelier; ?>&fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>', 'search', '\
                                                                                                                                                                                                                                                                                                                            left=500, \n\
                                                                                                                                                                                                                                                                                                                            top=150, \n\
                                                                                                                                                                                                                                                                                                                            width=520, \n\
                                                                                                                                                                                                                                                                                                                            height=200, \n\
                                                                                                                                                                                                                                                                                                                            scrollbars=no, \n\
                                                                                                                                                                                                                                                                                                                            resizable=no, \n\
                                                                                                                                                                                                                                                                                                                            dependant=yes')"/>
                         <?php
                         echo "</td><td>" . $solution;
                         ?>
                    <img src='img/pencil.png' title='Modifier la solution' onclick="window.open('ajoutSolution.php?id=<?php echo $idAtelier; ?>&fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>', 'search', '\
                                                                                                                                                                                                                                                                                                                            left=500, \n\
                                                                                                                                                                                                                                                                                                                            top=150, \n\
                                                                                                                                                                                                                                                                                                                            width=520, \n\
                                                                                                                                                                                                                                                                                                                            height=200, \n\
                                                                                                                                                                                                                                                                                                                            scrollbars=no, \n\
                                                                                                                                                                                                                                                                                                                            resizable=no, \n\
                                                                                                                                                                                                                                                                                                                            dependant=yes')"/>

                    <?php
                    echo "</td>";
                    echo "<td>" . $prix . "€";
                    ?>
                    <img src='img/pencil.png' title='Modifier le prix' onclick="window.open('ajoutPrix.php?id=<?php echo $idAtelier; ?>&fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>', 'search', '\
                                                                                                                                                                                                                                                                                                                    left=500, \n\
                                                                                                                                                                                                                                                                                                                    top=150, \n\
                                                                                                                                                                                                                                                                                                                    width=520, \n\
                                                                                                                                                                                                                                                                                                                    height=200, \n\
                                                                                                                                                                                                                                                                                                                    scrollbars=no, \n\
                                                                                                                                                                                                                                                                                                                    resizable=no, \n\
                                                                                                                                                                                                                                                                                                                    dependant=yes')"/>
                         <?php
                         echo "</td>";

                         $entree_date = date_create($dateEntree);
                         $diff = date_diff($today_date, $entree_date)->format('%a');

                         $interval = $today_date->diff($entree_date);
                         $days = $interval->days;
                         $period = new DatePeriod($entree_date, new DateInterval('P1D'), $today_date);

                         foreach ($period as $dt) {
                             $curr = $dt->format('D');

                             if ($curr == 'Sat' || $curr == 'Sun') {
                                 $days--;
                             }
                         }

                         if ($days <= 0) {
                             echo "<td><div class='progress'><div class='progress-bar' id='zero'></div></div></td>";
                         } else if ($days == 1) {
                             echo "<td><div class='progress'><div class='progress-bar' id='thirtythree'></div></div></td>";
                         } else if ($days == 2) {
                             echo "<td><div class='progress'><div class='progress-bar' id='sixtysix'></div></div></td>";
                         } else if ($days >= 3) {
                             echo "<td><div class='progress'><div class='progress-bar' id='onehundred'></div></div></td>";
                         }

                         if ($traitement == 1) {
                             ?><td><a href="listeAtelier.php?id=<?php echo $idAtelier ?>&etat=<?php echo $traitement ?>&fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>"><img src="img/ball_red.png" title="Machine non traitée" onclick="return(confirm('Dépannage en cours ?'));"/></a></td><?php
                    } else if ($traitement == 2) {
                        ?><td><a href="listeAtelier.php?id=<?php echo $idAtelier ?>&etat=<?php echo $traitement ?>&fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>"><img src="img/ball_yellow.png" title="Dépannage en cours" onclick="return(confirm('Dépannage terminé ?'));"/></a></td><?php
                            } else if ($traitement == 3) {
                                ?><td><a href="listeAtelier.php?id=<?php echo $idAtelier ?>&etat=<?php echo $traitement ?>&fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>"><img src="img/ball_green.png" title="Dépannage terminé" onclick="return(confirm('Client prévenu ?'));"/></a></td><?php
                            } else if ($traitement == 4) {
                                ?><td><a href="listeAtelier.php?id=<?php echo $idAtelier ?>&etat=<?php echo $traitement ?>&fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>"><img src="img/bell.png" title="Client prévenu" onclick="return(confirm('Rendu au client ?'));"/></a></td><?php
                            } else if ($traitement == 5) {
                                ?><td><img src='img/give_back.png' title='Rendu au client'/></td><?php
                            }
                            ?>
                    <td id='print'><a target=_blank href="printAtelier.php?id=<?php echo $idAtelier ?>"><img src='img/printer.png' title='Imprimer la fiche atelier'/></a></td>
                    <?php
                    echo "</tr>";
                }
            }
            echo "</table>";
            ?>
        </div>
        <?php
        $id = filter_input(INPUT_GET, 'id');
        $etat = filter_input(INPUT_GET, 'etat');
        if (($_SERVER["REQUEST_METHOD"] == "GET") && ($id > 0)) {
            traiterAtelier($id, $etat);
            ?>
            <script language="javascript">
                window.self.location = "listeAtelier.php?fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>";
            </script>
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