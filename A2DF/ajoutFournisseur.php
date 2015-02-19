<?php
include ('html/head.php');

if ($_SESSION['user'] <> "direction") {
    header('Location: login.php');
}

date_default_timezone_set('UTC');
$today_int = date("Y-m-d");

//Initialisation du compteur d'erreurs pour le contrôle du formulaire
$erreurs = 0;

//Initialisation des valeurs de champs
$nom_ = "";
$adresse_ = "";
$cp_ = "";
$ville_ = "";
$tel_ = "";
$portable_ = "";
$courriel_ = "";
$login_ = "";
$mdp_ = "";
$interlocuteur_ = "";

//Initialisation des messages d'erreur
$nomErr = "";
$adresseErr = "";
$cpErr = "";
$villeErr = "";
$telErr = "";
$portableErr = "";
$courrielErr = "";
$numSecuErr = "";
$loginErr = "";
$mdpErr = "";
$interlocuteurErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Contrôle du champ nom
    $nom_temp = filter_input(INPUT_POST, "nom");
    controleNom($nom_temp, $nomErr, $nom_, $erreurs);

    $adresse_ = filter_input(INPUT_POST, "adresse");
    $cp_ = filter_input(INPUT_POST, "cp");
    $ville_ = filter_input(INPUT_POST, "ville");
    $courriel_ = filter_input(INPUT_POST, "courriel");
    $tel_ = filter_input(INPUT_POST, "tel");
    $portable_ = filter_input(INPUT_POST, "portable");
    $login_ = filter_input(INPUT_POST, "login");
    $mdp_ = filter_input(INPUT_POST, "mdp");
    $interlocuteur_ = filter_input(INPUT_POST, "interlocuteur");

    if ($erreurs === 0) {

        //Insertion des données dans la table "fournisseur"
        ajoutFournisseur($nom_, $adresse_, $cp_, $ville_, $courriel_, $tel_, $portable_, $login_, $mdp_, $interlocuteur_);

        //Redirection vers la liste des employés
        header('Location: listeFournisseur.php');
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
                <a  href="listeFournisseur.php"><img class="img_liste" onmouseout="this.src = 'img/arrow_undo.png'" onmouseover="this.src = 'img/arrow_undo1.png'" src="img/arrow_undo.png" /></a>
                <div class="ribbon-front"><div class="titre">Ajout d'un fournisseur</div></div>
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>
            </div>

            <form action='ajoutFournisseur.php' method='POST' name='formAjoutAppel'>

                <div class="boxHaut">
                    <fieldset>
                        <legend>Informations</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Nom :</td>
                                <td class="images"></td>
                                <td><input type='text' name='nom' value='<?php echo $nom_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Adresse :</td>
                                <td class="images"></td>
                                <td><input type='text' name='adresse' value='<?php echo $adresse_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Code postal :</td>
                                <td class="images"></td>
                                <td><input type='text' name='cp' value='<?php echo $cp_ ?>'></td>
                            </tr>    
                            <tr>
                                <td class="label">Ville :</td>
                                <td class="images"></td>
                                <td><input type='text' name='ville' value='<?php echo $ville_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Courriel :</td>
                                <td class="images"></td>
                                <td><input type='email' name='courriel' value='<?php echo $courriel_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Num. Fixe :</td>
                                <td class="images"></td>
                                <td><input type='tel' name='tel' value='<?php echo $tel_ ?>'pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/></td>
                            </tr>
                            <tr>
                                <td class="label">Num. Portable :</td>
                                <td class="images"></td>
                                <td><input type='tel' name='portable' value='<?php echo $portable_ ?>'pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/></td>
                            </tr>
                            <tr>
                                <td class="label">Interlocuteur :</td>
                                <td class="images"></td>
                                <td><input type='text' name='interlocuteur' value='<?php echo $interlocuteur_ ?>'></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boxBas">
                    <fieldset>
                        <legend>Identifiants</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Login :</td>
                                <td class="images"></td>
                                <td><input type='text' name='login' value='<?php echo $login_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Mot de passe :</td>
                                <td class="images"></td>
                                <td><input type='text' name='mdp' value='<?php echo $mdp_ ?>'></td>
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
            if ($nomErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $nomErr . "<br />";
            }
            ?>
        </div>
    </body>
</html>
