<html>
    <?php
    include ('html/head.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filterClient = filter_input(INPUT_POST, 'client');
    } else {
        $filterClient = "";
    }
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css'>
    <script src="lib/sorttable.js"></script>

    <body onload="haltTimer();
            refreshOnIdle();" onmousemove="haltTimer();">
        <div class="ribbon-wrapper">
            <img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" onclick="window.open('ajoutClient.php', 'search', '\
                                                                                                                                                                        left=500, \n\
                                                                                                                                                                        top=150, \n\
                                                                                                                                                                        width=450, \n\
                                                                                                                                                                        height=380, \n\
                                                                                                                                                                        scrollbars=no, \n\
                                                                                                                                                                        resizable=no, \n\
                                                                                                                                                                        dependant=yes');"/>
            <div class="ribbon-front"><div>Liste des clients</div></div>
            <div class="ribbon-edge-topleft"></div>
            <div class="ribbon-edge-topright"></div>
            <div class="ribbon-edge-bottomleft"></div>
            <div class="ribbon-edge-bottomright"></div>
            <div class="ribbon-back-left"></div>
            <div class="ribbon-back-right"></div>
        </div>
        <div class="tableaux">
            <div class="filtres">
                <form action='listeClient.php' method='POST' name='formFiltreClient'>
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
                </form>
            </div>
            <?php
            //Affichage de la première ligne du tableau
            echo "<table border='1' class='sortable'>";
            echo "<tr>";
            echo "<th id='client'>Client</th>";
            echo "<th id='commentaire'>Adresse</th>";
            echo "<th id='tel'>Courriel</th>";
            echo "<th id='tel'>Fixe</th>";
            echo "<th id='tel'>Portable</th>";
            echo "</tr>";

            $listeClient = listeClient();
            foreach ($listeClient as $client) {

                //Récupération des données dans la base
                $idClient = $client['idClient'];
                $nom = $client['nom'];
                $prenom = $client['prenom'];
                $adresse = $client['adresse'];
                $cp = $client['cp'];
                $ville = $client['ville'];
                $courriel = $client['courriel'];
                $tel = $client['tel'];
                $portable = $client['portable'];

                if (($filterClient == $idClient) || ($filterClient == "")) {
                    //Affichage des données dans le tableau
                    echo "<tr>";
                    ?>
                    <td class="info" ><?php echo $nom . " " . $prenom . " " ?><img src="img/information.png" title="Informations" onclick="window.open('infoClient.php?id=<?php echo $idClient ?>', 'search', '\
                                                                                                                                                                                                                                                    left=500, \n\
                                                                                                                                                                                                                                                    top=150, \n\
                                                                                                                                                                                                                                                    width=450, \n\
                                                                                                                                                                                                                                                    height=380, \n\
                                                                                                                                                                                                                                                    scrollbars=no, \n\
                                                                                                                                                                                                                                                    resizable=no, \n\
                                                                                                                                                                                                                                                    dependant=yes')"/>
                    </td>
                    <?php
                    echo "<td>" . $adresse . " " . $cp . " " . $ville . "</td>";
                    echo "<td>" . $courriel . "</td>";
                    echo "<td>" . $tel . "</td>";
                    echo "<td>" . $portable . "</td>";
                }
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