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
            <a  href="ajoutPret.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" /></a>
            <div class="ribbon-front"><div>Liste des prêts</div></div>
            <div class="ribbon-edge-topleft"></div>
            <div class="ribbon-edge-topright"></div>
            <div class="ribbon-edge-bottomleft"></div>
            <div class="ribbon-edge-bottomright"></div>
            <div class="ribbon-back-left"></div>
            <div class="ribbon-back-right"></div>
        </div>
        <div class="tableaux">
            <div class="filtres">
                <form action='listePret.php' method='POST' name='formFiltrePret'>
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
                            echo "<option value='1'>Prêts en cours</option>";
                            echo "<option value='0' selected>Tous les prêts</option>";
                        } else {
                            echo "<option value='1' selected>Prêts en cours</option>";
                            echo "<option value='0'>Tous les prêts</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>



            <?php
            //Affichage de la première ligne du tableau
            echo "<table border='1' class='sortable'>";
            echo "<tr>";
            echo "<th id='dateCommande'>Date du prêt</th>";
            echo "<th id='dateCommande'>Date retour du prêt</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='reference'>Reference</th>";
            echo "<th id='probleme'>Motif</th>";
            echo "<th id='date'>Statut</th>";
            echo "</tr>";

            $listePret = listePret();
            foreach ($listePret as $pret) {

                //Récupération des données dans la base
                $idPret = $pret['idPret'];
                $datePret = $pret['datePret'];
                $dateRetour = $pret['dateRetour'];
                $idClient = $pret['idClient'];
                $nomClient = $pret['nomClient'];
                $prenomClient = $pret['prenomClient'];
                $typeProduit = $pret['typeProduit'];
                $marqueProduit = $pret['marqueProduit'];
                $couleurProduit = $pret['couleurProduit'];
                $reference = $pret['reference'];
                $motif = $pret['motif'];
                $etat = $pret['etat'];
                $dateConvert = date_create($datePret);
                $dateFr = date_format($dateConvert, 'd/m/Y');
                $dateConverter = date_create($dateRetour);
                $dateFrLiv = date_format($dateConverter, 'd/m/Y');


                if ((($filterClient == $idClient) || ($filterClient == "")) && (($etat < 1) || ($filterEtat == 0))) {


                    //Affichage des données dans le tableau
                    echo "<tr>";
                    echo "<td>" . $dateFr . "</td>";
                    echo "<td>" . $dateFrLiv . "</td>";
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
                    echo "<td>" . $reference . "</td>";
                    echo "<td>" . $motif . "</td>";

                    if ($etat == 0) {
                        ?><td><a href="listePret.php?id=<?php echo $idPret ?>&etat=<?php echo $etat ?>"><INPUT type="button" name="nom" value="En prêt" onclick="return(confirm('Le client a rendu son prêt ?'));"/></a></td><?php
                    } else if ($etat == 1) {
                        ?><td>Rendu</td><?php
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
            traiterPret($id, $etat);
            ?>
            <script language="javascript">window.self.location = "listePret.php";</script>    
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