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
$libelle = "";
$type = "";
$marque = "";
$prix = "";
$image = "";
$occasion = "";

//Initialisation des messages d'erreur
$libelleErr = "";
$typeErr = "";
$marqueErr = "";
$prixErr = "";
$imageErr = "";
$occasionErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $libelle = filter_input(INPUT_POST, "nom");
    $type = filter_input(INPUT_POST, "nom");
    $marque = filter_input(INPUT_POST, "nom");
    $prix = filter_input(INPUT_POST, "nom");
    $image = filter_input(INPUT_POST, "nom");
    $occasion = filter_input(INPUT_POST, "nom");

    if ($erreurs === 0) {

        //Insertion des données dans la table "produit"
        ajoutProduit($libelle, $type, $marque, $prix, $occasion, $image);

        //Redirection vers la liste des employés
        header('Location: listeProduit.php');
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
                <a  href="listeProduit.php"><img class="img_liste" onmouseout="this.src = 'img/arrow_undo.png'" onmouseover="this.src = 'img/arrow_undo1.png'" src="img/arrow_undo.png" /></a>
                <div class="ribbon-front"><div class="titre">Ajout d'un produit</div></div>
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>
            </div>

            <form action='ajoutProduit.php' method='POST' name='formAjoutAppel'>

                <div class="boxHaut">
                    <fieldset>
                        <legend>Informations</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Libelle :</td>
                                <td class="images"></td>
                                <td><input type='text' name='libelle' value='<?php echo $libelle ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Type :</td>
                                <td class="images"></td>
                                <td><input type='text' name='type' value='<?php echo $type ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Marque :</td>
                                <td class="images"></td>
                                <td><input type='text' name='marque' value='<?php echo $marque ?>'></td>
                            </tr>    
                            <tr>
                                <td class="label">Prix :</td>
                                <td class="images"></td>
                                <td><input type='text' name='prix' value='<?php echo $prix ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Image :</td>
                                <td class="images"></td>
                                <td><input type='text' name='image' value='<?php echo $image ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Occasion :</td>
                                <td class="images"></td>
                                <td><input type='text' name='occasion' value='<?php echo $occasion ?>'/></td>
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
        </div>
    </body>
</html>
