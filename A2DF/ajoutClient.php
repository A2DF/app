<html>
    <?php
    include ('private/requetes.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nom = filter_input(INPUT_POST, "nom");
        $prenom = filter_input(INPUT_POST, "prenom");
        $adresse = filter_input(INPUT_POST, "adresse");
        $cp = filter_input(INPUT_POST, "cp");
        $ville = filter_input(INPUT_POST, "ville");
        $courriel = filter_input(INPUT_POST, "courriel");
        $tel = filter_input(INPUT_POST, "tel");
        $portable = filter_input(INPUT_POST, "portable");

        //Insertion des données dans la table "Client"
        ajoutClient($nom, $prenom, $adresse, $cp, $ville, $courriel, $tel, $portable);
        ?>

        <script language="javascript">
            var nom = <?php $nom ?>
            window.opener.location = "ajoutAppel.php";
            parent.opener.document.formAjoutAppel.client.selected = nom;
            window.self.close();
        </script>

        <?php
    }
    ?>

    <body onclick='fermer()'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <form method="post" action="ajoutClient.php" autocomplete="off">
            <fieldset>
                <legend>Coordonnées</legend>
                <p>
                    <label for="nom">Nom :</label>
                    <img src="img/tag_blue.png" width="16" height="16"/>
                    <input type="text" name="nom"/>
                    <br />
                    <label for="prenom">Prénom :</label>
                    <img src="img/tag_orange.png" width="16" height="16"/>
                    <input type="text" name="prenom"/>
                    <br />
                    <label for="adresse">Adresse :</label>
                    <img src="img/direction.png" width="16" height="16"/>
                    <input type="text" name="adresse"/>
                    <br />
                    <label for="cp">Code postal :</label>
                    <img src="img/counter.png" width="16" height="16"/>
                    <input type="text" name="cp"/>
                    <br />
                    <label for="cp">Ville :</label>
                    <img src="img/church.png" width="16" height="16"/>
                    <input type="text" name="ville"/>
                    <br />
                    <label for="cp">Courriel :</label>
                    <img src="img/contact_email.png" width="16" height="16"/>
                    <input type="email" name="courriel"/>
                    <br />
                    <label for="cp">Téléphone fixe :</label>
                    <img src="img/telephone.png" width="16" height="16"/>
                    <input type="tel" name='tel' pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/>
                    <br />
                    <label for="cp">Téléphone portable :</label>
                    <img src="img/phone.png" width="16" height="16"/>
                    <input type="tel" name="portable" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/>
            </fieldset>
            <br />
            <input type="submit" name="envoi" value="Envoyer">
            <input type='reset' value='Annuler'>
            <img id="exit" src='img/cross.png' title='Fermer la fenêtre' onclick="window.self.close();"/>
            </p>
        </form>
    </body>
</html>
