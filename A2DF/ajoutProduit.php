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

    $libelle = filter_input(INPUT_POST, "libelle");
    $type = filter_input(INPUT_POST, "type");
    $marque = filter_input(INPUT_POST, "marque");
    $prix = filter_input(INPUT_POST, "prix");
    $image = filter_input(INPUT_POST, "fileToUpload");
    $occasion = filter_input(INPUT_POST, "occasion");

    $target_dir = "produits/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

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

            <form action='ajoutProduit.php' method='POST' name='formAjoutAppel' enctype="multipart/form-data">

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
                                <td><input type='file' name='fileToUpload' id='fileToUpload' value='<?php echo $image ?>'></td>
                            </tr>
                            <tr>
                                <td class="label">Occasion :</td>
                                <td class="images"></td>
                                <td><input type='checkbox' name='occasion' value='1'/></td>
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
