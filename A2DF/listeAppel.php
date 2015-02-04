<html>
    <?php
    include ('html/head.php');

    date_default_timezone_set('UTC');

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

    <body onload="haltTimer(); refreshOnIdle();" onmousemove="haltTimer();">
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
            <div class="filtres">
                <form action='listeAppel.php' method='POST' name='formFiltreClient'>
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
                            echo "<option value='1'>Appels en cours</option>";
                            echo "<option value='0' selected>Tous les appels</option>";
                        } else {
                            echo "<option value='1' selected>Appels en cours</option>";
                            echo "<option value='0'>Tous les appels</option>";
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
                $idClient = $appel['idClient'];
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

                if ((($filterClient == $idClient) || ($filterClient == "")) && (($traite < 1) || ($filterEtat == 0))) {

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
                    echo "<td>" . wordwrap($tel,2," ",1) . "</td>";
                    echo "<td>" . wordwrap($portable,2," ",1) . "</td>";
                    echo "<td>" . $personnel . "</td>";
                    echo "<td>" . $motif . "</td>";

                    if ($commentaire == "") {
                        ?><td><a href="listeAppel.php"><img src='img/pencil_add.png' title='Ajouter un commentaire' onclick="window.open('ajoutCommentaire.php?id=<?php echo $idAppel; ?>', 'search', '\
                                                                                                                                                                                                                                                        left=500, \n\
                                                                                                                                                                                                                                                        top=150, \n\
                                                                                                                                                                                                                                                        width=520, \n\
                                                                                                                                                                                                                                                        height=200, \n\
                                                                                                                                                                                                                                                        scrollbars=no, \n\
                                                                                                                                                                                                                                                        resizable=no, \n\
                                                                                                                                                                                                                                                        dependant=yes')"/></a></td><?php
                                                      } else {
                                                          echo "<td>" . $commentaire . "</td>";
                                                      }
                                                      ?>
                    <td><a href="listeAppel.php?id=<?php echo $idAppel ?>">
                            <img <?php
                if ($traite == 0) {
                    if ($commentaire == "") {
                        echo "src='img/tick_light_blue.png'";
                    } else {
                        echo "src='img/time.png'";
                    }
                } else {
                    echo "src='img/give_back.png'";
                }
                                                      ?>title='Appel traité' onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet appel ?'));"/></a></td>
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
        if (($_SERVER["REQUEST_METHOD"] == "GET") && ($id > 0)) {
            traiterAppel($id);
            ?>
            <script language="javascript">window.self.location = "listeAppel.php";</script>    
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