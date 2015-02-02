<html>

    <?php
    include ('html/head.html');
    include ('private/requetes.php');

    date_default_timezone_set('UTC');
    $today_int = date("Y-m-d");
    $today_date = date_create($today_int);
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css'>
    <script src="lib/sorttable.js"></script>
    <script type="text/javascript" src="lib/nhpup_1.1.js"></script>
    <body>
        <div class="ribbon-wrapper">
            <a  href="ajoutVente.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" /></a>
            <div class="ribbon-front"><div>Liste des ventes</div></div>
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
            echo "<th id='dateVente'>Date de vente</th>";
            echo "<th id='dateLivraison'>Date livraison voulu</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='reference'>Reference</th>";
            echo "<th id='quantite'>Quantité</th>";
            echo "<th id='prix'>Prix TTC</th>";
            echo "<th id='acompte'>Acompte</th>";
            echo "<th id='idStatut'>Statut</th>";
            echo "<th id='traite'>Paiement éffectué</th>";
            echo "</tr>";

            $listeVente = listeVente();
            foreach ($listeVente as $vente) {

                //Récupération des données dans la base
                $idVente = $vente['idVente'];
                $dateVente = $vente['dateVente'];
                $dateLivraison = $vente['dateLivraison'];
                $idClient = $vente['idClient'];
                $nomClient = $vente['nomClient'];
                $prenomClient = $vente['prenomClient'];
                $typeProduit = $vente['typeProduit'];
                $marqueProduit = $vente['marqueProduit'];
                $couleurProduit = $vente['couleurProduit'];
                $quantite = $vente['quantite'];
                $prix = $vente['prix'];
                $acompte = $vente['acompte'];
                $idTraitement = $vente['idTraitement'];
                $traite = $vente['traite'];
                $dateConvert = date_create($dateVente);
                $dateFr = date_format($dateConvert, 'd/m/Y');
                $dateConverter = date_create($dateLivraison);
                $dateFrLiv = date_format($dateConverter, 'd/m/Y');

                if ($dateLivraison == 0000-00-00) {
                    $dateFrBon = "";
                }

                if ($idTraitement < 2) {


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
                    echo "<td>x" . $quantite . "</td>";
                    echo "<td>" . $prix . "€</td>";
                    echo "<td>" . $acompte . "€</td>";

                    if ($idTraitement == 0) {
                        ?><td><a href="listeVente.php?id=<?php echo $idVente ?>&etat=<?php echo $idTraitement ?>"><INPUT type="button" name="nom" value="Non commandée" onclick="return(confirm('La commande a été passée ?'));"/></a></td><?php
                    } else if ($idTraitement == 1) {
                        ?><td><a href="listeVente.php?id=<?php echo $idVente ?>&etat=<?php echo $idTraitement ?>"><INPUT type="button" name="nom" value="Passée" onclick="return(confirm('La commande a été livrée ?'));"/></a></td><?php
                            } else if ($idTraitement == 2) {
                                ?><td>Livrée</td><?php
                            }
                            ?>
                            <?php
                            if ($traite == 0) {
                                ?><td><a href="listeVente.php?id_=<?php echo $idVente ?>">
                                <img src='img/coins_in_hand.png' title='Valider le paiement' onclick="return(confirm('La vente a t-elle été réglée ?'));"/></a></td><?php
                    echo "</tr>";
                } else if ($traite == 1) {
                                ?><td><img src='img/tick_circle_frame.png' title='Paiement effectué'/></a></td><?php
                                echo "</tr>";
                            }
                        }
                    }

                    echo "</table>";
                    ?>
        </div>

        <?php
        $id_ = filter_input(INPUT_GET, 'id_');
        if (($_SERVER["REQUEST_METHOD"] == "GET") && ($id_ > 0)) {
            payerVente($id_);
            ?>
            <script language="javascript">window.self.location = "listeVente.php";</script>    
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