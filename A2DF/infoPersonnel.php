<html>
    <?php
    include ('private/fonctions.php');
    date_default_timezone_set('UTC');

    $idPersonnel = filter_input(INPUT_GET, "id");

    //Initialisation du compteur d'erreurs pour le contrôle du formulaire
    $erreurs = 0;

    //Initialisation des valeurs de champs
    $dateEmbauche_ = "";
    $nom_ = "";
    $prenom_ = "";
    $adresse_ = "";
    $cp_ = "";
    $ville_ = "";
    $tel_ = "";
    $portable_ = "";
    $courriel_ = "";
    $numSecu_ = "";
    $contrat_ = "";
    $salaire_ = "";

//Initialisation des messages d'erreur
    $dateEmbaucheErr = "";
    $nomErr = "";
    $prenomErr = "";
    $adresseErr = "";
    $cpErr = "";
    $villeErr = "";
    $telErr = "";
    $portableErr = "";
    $courrielErr = "";
    $numSecuErr = "";
    $contratErr = "";
    $salaireErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Contrôle du champ date
        $dateEmbauche_temp = filter_input(INPUT_POST, "dateEmbauche");
        controleDate($dateEmbauche_temp, $dateEmbaucheErr, $dateEmbauche_, $erreurs);

        $nom_ = filter_input(INPUT_POST, "nom");

        //Contrôle du champ client
        $prenom_temp = filter_input(INPUT_POST, "prenom");
        controlePre($prenom_temp, $prenomErr, $prenom_, $erreurs);

        $adresse_ = filter_input(INPUT_POST, "adresse");
        $cp_ = filter_input(INPUT_POST, "cp");
        $ville_ = filter_input(INPUT_POST, "ville");
        $courriel_ = filter_input(INPUT_POST, "courriel");
        $tel_ = filter_input(INPUT_POST, "tel");
        $portable_ = filter_input(INPUT_POST, "portable");
        $numSecu_ = filter_input(INPUT_POST, "numSecu");
        $salaire_ = filter_input(INPUT_POST, "salaire");
        $contrat_ = filter_input(INPUT_POST, "contrat");


        if ($erreurs === 0) {
            //Modification des données dans la table "Client"
            modificationPersonnel($idPersonnel, $dateEmbauche_, $nom_, $prenom_, $adresse_, $cp_, $ville_, $courriel_, $tel_, $portable_, $numSecu_, $contrat_, $salaire_);
            ?>

            <script language="javascript">
                window.opener.location = window.opener.location + "";
                window.self.close();
            </script>

            <?php
        }
    } else {

        //Initialisation des valeurs de champs

        $unPersonnel = unPersonnel($idPersonnel);
        foreach ($unPersonnel as $personnel) {
            $prenom_ = $personnel['prenom'];

            if (isset($personnel['nom'])) {
                $nom_ = $personnel['nom'];
            } else {
                $nom_ = "";
            }

            if (isset($personnel['adresse'])) {
                $adresse_ = ($personnel['adresse']);
            } else {
                $adresse_ = "";
            }

            if (isset($personnel['cp'])) {
                $cp_ = $personnel['cp'];
            } else {
                $cp_ = "";
            }

            if (isset($personnel['ville'])) {
                $ville_ = $personnel['ville'];
            } else {
                $ville_ = "";
            }

            if (isset($personnel['courriel'])) {
                $courriel_ = $personnel['courriel'];
            } else {
                $courriel_ = "";
            }

            if (isset($personnel['tel'])) {
                $tel_ = $personnel['tel'];
            } else {
                $tel_ = "";
            }

            if (isset($personnel['portable'])) {
                $portable_ = $personnel['portable'];
            } else {
                $portable_ = "";
            }

            if (isset($personnel['dateEmbauche'])) {
                $dateEmbauche_ = $personnel['dateEmbauche'];
            } else {
                $dateEmbauche_ = "";
            }

            if (isset($personnel['numSecu'])) {
                $numSecu_ = $personnel['numSecu'];
            } else {
                $numSecu_ = "";
            }

            if (isset($personnel['contrat'])) {
                $contrat_ = $personnel['contrat'];
            } else {
                $contrat_ = "";
            }

            if (isset($personnel['salaire'])) {
                $salaire_ = $personnel['salaire'];
            } else {
                $salaire_ = "";
            }
        }
    }
    ?>

    <body>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/pikaday.css" />
        <form method="post" action="infoPersonnel.php?id=<?php echo $idPersonnel ?>" autocomplete="off">
            <fieldset>
                <legend>Coordonnées</legend>
                <label for="nom">Nom :</label>
                <img src="img/tag_blue.png" width="16" height="16"/>
                <input type="text" name="nom" value='<?php echo $nom_ ?>'/>
                <br />
                <label for="prenom">Prénom :</label>
                <img src="img/tag_orange.png" width="16" height="16"/>
                <input type="text" name="prenom" value='<?php echo $prenom_ ?>'/>
                <br />
                <label for="adresse">Adresse :</label>
                <img src="img/direction.png" width="16" height="16"/>
                <input type="text" name="adresse" value='<?php echo $adresse_ ?>'/>
                <br />
                <label for="cp">Code postal :</label>
                <img src="img/counter.png" width="16" height="16"/>
                <input type="text" name="cp" value='<?php echo $cp_ ?>'/>
                <br />
                <label for="cp">Ville :</label>
                <img src="img/church.png" width="16" height="16"/>
                <input type="text" name="ville" value='<?php echo $ville_ ?>'/>
                <br />
                <label for="cp">Courriel :</label>
                <img src="img/contact_email.png" width="16" height="16"/>
                <input type="email" name="courriel" value='<?php echo $courriel_ ?>'/>
                <br />
                <label for="cp">Téléphone fixe :</label>
                <img src="img/telephone.png" width="16" height="16"/>
                <input type="tel" name='tel' value='<?php echo $tel_ ?>' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" />
                <br />
                <label for="cp">Téléphone portable :</label>
                <img src="img/phone.png" width="16" height="16"/>
                <input type="tel" name="portable" value='<?php echo $portable_ ?>' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/>
            </fieldset>
            <br />
            <fieldset>
                <legend>Entreprise</legend>
                <label>Date d'embauche :</label>
                <img src="img/date.png" width="16" height="16"/>
                <input type='text' name='dateEmbauche' id='datepicker' value='<?php echo $dateEmbauche_ ?>' readonly>
                <br />
                <label>Numéro de sécu :</label>
                <img src="img/health.png" width="16" height="16"/>
                <input type='text' name='numSecu' value='<?php echo $numSecu_ ?>'>
                <br />
                <label>Type contrat :</label>
                <img src="img/note.png" width="16" height="16"/>
                <input type='text' name='contrat' value='<?php echo $contrat_ ?>'>
                <br />
                <label>Salaire mensuel brut :</label>
                <img src="img/euro.png" width="16" height="16"/>
                <input type='text' name='salaire' value='<?php echo $salaire_ ?>'>

            </fieldset>
            <br />
            <input type="submit" value="Enregistrer">
            <input type='reset' value='Réinitialiser'>
            <img id="exit" src='img/cross.png' title='Fermer la fenêtre' onclick="window.self.close();"/>
        </p>
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
    if ($prenomErr <> "") {
        echo "<img src='img/exclamation.png'/>  " . $prenomErr . "<br />";
    }

    if ($dateEmbaucheErr <> "") {
        echo "<img src='img/exclamation.png'/>  " . $dateEmbaucheErr . "<br />";
    }
    ?>
</body>
</html>
