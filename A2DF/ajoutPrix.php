<html>
    <?php
    include ('private/fonctions.php');

    $id = filter_input(INPUT_GET, 'id');
    $filterClient = filter_input(INPUT_GET, 'fc');
    $filterEtat = filter_input(INPUT_GET, 'fe');

    $prix = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $prix = filter_input(INPUT_POST, "prix");

        //Insertion des données dans la table
        modificationPrix($id, $prix);
        ?>

        <script language="javascript">
            window.opener.location = "listeAtelier.php?fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>";
            window.self.close();
        </script>

        <?php
    } else {

        $unPrix = unPrix($id);
        foreach ($unPrix as $soluce) {
            $prix = $soluce['prix'];
            if (isset($soluce['prix'])) {
                $prix = $soluce['prix'];
            } else {
                $prix = "";
            }
        }
    }
    ?>

    <body onclick='fermer()'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <form method="post" action="ajoutPrix.php?id=<?php echo $id; ?>&fc=<?= $filterClient ?>&fe=<?= $filterEtat ?>" autocomplete="off">
            <fieldset>
                <legend>Prix</legend>
                <textarea name="prix" rows="5" maxlength='300'><?php echo $prix ?></textarea>
                <br />
            </fieldset>
            <br />
            <input type="submit" name="envoi" value="Envoyer">
            <input type='reset' value='Effacer'>
            <img id="exit" src='img/cross.png' title='Fermer la fenêtre' onclick="window.self.close();"/>
        </p>
    </form>
</body>
</html>