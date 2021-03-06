
<?php
include ('html/head.php');

date_default_timezone_set('UTC');
$today_int = date("Y-m-d");

//Initialisation du compteur d'erreurs pour le contrôle du formulaire
$erreurs = 0;

//Initialisation des valeurs de champs
$date_ = "";
$client_ = "";
$personnel_ = "";
$motif_ = "";
$priorite_ = "";

//Initialisation des messages d'erreur
$dateErr = "";
$clientErr = "";
$personnelErr = "";
$motifErr = "";
$prioriteErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Contrôle du champ date
    $date_temp = filter_input(INPUT_POST, "date");
    controleDate($date_temp, $dateErr, $date_, $erreurs);

    //Contrôle du champ client
    $client_temp = filter_input(INPUT_POST, "client");
    controleClient($client_temp, $clientErr, $client_, $erreurs);

    //Contrôle du champ personnel
    $personnel_temp = filter_input(INPUT_POST, "personnel");
    controlePersonnel($personnel_temp, $personnelErr, $personnel_, $erreurs);

    //Contrôle du champ motif
    $motif_temp = filter_input(INPUT_POST, "motif");
    controleMotif($motif_temp, $motifErr, $motif_, $erreurs);

    //Contrôle du champ priorite
    $priorite_temp = filter_input(INPUT_POST, "priorite");
    controlePriorite($priorite_temp, $prioriteErr, $priorite_, $erreurs);

    if ($erreurs === 0) {

        //Insertion des données dans la table "Appel"
        ajoutAppel($date_, $client_, $personnel_, $motif_, $priorite_);

        //Redirection vers la liste des appels
        header('Location: listeAppel.php');
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
                <a  href="listeAppel.php"><img class="img_liste" onmouseout="this.src = 'img/arrow_undo.png'" onmouseover="this.src = 'img/arrow_undo1.png'" src="img/arrow_undo.png" /></a>
                <div class="ribbon-front"><div class="titre">Ajout d'un appel</div></div>
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>
            </div>

            <form action='ajoutAppel.php' method='POST' name='formAjoutAppel'>

                <div class="boxHaut">
                    <fieldset>
                        <legend>Informations</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Date de l'appel :</td>
                                <td class="images"></td>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    echo "<td><input type='text' name='date' id='datepicker' value='" . $date_ . "' readonly></td>";
                                } else {
                                    echo "<td><input type='text' name='date' id='datepicker' value='" . $today_int . "' readonly></td>";
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
                            <tr>
                                <td class="label">Personnel concerné :</td>
                                <td class="images"></td>
                                <td>
                                    <select name="personnel" class="chosen-select" value='<?php echo $personnel_ ?>'>
                                        <option selected disabled hidden value=''></option>
                                        <?php
                                        $comboboxPersonnel = comboboxPersonnel();
                                        foreach ($comboboxPersonnel as $personnel) {
                                            $idPers = $personnel['idPersonnel'];
                                            $prenom = $personnel['prenom'];
                                            if ($idPers == $personnel_) {
                                                echo "<option value=" . $idPers . " selected>" . $prenom . "</option>";
                                            } else {
                                                echo "<option value=" . $idPers . ">" . $prenom . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boxBas">
                    <fieldset>
                        <legend>Message</legend>
                        <table border="0">
                            <tr>
                                <td colspan="3"><textarea name="motif" rows="5" maxlength='300'><?php echo $motif_ ?></textarea></td>
                            </tr>
                            <tr>
                                <td class='label'>Priorité :</td>
                                <td class='images'></td>
                                <td>
                                    <select name="priorite" class="chosen-select" value='<?php echo $priorite_ ?>'>
                                        <option selected disabled hidden value=''></option>
                                        <?php
                                        $comboboxPriorite = comboboxPriorite();
                                        foreach ($comboboxPriorite as $priorite) {
                                            $idPrio = $priorite['idPriorite'];
                                            $libelle = $priorite['libelle'];
                                            if ($idPrio == $priorite_) {
                                                echo "<option value=" . $idPrio . " selected>" . $libelle . "</option>";
                                            } else {
                                                echo "<option value=" . $idPrio . ">" . $libelle . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boutons">
                    <input type='submit' value='Valider'>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
                <script src="lib/chosen.jquery.js" type="text/javascript"></script>
                <script src="js/ajoutClient.js" type="text/javascript"></script>
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

            if ($personnelErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $personnelErr . "<br />";
            }

            if ($motifErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $motifErr . "<br />";
            }

            if ($prioriteErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $prioriteErr . "<br />";
            }
            ?>
        </div>
    </body>
</html>
