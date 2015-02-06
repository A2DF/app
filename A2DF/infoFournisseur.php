<html>
    <?php
    include ('private/fonctions.php');
    date_default_timezone_set('UTC');

    $idFournisseur = filter_input(INPUT_GET, "id");

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

//Initialisation des messages d'erreur

    $nomErr = "";
    $adresseErr = "";
    $cpErr = "";
    $villeErr = "";
    $telErr = "";
    $portableErr = "";
    $courrielErr = "";
    $loginErr = "";
    $mdpErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nom_ = filter_input(INPUT_POST, "nom");
        $adresse_ = filter_input(INPUT_POST, "adresse");
        $cp_ = filter_input(INPUT_POST, "cp");
        $ville_ = filter_input(INPUT_POST, "ville");
        $courriel_ = filter_input(INPUT_POST, "courriel");
        $tel_ = filter_input(INPUT_POST, "tel");
        $portable_ = filter_input(INPUT_POST, "portable");
        $login_ = filter_input(INPUT_POST, "login");
        $mdp_ = filter_input(INPUT_POST, "mdp");

        if ($erreurs === 0) {
            //Modification des données dans la table "Client"
            modificationFournisseur($idFournisseur, $nom_, $adresse_, $cp_, $ville_, $courriel_, $tel_, $portable_, $login_, $mdp_);
            ?>

            <script language="javascript">
                window.opener.location = window.opener.location + "";
                window.self.close();
            </script>

            <?php
        }
    } else {

        //Initialisation des valeurs de champs

        $unFournisseur = unFournisseur($idFournisseur);
        foreach ($unFournisseur as $fournisseur) {

            if (isset($fournisseur['nom'])) {
                $nom_ = $fournisseur['nom'];
            } else {
                $nom_ = "";
            }

            if (isset($fournisseur['adresse'])) {
                $adresse_ = ($fournisseur['adresse']);
            } else {
                $adresse_ = "";
            }

            if (isset($fournisseur['cp'])) {
                $cp_ = $fournisseur['cp'];
            } else {
                $cp_ = "";
            }

            if (isset($fournisseur['ville'])) {
                $ville_ = $fournisseur['ville'];
            } else {
                $ville_ = "";
            }

            if (isset($fournisseur['courriel'])) {
                $courriel_ = $fournisseur['courriel'];
            } else {
                $courriel_ = "";
            }

            if (isset($fournisseur['tel'])) {
                $tel_ = $fournisseur['tel'];
            } else {
                $tel_ = "";
            }

            if (isset($fournisseur['portable'])) {
                $portable_ = $fournisseur['portable'];
            } else {
                $portable_ = "";
            }

            if (isset($fournisseur['login'])) {
                $login_ = $fournisseur['login'];
            } else {
                $login_ = "";
            }

            if (isset($fournisseur['mdp'])) {
                $mdp_ = $fournisseur['mdp'];
            } else {
                $mdp_ = "";
            }
        }
    }
    ?>

    <body>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/pikaday.css" />
        <form method="post" action="infoFournisseur.php?id=<?php echo $idFournisseur ?>" autocomplete="off">
            <fieldset>
                <legend>Coordonnées</legend>
                <label for="nom">Nom :</label>
                <img src="img/tag_blue.png" width="16" height="16"/>
                <input type="text" name="nom" value='<?php echo $nom_ ?>'/>
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
                <legend>Identifiants</legend>
                <label>Login :</label>
                <img src="img/user.png" width="16" height="16"/>
                <input type='text' name='login' value='<?php echo $login_ ?>'>
                <br />
                <label>Mot de passe :</label>
                <img src="img/lock.png" width="16" height="16"/>
                <input type='text' name='mdp' value='<?php echo $mdp_ ?>'>
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
</body>
</html>
