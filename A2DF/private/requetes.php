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

function listeAppel() {
    global $connexion;
    $resultat = $connexion->query(" SELECT appel.idAppel, appel.date, client.nom AS nomClient, client.prenom AS prenomClient, client.tel, client.portable, personnel.prenom AS personnel, appel.motif, priorite.libelle, appel.traite
                                    FROM appel, client, personnel, priorite
                                    WHERE appel.idClient = client.idClient
                                    AND appel.idPersonnel = personnel.idPersonnel
                                    AND appel.idPriorite = priorite.idPriorite
                                    ORDER BY appel.idAppel ASC;");
    return $resultat;
}

function ajoutAppel($date, $idClient, $idPersonnel, $motif, $idPriorite) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO appel (date, idClient, idPersonnel, motif, idPriorite)
                                    VALUES ('$date', '$idClient', '$idPersonnel', '$motif', '$idPriorite');");
    return $resultat;
}

function ajoutClient($nom, $prenom, $adresse, $cp, $ville, $courriel, $tel, $portable) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO client (nom, prenom, adresse, cp, ville, courriel, tel, portable)
                                    VALUES ('$nom', '$prenom', '$adresse', '$cp', '$ville', '$courriel', '$tel', '$portable');");
    return $resultat;
}

function comboboxClient() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idClient, nom, prenom
                                    FROM client
                                    ORDER BY client.nom ASC;");
    return $resultat;
}

function comboboxPersonnel() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idPersonnel, prenom 
                                    FROM personnel
                                    ORDER BY personnel.idStatut ASC;");
    return $resultat;
}

function comboboxPriorite() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idPriorite, libelle 
                                    FROM priorite
                                    ORDER BY priorite.idPriorite ASC;");
    return $resultat;
}

function traiterAppel($idAppel) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE appel
                                    SET traite = 1
                                    WHERE idAppel = $idAppel;");
    return $resultat;
}

?>
