<html>
    <?php
    include ('private/requetes.php');
    include ('private/fonctions.php');

    $idClient = filter_input(INPUT_GET, "id");

    //Initialisation du compteur d'erreurs pour le contrôle du formulaire
    $erreurs = 0;

    //Initialisation des messages d'erreur
    $nomErr = "";
    $prenomErr = "";
    $adresseErr = "";
    $cpErr = "";
    $villeErr = "";
    $courrielErr = "";
    $telErr = "";
    $portableErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Contrôle du champ nom
        $nom_temp = filter_input(INPUT_POST, "nom");
        controleNom($nom_temp, $nomErr, $nom, $erreurs);

        //Contrôle du champ prenom
        $prenom_temp = filter_input(INPUT_POST, "prenom");
        controlePrenom($prenom_temp, $prenom, $lower);

        $adresse = filter_input(INPUT_POST, "adresse");
        $cp = filter_input(INPUT_POST, "cp");
        $ville = filter_input(INPUT_POST, "ville");
        $courriel = filter_input(INPUT_POST, "courriel");

        //Contrôle du champ tel
        $tel_temp = filter_input(INPUT_POST, "tel");
        controleTel($tel_temp, $telErr, $tel, $erreurs);

        //Contrôle du champ portable
        $portable_temp = filter_input(INPUT_POST, "portable");
        controleTel($portable_temp, $portableErr, $portable, $erreurs);

        if (($telErr == "") && ($portableErr == "")) {
            $telErr = "";
        } else if (($telErr == "") || ($portableErr == "")) {
            $erreurs = $erreurs - 1;
            $telErr = "";
        }

        if ($erreurs === 0) {
            //Modification des données dans la table "Client"
            modificationClient($idClient, $nom, $prenom, $adresse, $cp, $ville, $courriel, $tel, $portable);
            ?>

            <script language="javascript">
                window.opener.location=window.opener.location+"";
                window.self.close();
            </script>

            <?php
        }
    } else {

        //Initialisation des valeurs de champs

        $unClient = unClient($idClient);
        foreach ($unClient as $client) {
            $nom = $client['nom'];

            if (isset($client['prenom'])) {
                $prenom = $client['prenom'];
            } else {
                $prenom = "";
            }

            if (isset($client['adresse'])) {
                $adresse = $client['adresse'];
            } else {
                $adresse = "";
            }

            if (isset($client['cp'])) {
                $cp = $client['cp'];
            } else {
                $cp = "";
            }

            if (isset($client['ville'])) {
                $ville = $client['ville'];
            } else {
                $ville = "";
            }

            if (isset($client['courriel'])) {
                $courriel = $client['courriel'];
            } else {
                $courriel = "";
            }

            if (isset($client['tel'])) {
                $tel = $client['tel'];
            } else {
                $tel = "";
            }

            if (isset($client['portable'])) {
                $portable = $client['portable'];
            } else {
                $portable = "";
            }
        }
    }
    ?>

    <body>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <form method="post" action="infoClient.php?id=<?php echo $idClient ?>" autocomplete="off">
            <fieldset>
                <legend>Coordonnées</legend>
                <p>
                    <label for="nom">Nom :</label>
                    <img src="img/tag_blue.png" width="16" height="16"/>
                    <input type="text" name="nom" value='<?php echo $nom ?>'/>
                    <br />
                    <label for="prenom">Prénom :</label>
                    <img src="img/tag_orange.png" width="16" height="16"/>
                    <input type="text" name="prenom" value='<?php echo $prenom ?>'/>
                    <br />
                    <label for="adresse">Adresse :</label>
                    <img src="img/direction.png" width="16" height="16"/>
                    <input type="text" name="adresse" value='<?php echo $adresse ?>'/>
                    <br />
                    <label for="cp">Code postal :</label>
                    <img src="img/counter.png" width="16" height="16"/>
                    <input type="text" name="cp" value='<?php echo $cp ?>'/>
                    <br />
                    <label for="cp">Ville :</label>
                    <img src="img/church.png" width="16" height="16"/>
                    <input type="text" name="ville" value='<?php echo $ville ?>'/>
                    <br />
                    <label for="cp">Courriel :</label>
                    <img src="img/contact_email.png" width="16" height="16"/>
                    <input type="email" name="courriel" value='<?php echo $courriel ?>'/>
                    <br />
                    <label for="cp">Téléphone fixe :</label>
                    <img src="img/telephone.png" width="16" height="16"/>
                    <input type="tel" name='tel' value='<?php echo $tel ?>' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" />
                    <br />
                    <label for="cp">Téléphone portable :</label>
                    <img src="img/phone.png" width="16" height="16"/>
                    <input type="tel" name="portable" value='<?php echo $portable ?>' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/>
            </fieldset>
            <br />
            <input type="submit" value="Enregistrer">
            <input type='reset' value='Réinitialiser'>
            <img id="exit" src='img/cross.png' title='Fermer la fenêtre' onclick="window.self.close();"/>
        </p>
    </form>
    <?php
    if ($nomErr <> "") {
        echo "<img src='img/exclamation.png'/>  " . $nomErr . "<br />";
    }

    if ($telErr <> "") {
        echo "<img src='img/exclamation.png'/>  " . $telErr . "<br />";
    }
    ?>
</body>
</html>
