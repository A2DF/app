<?php
include ('html/head.html');
?>
<html>
    <link href="css/listes.css" rel="stylesheet" type="text/css">
    <body>
        <section>
        <h1>Liste des appels</h1>
        <?php
        //Affichage de la première ligne du tableau
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th id='date'>Date</th>";
            echo "<th id='client'>Client</th>";
            echo "<th id='numero'>Numero</th>";
            echo "<th id='pour'>Pour</th>";
            echo "<th id='statut'>Statut</th>";
            echo "<th id='commentaire'>Commentaire</th>";
            echo "</tr>";
            echo "</table>";
        ?>
        </section>
    </body>
</html>