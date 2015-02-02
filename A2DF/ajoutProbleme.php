<html>
    <?php
    include ('private/fonctions.php');

    $id = filter_input(INPUT_GET, 'id');

    $probleme = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $probleme = filter_input(INPUT_POST, "probleme");

        //Insertion des données dans la table
        modificationProbleme($id, $probleme);
        ?>

        <script language="javascript">
            window.opener.location = "listeAtelier.php";
            window.self.close();
        </script>

        <?php
    } else {

        $unProbleme = unProbleme($id);
        foreach ($unProbleme as $soluce) {
            $probleme = $soluce['probleme'];
            if (isset($soluce['probleme'])) {
                $probleme = $soluce['probleme'];
            } else {
                $probleme = "";
            }
        }
    }
    ?>

    <body onclick='fermer()'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <form method="post" action="ajoutProbleme.php?id=<?php echo $id; ?>" autocomplete="off">
            <fieldset>
                <legend>Probleme</legend>
                <textarea name="probleme" rows="5" maxlength='300'><?php echo $probleme ?></textarea>
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