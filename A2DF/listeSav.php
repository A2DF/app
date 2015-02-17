<html>
    <?php
    include ('html/head.php');

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
    <body onload="haltTimer();
            refreshOnIdle();" onmousemove="haltTimer();">
        <div class="ribbon-wrapper">
            <a  href="ajoutSav.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" /></a>
            <div class="ribbon-front"><div>Liste des S.A.V.</div></div>
            <div class="ribbon-edge-topleft"></div>
            <div class="ribbon-edge-topright"></div>
            <div class="ribbon-edge-bottomleft"></div>
            <div class="ribbon-edge-bottomright"></div>
            <div class="ribbon-back-left"></div>
            <div class="ribbon-back-right"></div>
        </div>
        <div class="tableaux">

            <div class="filtres">
                <form action='listeSav.php' method='POST' name='formFiltreClient'>
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
                            echo "<option value='1'>S.A.V. en cours</option>";
                            echo "<option value='0' selected>Tous les S.A.V.</option>";
                        } else {
                            echo "<option value='1' selected>S.A.V. en cours</option>";
                            echo "<option value='0'>Touts les S.A.V.</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>


            <?php
            //Affichage de la première ligne du tableau
            echo "<table border='1' class='sortable'>";
            echo "<tr>";
            echo "<th id='date'>Date du retour</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='reference'>Numéro de serie</th>";
            echo "<th id='mdp'>MDP</th>";
            echo "<th id='probleme'>Problème</th>";
            echo "</tr>";

            $listeSav = listeSav();
            foreach ($listeSav as $sav) {

                //Récupération des données dans la base
                $idSAV = $sav['idSAV'];
                $date = $sav['date'];
                $idClient = $sav['idClient'];
                $nomClient = $sav['nomClient'];
                $prenomClient = $sav['prenomClient'];
                $typeProduit = $sav['typeProduit'];
                $marqueProduit = $sav['marqueProduit'];
                $couleurProduit = $sav['couleurProduit'];
                $numSerie = $sav['numSerie'];
                $mdpProduit = $sav['mdpProduit'];
                $probleme = $sav['probleme'];
                $idEtat = $sav['idEtat'];
                $dateConvert = date_create($date);
                $dateFr = date_format($dateConvert, 'd/m/Y');


                if ((($filterClient == $idClient) || ($filterClient == "")) && (($idEtat < 3) || ($filterEtat == 0))) {
                    //Affichage des données dans le tableau
                    echo "<tr>";
                    echo "<td>" . $dateFr . "</td>";
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
                    echo "<td>" . $numSerie . "</td>";
                    echo "<td>" . $mdpProduit . "</td>";
                    echo "<td>" . $probleme . "</td>";

                    if ($idEtat == 0) {
                        ?><td><a href="listeSav.php?id=<?php echo $idSAV ?>&etat=<?php echo $idEtat ?>"><INPUT type="button" name="nom" value="<?php echo $idEtat ?>" onclick="return(confirm('Allez vous traiter ce SAV ?'));"/></a></td><?php
                    } else if ($idEtat == 1) {
                        ?><td><a href="listeSav.php?id=<?php echo $idSAV ?>&etat=<?php echo $idEtat ?>"><INPUT type="button" name="nom" value="<?php echo $idEtat ?>" onclick="return(confirm('Le SAV est terminé ?'));"/></a></td><?php
                            } else if ($idEtat == 2) {
                                ?><td><?php echo $idEtat ?></td><?php
                            }
                            ?>
                            <?php
                        }
                    }

                    echo "</table>";
                    ?>
        </div>

        <?php
        $id = filter_input(INPUT_GET, 'id');
        $etat = filter_input(INPUT_GET, 'etat');
        if (($_SERVER["REQUEST_METHOD"] == "GET") && ($id > 0)) {
            traiterSav($id, $etat);
            //if($etat==1){
        

            //}
            ?>
            <script language="javascript">window.self.location = "listeSav.php";</script>    
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