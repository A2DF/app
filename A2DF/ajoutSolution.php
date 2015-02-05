<html>
    <?php
    include ('private/fonctions.php');

    $id = filter_input(INPUT_GET, 'id');

    $solution = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $solution = filter_input(INPUT_POST, "solution");

        //Insertion des données dans la table
        modificationSolution($id, $solution);
        ?>

        <script language="javascript">
            window.opener.location = "listeAtelier.php";
            window.self.close();
        </script>

        <?php
    } else {

        $uneSolution = uneSolution($id);
        foreach ($uneSolution as $soluce) {
            $solution = $soluce['solution'];
            if (isset($soluce['solution'])) {
                $solution = $soluce['solution'];
            } else {
                $solution = "";
            }
        }
    }
    ?>

    <body onclick='fermer()'>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no" />
        <link href="css/formulaires.css" rel="stylesheet" type="text/css">
        <form method="post" action="ajoutSolution.php?id=<?= $id ?>" autocomplete="off">
            <fieldset>
                <legend>Solution</legend>
                <textarea name="solution" rows="5" maxlength='300'><?= $solution ?></textarea>
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
