<?php

include('conf.php');

define('USER', $mysql_user);
define('MDP', $mysql_pass);
define('DSN', $mysql_host);
try {
    $connexion = new PDO(DSN, USER, MDP);
    $connexion->query("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br />";
    $connexion = null;
}

function listeAppel(){
    global $connexion;
    $resultat = $connexion->query(" SELECT appel.date, client.nom AS client, client.tel, personnel.nom AS personnel, appel.motif, priorite.libelle
                                    FROM appel, client, personnel, priorite
                                    WHERE appel.idClient = client.idClient
                                    AND appel.idPersonnel = personnel.idPersonnel
                                    AND appel.idPriorite = priorite.idPriorite
                                    ORDER BY appel.idAppel ASC;");
    return $resultat;
}

function ajoutAppel(){
    global $connexion;
    $resultat = $connexion->query(" SELECT * 
                                    FROM appel
                                    ORDER BY appel.idAppel ASC;");
    return $resultat;
}

function comboboxPersonnel(){
    global $connexion;
    $resultat = $connexion->query(" SELECT * 
                                    FROM appel
                                    ORDER BY appel.idAppel ASC;");
    return $resultat;
}
?>
