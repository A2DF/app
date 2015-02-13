<html>
    <?php
    include ('html/head.php');

    if ($_SESSION['user'] <> "direction") {
        header('Location: login.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filterType = filter_input(INPUT_POST, 'type');
    } else {
        $filterType = "";
    }
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css'>
    <script src="lib/sorttable.js"></script>

    <body onload="haltTimer();
            refreshOnIdle();" onmousemove="haltTimer();">
        <div class="ribbon-wrapper">
            <a href="ajoutProduit.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png"/></a>
            <div class="ribbon-front"><div>Liste des produits</div></div>
            <div class="ribbon-edge-topleft"></div>
            <div class="ribbon-edge-topright"></div>
            <div class="ribbon-edge-bottomleft"></div>
            <div class="ribbon-edge-bottomright"></div>
            <div class="ribbon-back-left"></div>
            <div class="ribbon-back-right"></div>
        </div>
        <div class="tableaux">
            <div class="filtres">
                <form action='listeProduit.php' method='POST' name='formFiltreProduit'>
                    <select class="chosen-select" tabindex="2" name="type" onChange="javascript:submit();">
                        <option selected hidden value=''>Tous les produits</option>
                        <?php
                        $comboboxType = comboboxType();
                        foreach ($comboboxType as $type_) {
                            $idType = $type_['idType'];
                            $libelleType = $type_['libelle'];
                            if ($filterType == $idType) {
                                echo "<option value=" . $idType . " selected>" . $libelleType . "</option>";
                            } else {
                                echo "<option value=" . $idType . ">" . $libelleType . "</option>";
                            }
                        }
                        ?></select>
                </form>
            </div>
            <?php
            //Affichage de la première ligne du tableau
            echo "<table border='1' class='sortable'>";
            echo "<tr>";
            echo "<th id='print'>Type</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='prix'>Prix</th>";
            echo "<th id='tel'>Occasion</th>";
            echo "<th id='tel'>Image</th>";
            echo "<th id='tel'>Ligne 1</th>";
            echo "<th id='tel'>Ligne 2</th>";
            echo "<th id='tel'>Ligne 3</th>";
            echo "<th id='tel'>Ligne 4</th>";
            echo "<th id='tel'>Ligne 5</th>";
            echo "</tr>";

            $listeProduit = listeProduit();
            foreach ($listeProduit as $produit) {

                //Récupération des données dans la base
                $idProduit = $produit['idProduit'];
                $libelle = $produit['libelle'];
                $typeid = $produit['idType'];
                $type = $produit['type'];
                $marque = $produit['marque'];
                $prix = $produit['prix'];
                $etat = $produit['etat'];
                $image = $produit['image'];
                $info1 = $produit['info1'];
                $info2 = $produit['info2'];
                $info3 = $produit['info3'];
                $info4 = $produit['info4'];
                $info5 = $produit['info5'];

                if (($filterType == $typeid) || ($filterType == "")) {
                    //Affichage des données dans le tableau
                    echo "<tr>";
                    echo "<td><img src='img/type_" . $typeid . ".png'></td>";
                    echo "<td>" . $marque . " " . $libelle . "</td>";
                    echo "<td>" . $prix . "€</td>";

                    if ($etat == 1) {
                        echo "<td>Occasion</td>";
                    } else if ($etat == 2) {
                        echo "<td>Destockage</td>";
                    } else {
                        echo "<td></td>";
                    }

                    echo "<td><img src='../A2DF-Website/produits/" . $image . "' height='47px' title='" . $image . "'></td>";
                    echo "<td>" . $info1 . "</td>";
                    echo "<td>" . $info2 . "</td>";
                    echo "<td>" . $info3 . "</td>";
                    echo "<td>" . $info4 . "</td>";
                    echo "<td>" . $info5 . "</td>";
                    echo "</tr>";
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