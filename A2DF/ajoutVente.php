
<?php
include ('html/head.html');
include ('private/requetes.php');
include ('private/fonctions.php');

date_default_timezone_set('UTC');
$today_int = date("Y-m-d");

//Initialisation du compteur d'erreurs pour le contrôle du formulaire
$erreurs = 0;

//Initialisation des valeurs de champs
$dateVente_ = "";
$dateLivraison_ = "";
$client_ = "";
$typeProduit_ = "";
$marqueProduit_ = "";
$couleurProduit_ = "";
$reference_ = "";
$quantite_ = "";
$prix_ = "";
$acompte_ = "";
$idTraitement_ = "";
$traite_ = "";

//Initialisation des messages d'erreur
$dateVenteErr = "";
$dateLivraisonErr = "";
$clientErr = "";
$typeProduitErr = "";
$marqueProduitErr = "";
$couleurProduitErr = "";
$referenceErr = "";
$quantiteErr = "";
$prixErr = "";
$acompteErr_ = "";
$idTraitementErr_ = "";
$traiteErr_ = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Contrôle du champ date
    //$date_temp = filter_input(INPUT_POST, "dateCommande");
    //controleDate($date_temp, $dateCommandeErr, $dateCommande_, $erreurs);
    //Contrôle du champ date
    $date_temp = filter_input(INPUT_POST, "dateVente");
    controleDate($date_temp, $dateVenteErr, $dateVente_, $erreurs);

    //Contrôle du champ client
    $client_temp = filter_input(INPUT_POST, "client");
    controleClient($client_temp, $clientErr, $client_, $erreurs);

    $prix_temp = filter_input(INPUT_POST, "prix");
    controlePrix($prix_temp, $prixErr, $prix_, $erreurs);
    //Contrôle du champ quantite
    $quantite_temp = filter_input(INPUT_POST, "quantite");
    controleQuantite($quantite_temp, $quantiteErr, $quantite_, $erreurs);

    $typeProduit_ = filter_input(INPUT_POST, "typeProduit");
    $marqueProduit_ = filter_input(INPUT_POST, "marqueProduit");
    $couleurProduit_ = filter_input(INPUT_POST, "couleurProduit");
    $quantite_ = filter_input(INPUT_POST, "quantite");
    $acompte_ = filter_input(INPUT_POST, "acompte");
    $reference_ = filter_input(INPUT_POST, "reference");
    $dateLivraison_ = filter_input(INPUT_POST, "dateLivraison");

    if ($erreurs === 0) {

        //Insertion des données dans la table "Vente"
        ajoutVente($dateVente_, $dateLivraison_, $client_, $typeProduit_, $marqueProduit_, $couleurProduit_, $reference, $quantite_, $prix_, $acompte_);

        //Redirection vers la liste des ventes
        header('Location: listeVente.php');
    }
}
?>

<html>
    <link href="css/formulaires.css" rel="stylesheet" type="text/css">
    <link href="css/chosen.css" rel="stylesheet" type='text/css' >
    <link href="css/pikaday.css" rel="stylesheet" type="text/css">
    <body>
        <div class="contenu">
            <div class="ribbon-wrapper">
                <a  href="listeVente.php"><img class="img_liste" onmouseout="this.src = 'img/arrow_undo.png'" onmouseover="this.src = 'img/arrow_undo1.png'" src="img/arrow_undo.png" /></a>
                <div class="ribbon-front"><div class="titre">Ajout d'une vente</div></div>
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>
            </div>

            <form action='ajoutVente.php' method='POST' name='formAjoutVente'>

                <div class="boxHaut">
                    <fieldset>
                        <legend>Informations</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Date de la vente :</td>
                                <td class="images"></td>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    echo "<td><input type='text' name='dateVente' id='datepicker' value='" . $dateVente_ . "' readonly></td>";
                                } else {
                                    echo "<td><input type='text' name='dateVente' id='datepicker' value='" . $today_int . "' readonly></td>";
                                }
                                ?>
                            </tr>

                            <tr>
                                <td class="label">Date livraison souhaitée :</td>
                                <td class="images"></td>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    echo "<td><input type='text' name='dateLivraison' id='datepicker' value='" . $dateLivraison_ . "' readonly></td>";
                                } else {
                                    echo "<td><input type='text' name='dateLivraison' id='datepicker' value='" . $today_int . "' readonly></td>";
                                }
                                ?>
                            </tr>

                            <tr>
                                <td class="label">Client :</td>
                                <td class="images"><img src='img/user_add_1.png' title='Ajouter un client' onclick="window.open('ajoutClient.php', 'search', '\
                                                                                                                                left=500, \n\
                                                                                                                                top=150, \n\
                                                                                                                                width=450, \n\
                                                                                                                                height=380, \n\
                                                                                                                                scrollbars=no, \n\
                                                                                                                                resizable=no, \n\
                                                                                                                                dependant=yes')">
                                </td>
                                <td>
                                    <select class="chosen-select" tabindex="2" name="client" value='<?php echo $client_ ?>'>
                                        <option selected disabled hidden value=''></option>
<?php
$comboboxClient = comboboxClient();
foreach ($comboboxClient as $client) {
    $idClie = $client['idClient'];
    $nom = $client['nom'];
    $prenom = $client['prenom'];
    if (($idClie == $client_) || ($nom == filter_input(INPUT_GET, 'id'))) {
        echo "<option value=" . $idClie . " selected>" . $nom . " " . $prenom . "</option>";
    } else {
        echo "<option value=" . $idClie . ">" . $nom . " " . $prenom . "</option>";
    }
}
?>
                                    </select>
                                </td>

                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boxMilieu">
                    <fieldset>
                        <legend>Produit</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Type :</td>
                                <td class="images"></td>
                                <td><input type='text' name='typeProduit' value='<?php echo $typeProduit_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Marque :</td>
                                <td class="images"></td>
                                <td><input type='text' name='marqueProduit' value='<?php echo $marqueProduit_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Couleur :</td>
                                <td class="images"></td>
                                <td><input type='text' name='couleurProduit' value='<?php echo $couleurProduit_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Référence :</td>
                                <td class="images"></td>
                                <td><input type='text' name='reference' value='<?php echo $reference_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Quantité :</td>
                                <td class="images"></td>
                                <td><input type='number' name='quantite' value='<?php echo $quantite_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Prix TTC :</td>
                                <td class="images"></td>
                                <td><input type='text' name='prix' value='<?php echo $prix_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Acompte :</td>
                                <td class="images"></td>
                                <td><input type='text' name='acompte' value='<?php echo $acompte_ ?>'></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>


                <div class="boutons">
                    <input type='reset' value='Effacer'>
                    <input type='submit' value='Valider'>
                </div>
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
                <script type="text/javascript" src="lib/moment.js"></script>
                <script type="text/javascript" src="lib/pikaday.js"></script>
                <script>
                                    var pickerDebut = new Pikaday(
                                            {
                                                field: document.getElementById('datepicker'),
                                                firstDay: 1,
                                                minDate: new Date('2000-01-01'),
                                                maxDate: new Date('2020-12-31'),
                                                yearRange: [2000, 2020],
                                                //format: 'DD/MM/YYYY'
                                            });
                </script>
            </form>
<?php
if ($dateVenteErr <> "") {
    echo "<img src='img/exclamation.png'/>  " . $dateVenteErr . "<br />";
}

if ($clientErr <> "") {
    echo "<img src='img/exclamation.png'/>  " . $clientErr . "<br />";
}

if ($quantiteErr <> "") {
    echo "<img src='img/exclamation.png'/>  " . $quantiteErr . "<br />";
}
if ($prixErr <> "") {
    echo "<img src='img/exclamation.png'/>  " . $prixErr . "<br />";
}
?>
        </div>
    </body>
</html>

