<html>
    <?php
    include ('html/head.php');

    if ($_SESSION['user'] != "direction") {
        header('Location: login.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $filterType = filter_input(INPUT_POST, 'type');
    } else {
        $filterType = "";
    }

    if (filter_input(INPUT_GET, 'online') == "yes") {
        setOnline();
        header('Location: listeProduit.php');
    }

    if (filter_input(INPUT_GET, 'online') == "no") {
        setOffline();
        header('Location: listeProduit.php');
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

                    <?php
                    $getStatut = getStatut();

                    foreach ($getStatut as $get) {
                        $statut = $get['online'];
                    }

                    if ($statut == 0) {
                        ?><a href="listeProduit.php?online=yes"><img src="img/offline.png" width="25" title="Catalogue hors-ligne" onclick="return(confirm('Voulez-vous mettre le catalogue en ligne ?'));"></a><?php
                    }

                    if ($statut == 1) {
                        ?><a href="listeProduit.php?online=no"><img src="img/online.png" width="25" title="Catalogue en ligne" onclick="return(confirm('Voulez-vous mettre le catalogue hors-ligne ?'));"></a><?php
                        }
                        ?>

                </form>
            </div>
            <?php
//Affichage de la première ligne du tableau
            echo "<table border='1' class='sortable'>";
            echo "<tr>";
            echo "<th id='print'>Type</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='tel'>Caractéristiques</th>";
            echo "<th id='prix'>Prix</th>";
            echo "<th id='tel'>Occasion</th>";
            echo "<th id='tel'>Image</th>";

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
                $info6 = $produit['info6'];
                $info7 = $produit['info7'];
                $info8 = $produit['info8'];

                if (($filterType == $typeid) || ($filterType == "")) {
                    //Affichage des données dans le tableau
                    echo "<tr>";
                    echo "<td><img src='img/type_" . $typeid . ".png'></td>";
                    ?>
                    <td class="info"><?php echo $marque . " " . $libelle . " " ?><img src="img/information.png" title="Informations" onclick="window.open('infoProduit.php?id=<?php echo $idProduit ?>', 'search', '\
                                                                                                                                                                                                                        left=500, \n\
                                                                                                                                                                                                                        top=150, \n\
                                                                                                                                                                                                                        width=430, \n\
                                                                                                                                                                                                                        height=600, \n\
                                                                                                                                                                                                                        scrollbars=no, \n\
                                                                                                                                                                                                                        resizable=no, \n\
                                                                                                                                                                                                                        dependant=yes')"/>
                    </td>
                    <?php
                    echo "<td>" . " 1." . $info1 . " | 2." . $info2 . " | 3." . $info3 . " | 4." . $info4 . " | 5." . $info5 . " | 6." . $info6 . " | 7." . $info7 . " | 8." . $info8 . " | " . "</td>";
                    echo "<td>" . $prix . "€</td>";

                    if ($etat == 1) {
                        echo "<td>Occasion</td>";
                    } else if ($etat == 2) {
                        echo "<td>Destockage</td>";
                    } else {
                        echo "<td></td>";
                    }

                    echo "<td><img src='produits/" . $image . "' height='47px' title='" . $image . "'></td>";
                    ?><td id='numero'><a href="listeProduit.php?id_=<?php echo $idProduit ?>">
                            <img src='img/cross.png' width='16' title='Supprimer le produit' onclick="return(confirm('Supprimer le produit?'));"/></a></td><?php
                    echo "</tr>";
                }
            }
            ?>
        </div>
        <?php
        $id_ = filter_input(INPUT_GET, 'id_');
        if (($_SERVER["REQUEST_METHOD"] == "GET") && ($id_ > 0)) {
            traiterProduit($id_);
            ?>
            <script language="javascript">window.self.location = "listeProduit.php";</script>    
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
        <script type="text/javascript">
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