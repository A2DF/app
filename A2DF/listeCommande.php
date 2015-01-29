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
            <a  href="ajoutCommande.php"><img class="img_liste" onmouseout="this.src = 'img/add1.png'" onmouseover="this.src = 'img/add2.png'" src="img/add1.png" /></a>
            <div class="ribbon-front"><div>Liste des commandes</div></div>
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
            echo "<th id='dateCommande'>Date commande</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='produit'>Produit</th>";
            echo "<th id='quantite'>Quantité</th>";
            echo "<th id='prix'>Prix TTC</th>";
            echo "<th id='acompte'>Acompte</th>";
            echo "<th id='traite'>Statut</th>";
            echo "<th id='traitement'>Paiement éffectué</th>";
            echo "</tr>";

            $listeCommande = listeCommande();
            foreach ($listeCommande as $commande) {

                //Récupération des données dans la base
                $idCommande = $commande['idCommande'];
                $dateCommande = $commande['dateCommande'];
                $dateBonCommande = $commande['dateBonCommande'];
                $idClient = $commande['idClient'];
                $nomClient = $commande['nomClient'];
                $prenomClient = $commande['prenomClient'];
                $typeProduit = $commande['typeProduit'];
                $marqueProduit = $commande['marqueProduit'];
                $couleurProduit = $commande['couleurProduit'];
                $quantite = $commande['quantite'];
                $prix = $commande['prix'];
                $acompte = $commande['acompte'];
                $idTraitement = $commande['idTraitement'];
                $traite = $commande['traite'];
                $dateConvert = date_create($dateCommande);
                $dateFr = date_format($dateConvert, 'd/m/Y');

                if ($traite == 0) {


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
                    echo "<td>x" . $quantite . "</td>";
                    echo "<td>" . $prix . "€</td>";
                    echo "<td>" . $acompte . "€</td>";
                    
                    if ($idTraitement == 0) {
                        ?><td><a href="listeCommande.php?id=<?php echo $idCommande ?>&etat=<?php echo $idTraitement ?>"><INPUT type="button" name="nom" value="Non commandée" onclick="return(confirm('La commande a été passée ?'));"/></a></td><?php
                    } else if ($idTraitement == 1) {
                        ?><td><a href="listeCommande.php?id=<?php echo $idCommande ?>&etat=<?php echo $idTraitement ?>"><INPUT type="button" name="nom" value="Passée" onclick="return(confirm('La commande a été livrée ?'));"/></a></td><?php
                            } else if ($idTraitement == 2) {
                                ?><td>Livrée</td><?php
                            }
                            ?>
                            <?php
                            echo "</td>";
                            
                            ?><td><a href="listeCommande.php?id=<?php echo $idCommande ?>">
                                <img src='img/tick_light_blue.png' title='Paiement effectué' onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette commande ?'));"/></a></td><?php
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
            traiterCommande($id, $etat);
            ?>
            <script language="javascript">window.self.location = "listeCommande.php";</script>    
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