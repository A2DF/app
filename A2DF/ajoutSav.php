
<?php
include ('html/head.php');

date_default_timezone_set('UTC');
$today_int = date("Y-m-d");

//Initialisation du compteur d'erreurs pour le contrôle du formulaire
$erreurs = 0;

//Initialisation des valeurs de champs
$date_ = "";
$client_ = "";
$typeProduit_ = "";
$marqueProduit_ = "";
$couleurProduit_ = "";
$mdpProduit_ = "";
$numSerie_ = "";
$probleme_ = "";



//Initialisation des messages d'erreur
$dateErr = "";
$clientErr = "";
$typeProduitErr = "";
$marqueProduitErr = "";
$couleurProduitErr = "";
$mdpProduitErr = "";
$numSerieErr = "";
$problemeErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Contrôle du champ date
    $date_temp = filter_input(INPUT_POST, "date");
    controleDate($date_temp, $dateErr, $date_, $erreurs);

    //Contrôle du champ client
    $client_temp = filter_input(INPUT_POST, "client");
    controleClient($client_temp, $clientErr, $client_, $erreurs);

    //Contrôle du champ priorite
    $probleme_temp = filter_input(INPUT_POST, "probleme");
    controlePriorite($probleme_temp, $problemeErr, $probleme_, $erreurs);

    $typeProduit_ = filter_input(INPUT_POST, "typeProduit");
    $marqueProduit_ = filter_input(INPUT_POST, "marqueProduit");
    $couleurProduit_ = filter_input(INPUT_POST, "couleurProduit");
    $mdpProduit_ = filter_input(INPUT_POST, "mdpProduit");
    $numSerie_ = filter_input(INPUT_POST, "numSerie");

    if ($erreurs === 0) {

        //Insertion des données dans la table "Appel"
        ajoutSav($date_, $client_, $typeProduit_, $marqueProduit_, $couleurProduit_, $mdpProduit_, $numSerie_, $probleme_);

        header('Location: listeSav.php');
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
                <a  href="listeSav.php"><img class="img_liste" onmouseout="this.src = 'img/arrow_undo.png'" onmouseover="this.src = 'img/arrow_undo1.png'" src="img/arrow_undo.png" /></a>
                <div class="ribbon-front"><div class="titre">Ajout d'un S.A.V.</div></div>
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>
            </div>

            <form action='ajoutSav.php' method='POST' name='formAjoutSav'>

                <div class="boxHaut">
                    <fieldset>
                        <legend>Informations</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Date d'entrée en SAV :</td>
                                <td class="images"></td>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    echo "<td><input type='text' name='date' id='datepicker' value='<?php echo $date_ ?>' readonly></td>";
                                } else {
                                    echo "<td><input type='text' name='date' id='datepicker' value='<?php echo $today_int ?>' readonly></td>";
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
                                            if (($idClie == $client_) || ($idClie == filter_input(INPUT_GET, 'id'))) {
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
                        <legend>Matériel</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Type :</td>
                                <td class="images">
                                <td>
                                    <select class="chosen-select" tabindex="2" name="typeProduit" value='<?php echo $typeProduit_ ?>'>
                                        <option selected value='10'></option>
                                        <?php
                                        $comboboxMateriel = comboboxMateriel();
                                        foreach ($comboboxMateriel as $materiel) {
                                            $idMate = $materiel['idMateriel'];
                                            $libelleMateriel = $materiel['libelle'];
                                            if ($idMate == $typeProduit_) {
                                                echo "<option value=" . $idMate . " selected>" . $libelleMateriel . "</option>";
                                            } else {
                                                echo "<option value=" . $idMate . ">" . $libelleMateriel . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Marque :</td>
                                <td class="images">
                                <td>
                                    <select class="chosen-select" tabindex="2" name="marqueProduit" value='<?php echo $marqueProduit_ ?>'>
                                        <option selected value='443'></option>
                                        <?php
                                        $comboboxMarque = comboboxMarque();
                                        foreach ($comboboxMarque as $marque) {
                                            $idMarq = $marque['idMarque'];
                                            $libelleMarque = $marque['libelle'];
                                            if ($idMarq == $marqueProduit_) {
                                                echo "<option value=" . $idMarq . " selected>" . $libelleMarque . "</option>";
                                            } else {
                                                echo "<option value=" . $idMarq . ">" . $libelleMarque . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Couleur :</td>
                                <td class="images"></td>
                                <td><input type='text' name='couleurProduit' value='<?php echo $couleurProduit_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Mot de passe :</td>
                                <td class="images"></td>
                                <td><input type='text' name='mdpProduit' value='<?php echo $mdpProduit_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Numéro de serie :</td>
                                <td class="images"></td>
                                <td><input type='text' name='numSerie' value='<?php echo $numSerie_ ?>'></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boxBas">
                    <fieldset>
                        <legend>Details</legend>
                        <table border="0">
                            <tr>
                                <td colspan="3"><textarea name="probleme" rows="5" placeholder="Problème"><?php echo $probleme_ ?></textarea></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boutons">
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
            if ($dateErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $dateErr . "<br />";
            }

            if ($clientErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $clientErr . "<br />";
            }

            if ($problemeErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $problemeErr . "<br />";
            }
            ?>
        </div>
    </body>
</html>