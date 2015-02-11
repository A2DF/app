<?php
include ('html/head.php');

if ($_SESSION['user'] <> "direction") {
    header('Location: login.php');
}

date_default_timezone_set('UTC');
$today_int = date("Y-m-d");

//Initialisation du compteur d'erreurs pour le contrôle du formulaire
$erreurs = 0;
$erreurExt = "";
$erreurPoids = "";

//Initialisation des valeurs de champs
$libelle_ = "";
$type_ = "";
$marque_ = "";
$prix_ = "";
$image_ = "";
$occasion_ = "";

//Initialisation des messages d'erreur
$libelleErr = "";
$typeErr = "";
$marqueErr = "";
$prixErr = "";
$imageErr = "";
$occasionErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $libelle_temp = filter_input(INPUT_POST, "libelle");
    controleLibelle($libelle_temp, $libelleErr, $libelle_, $erreurs);

    $type_ = filter_input(INPUT_POST, "type");
    $marque_ = filter_input(INPUT_POST, "marque");

    $prix_temp = filter_input(INPUT_POST, "prix");
    controlePrix($prix_temp, $prixErr, $prix_, $erreurs);

    $image_ = filter_input(INPUT_POST, "image");
    $occasion_ = filter_input(INPUT_POST, "occasion");

    $dossier = '../A2DF-Website/produits/';
    $fichier = basename($_FILES['image']['name']);
    $taille_maxi = 1000000;
    $taille = filesize($_FILES['image']['tmp_name']);
    $extensions = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG');
    $extension = strrchr($_FILES['image']['name'], '.');

    //Début des vérifications de sécurité...
    if (!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau
        $erreurExt = 'Vous devez uploader une image de type png, jpg ou jpeg';
        $erreurs++;
    }

    if ($taille > $taille_maxi) {
        $erreurPoids = 'Le fichier est trop gros';
        $erreurs++;
    }

    if ($erreurs === 0) {

        $fichier = iconv('UTF-8', 'ISO-8859-15', $fichier);
        $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        //Insertion de l'image dans le dossier "produits"
        move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier);

        //Insertion des données dans la table "produit"
        ajoutProduit($libelle_, $type_, $marque_, $prix_, $occasion_, $fichier);

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

            <form action='ajoutProduit.php' method='POST' name='formAjoutAppel' enctype="multipart/form-data">

                <div class="boxHaut">
                    <fieldset>
                        <legend>Informations</legend>
                        <table border="0">
                            <tr>
                                <td class="label">Type :</td>
                                <td class="images"></td>
                                <td>
                                    <select class="chosen-select" tabindex="2" name="type" value='<?php echo $type_ ?>'>
                                        <?php
                                        $comboboxType = comboboxType();
                                        foreach ($comboboxType as $type) {
                                            $idType = $type['idType'];
                                            $libelleType = $type['libelle'];
                                            if ($idType == $type_) {
                                                echo "<option value=" . $idType . " selected>" . $libelleType . "</option>";
                                            } else {
                                                echo "<option value=" . $idType . ">" . $libelleType . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Marque :</td>
                                <td class="images"></td>
                                <td>
                                    <select class="chosen-select" tabindex="2" name="marque" value='<?php echo $marque_ ?>'>
                                        <option selected value='443'>Inconnue</option>
                                        <?php
                                        $comboboxMarque = comboboxMarque();
                                        foreach ($comboboxMarque as $marque) {
                                            $idMarq = $marque['idMarque'];
                                            $libelleMarque = $marque['libelle'];
                                            if ($idMarq == $marque_) {
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
                                <td class="label">Libelle :</td>
                                <td class="images"></td>
                                <td><input type='text' name='libelle' value='<?php echo $libelle_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Prix :</td>
                                <td class="images"></td>
                                <td><input type='text' name='prix' value='<?php echo $prix_ ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Occasion :</td>
                                <td class="images"></td>
                                <td class="checkbox">
                                    <?php
                                    if ($occasion_ == 1) {
                                        echo "<input type='checkbox' name='occasion' value='1' checked/>";
                                    } else {
                                        echo "<input type='checkbox' name='occasion' value='1'/>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </div>

                <div class="boxBas">
                    <fieldset>
                        <legend>Image</legend>
                        <table>
                            <tr>
                                <td><input type="hidden" name="MAX_FILE_SIZE" value="1000000"><input type='file' name='image' value=''></td>
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
            if ($libelleErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $libelleErr . "<br />";
            }

            if ($prixErr <> "") {
                echo "<img src='img/exclamation.png'/>  " . $prixErr . "<br />";
            }

            if ($erreurExt <> "") {
                echo "<img src='img/exclamation.png'/>  " . $erreurExt . "<br />";
            }

            if ($erreurPoids <> "") {
                echo "<img src='img/exclamation.png'/>  " . $erreurPoids . "<br />";
            }
            ?>
        </div>
    </body>
</html>
