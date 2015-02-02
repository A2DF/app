<html>
    <?php
    include ('private/fonctions.php');

    $id = filter_input(INPUT_GET, 'id');

    $commentaire = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $commentaire = filter_input(INPUT_POST, "commentaire");

        //Insertion des données dans la table
        ajoutCommentaire($id, $commentaire);
        ?>

        <script language="javascript">
            window.opener.location = "listeAppel.php";
            window.self.close();
        </script>

        <?php
    }
    ?>

    <body onclick='fermer()'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <form method="post" action="ajoutCommentaire.php?id=<?php echo $id; ?>" autocomplete="off">
            <fieldset>
                <legend>Commentaire</legend>
                <textarea name="commentaire" rows="5" maxlength='300'><?php echo $commentaire ?></textarea>
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
