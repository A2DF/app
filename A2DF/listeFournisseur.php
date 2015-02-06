<html>
    <?php
    include ('html/head.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filterFournisseur = filter_input(INPUT_POST, 'fournisseur');
    } else {
        $filterFournisseur = "";
    }
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css'>
    <script src="lib/sorttable.js"></script>

    <body onload="haltTimer();
            refreshOnIdle();" onmousemove="haltTimer();">
        <div class="ribbon-wrapper">
            <a href="ajoutFournisseur.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png"/></a>
            <div class="ribbon-front"><div>Liste des fournisseurs</div></div>
            <div class="ribbon-edge-topleft"></div>
            <div class="ribbon-edge-topright"></div>
            <div class="ribbon-edge-bottomleft"></div>
            <div class="ribbon-edge-bottomright"></div>
            <div class="ribbon-back-left"></div>
            <div class="ribbon-back-right"></div>
        </div>
        <div class="tableaux">
            <div class="filtres">
                <form action='listeFournisseur.php' method='POST' name='formFiltreFournisseur'>
                    <select class="chosen-select" tabindex="2" name="fournisseur" onChange="javascript:submit();">
                        <option selected hidden value=''>Tous les fournisseurs</option>
                        <?php
                        $comboboxFournisseur = comboboxFournisseur();
                        foreach ($comboboxFournisseur as $fournisseur) {
                            $filterId = $fournisseur['idFournisseur'];
                            $filterNom = $fournisseur['nom'];
                            $filterPrenom = $fournisseur['prenom'];
                            if ($filterFournisseur == $filterId) {
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
            echo "<th id='fournisseur'>Fournisseur</th>";
            echo "<th id='commentaire'>Adresse</th>";
            echo "<th id='tel'>Courriel</th>";
            echo "<th id='tel'>Fixe</th>";
            echo "<th id='tel'>Portable</th>";
            echo "<th id='tel'>Login</th>";
            echo "<th id='tel'>Mot de passe</th>";
            echo "</tr>";

            $listeFournisseur = listeFournisseur();
            foreach ($listeFournisseur as $fournisseur) {

                //Récupération des données dans la base
                $idFournisseur = $fournisseur['idFournisseur'];
                $nom = $fournisseur['nom'];
                $adresse = $fournisseur['adresse'];
                $cp = $fournisseur['cp'];
                $ville = $fournisseur['ville'];
                $courriel = $fournisseur['courriel'];
                $tel = $fournisseur['tel'];
                $portable = $fournisseur['portable'];
                $login = $fournisseur['login'];
                $mdp = $fournisseur['mdp'];

                if (($filterFournisseur == $idFournisseur) || ($filterFournisseur == "")) {
                    //Affichage des données dans le tableau
                    echo "<tr>";
                    ?>
                    <td class="info" ><?php echo $nom . " " ?><img src="img/information.png" title="Informations" onclick="window.open('infoFournisseur.php?id=<?php echo $idFournisseur ?>', 'search', '\
                                                                                                                                                                                                                                                    left=500, \n\
                                                                                                                                                                                                                                                    top=150, \n\
                                                                                                                                                                                                                                                    width=450, \n\
                                                                                                                                                                                                                                                    height=410, \n\
                                                                                                                                                                                                                                                    scrollbars=no, \n\
                                                                                                                                                                                                                                                    resizable=no, \n\
                                                                                                                                                                                                                                                    dependant=yes')"/>
                    </td>
                    <?php
                    echo "<td>" . $adresse . " " . $cp . " " . $ville . "</td>";
                    echo "<td>" . $courriel . "</td>";
                    echo "<td>" . wordwrap($tel, 2, " ", 1) . "</td>";
                    echo "<td>" . wordwrap($portable, 2, " ", 1) . "</td>";
                    echo "<td>" . $login . "</td>";
                    echo "<td>" . $mdp . "</td>";
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