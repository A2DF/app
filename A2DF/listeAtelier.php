<html>

    <?php
    include ('html/head.html');
    include ('private/requetes.php');

    date_default_timezone_set('UTC');
    $today_int = date("Y-m-d");
    $today_date = date_create($today_int);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filterClient = filter_input(INPUT_POST, 'client');
        $filterEtat = filter_input(INPUT_POST, 'etat');
    } else {
        $filterClient = "";
        $filterEtat = 1;
    }
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css'>
    <script src="lib/sorttable.js"></script>
    <script type="text/javascript" src="lib/nhpup_1.1.js"></script>
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
            <div class="mousehover"<A HREF="#" onMouseOver="openPopUp('legendeAtelier.php')" onMouseOut="closePopUp('legendeAtelier.php')">Légende</A></div>
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
                    if ($filterEtat < 1) {
                        echo "<option value='1'>Dépannages en cours</option>";
                        echo "<option value='0' selected>Tous les dépannages</option>";
                    } else {
                        echo "<option value='1' selected>Dépannages en cours</option>";
                        echo "<option value='0'>Tous les dépannages</option>";
                    }
                    ?>
                </select>
            </form>
            </div>
            <?php
            //Affichage de la première ligne du tableau
            echo "<table border='1' class='sortable'>";
            echo "<tr>";
            echo "<th id='date'>Date</th>";
            echo "<th id='priorite'>Priorité</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='mdp'>MDP</th>";
            echo "<th id='commentaire'>Problème</th>";
            echo "<th id='formule'>Service</th>";
            echo "<th id='delai'>Délai</th>";
            echo "<th id='traite'>Etat</th>";
            echo "</tr>";

            $listeAtelier = listeAtelier();
            foreach ($listeAtelier as $atelier) {

                //Récupération des données dans la base
                $idAtelier = $atelier['idAtelier'];
                $dateEntree = $atelier['dateEntree'];
                $idClient = $atelier['idClient'];
                $nomClient = $atelier['nomClient'];
                $prenomClient = $atelier['prenomClient'];
                $libelleFormule = $atelier['libelleFormule'];
                $typeProduit = $atelier['typeProduit'];
                $marqueProduit = $atelier['marqueProduit'];
                $couleurProduit = $atelier['couleurProduit'];
                $mdpProduit = $atelier['mdpProduit'];
                $probleme = $atelier['probleme'];
                $priorite = $atelier['libellePriorite'];
                $traitement = $atelier['idTraitement'];

                $dateConvert = date_create($dateEntree);
                $dateFr = date_format($dateConvert, 'd/m/Y');

                if ((($filterClient == $idClient) || ($filterClient == "")) && (($traitement < 5) || ($filterEtat == 0))) {

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
                    echo "<td>" . $typeProduit . " " . $marqueProduit . " " . $couleurProduit . "</td>";
                    echo "<td>" . $mdpProduit . "</td>";
                    echo "<td>" . $probleme . "</td>";
                    echo "<td>" . $libelleFormule . "</td>";

                    $entree_date = date_create($dateEntree);
                    $diff = date_diff($today_date, $entree_date)->format('%a');
                    $duree = (int) $diff;

                    if ($diff <= 0) {
                        echo "<td><div class='progress'><div class='progress-bar' id='zero'></div></div></td>";
                    } else if ($diff == 1) {
                        echo "<td><div class='progress'><div class='progress-bar' id='thirtythree'></div></div></td>";
                    } else if ($diff == 2) {
                        echo "<td><div class='progress'><div class='progress-bar' id='sixtysix'></div></div></td>";
                    } else if ($diff >= 3) {
                        echo "<td><div class='progress'><div class='progress-bar' id='onehundred'></div></div></td>";
                    }

                    if ($traitement == 1) {
                        ?><td><a href="listeAtelier.php?id=<?php echo $idAtelier ?>&etat=<?php echo $traitement ?>"><img src="img/ball_red.png" title="Machine non traitée" onclick="return(confirm('Dépannage en cours ?'));"/></a></td><?php
                    } else if ($traitement == 2) {
                        ?><td><a href="listeAtelier.php?id=<?php echo $idAtelier ?>&etat=<?php echo $traitement ?>"><img src="img/ball_yellow.png" title="Dépannage en cours" onclick="return(confirm('Dépannage terminé ?'));"/></a></td><?php
                    } else if ($traitement == 3) {
                        ?><td><a href="listeAtelier.php?id=<?php echo $idAtelier ?>&etat=<?php echo $traitement ?>"><img src="img/ball_green.png" title="Dépannage terminé" onclick="return(confirm('Client prévenu ?'));"/></a></td><?php
                    } else if ($traitement == 4) {
                        ?><td><a href="listeAtelier.php?id=<?php echo $idAtelier ?>&etat=<?php echo $traitement ?>"><img src="img/bell.png" title="Client prévenu" onclick="return(confirm('Rendu au client ?'));"/></a></td><?php
                    } else if ($traitement == 5) {
                        ?><td><img src='img/give_back.png' title='Rendu au client'/></td><?php
                    }
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

        <?php
        $id = filter_input(INPUT_GET, 'id');
        $etat = filter_input(INPUT_GET, 'etat');
        if (($_SERVER["REQUEST_METHOD"] == "GET") && ($id > 0)) {
            traiterAtelier($id, $etat);
            ?>
            <script language="javascript">
                window.self.location = "listeAtelier.php";
            </script>
            <?php
        }
        ?>
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