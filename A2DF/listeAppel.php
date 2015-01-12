<html>

    <?php
    include ('html/head.html');
    include ('private/requetes.php');
    ?>

    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <script src="js/sorttable.js"></script>
    <body>
        <h1>Liste des appels</h1><a href="ajoutAppel.php"><img src="img/telephone_add.png" title="Ajouter un appel"/></a>

        <?php
        //Affichage de la première ligne du tableau
        echo "<table border='1' class='sortable'>";
        echo "<tr>";
        echo "<th id='date'>Date</th>";
        echo "<th id='client'>Client</th>";
        echo "<th id='numero'>Numero</th>";
        echo "<th id='pour'>Pour</th>";
        echo "<th id='motif'>Motif</th>";
        echo "<th id='commentaire'>Priorite</th>";
        echo "</tr>";

        $listeAppel = listeAppel();
        foreach ($listeAppel as $appel) {

            //Récupération des données dans la base
            $date = $appel['date'];
            $client = $appel['idClient'];
            $numero = $appel['idClient'];
            $personnel = $appel['idPersonnel'];
            $motif = $appel['motif'];
            $priorite = $appel['idPriorite'];

            //Affichage des données dans le tableau
            echo "<tr>";
            echo "<td>" . $date . "</td>";
            echo "<td>" . $client . "</td>";
            echo "<td>" . $numero . "</td>";
            echo "<td>" . $personnel . "</td>";
            echo "<td>" . $motif . "</td>";
            echo "<td>" . $priorite . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        ?>

    </body>
</html>