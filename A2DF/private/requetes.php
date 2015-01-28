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
    $resultat = $connexion->query(" SELECT appel.idAppel, appel.date, client.nom AS nomClient, client.prenom AS prenomClient, client.tel, client.portable, personnel.prenom AS personnel, appel.motif, priorite.libelle, appel.traite, appel.commentaire
                                    FROM appel, client, personnel, priorite
                                    WHERE appel.idClient = client.idClient
                                    AND appel.idPersonnel = personnel.idPersonnel
                                    AND appel.idPriorite = priorite.idPriorite
                                    ORDER BY appel.idAppel DESC;");
    return $resultat;
}

function listeAtelier() {
    global $connexion;
    $resultat = $connexion->query(" SELECT  atelier.idAtelier, atelier.dateEntree, atelier.idClient AS idClient, client.nom AS nomClient, client.prenom AS prenomClient, 
                                            formule.libelle AS libelleFormule, materiel.libelle AS typeProduit, marque.libelle AS marqueProduit, 
                                            atelier.couleurProduit, atelier.mdpProduit, atelier.probleme, priorite.libelle AS libellePriorite, atelier.idTraitement
                                    FROM atelier, client, priorite, materiel, marque, formule
                                    WHERE atelier.idClient = client.idClient
                                    AND atelier.idPriorite = priorite.idPriorite
                                    AND atelier.typeProduit = materiel.idMateriel
                                    AND atelier.marqueProduit = marque.idMarque
                                    AND atelier.idFormule = formule.idFormule
                                    ORDER BY atelier.idAtelier DESC;");
    return $resultat;
}

function listeCommande() {
    global $connexion;
    $resultat = $connexion->query(" SELECT  commande.idCommande, commande.dateCommande, commande.dateBonCommande, commande.idClient as idClient, 
                                            client.nom AS nomClient, client.prenom AS prenomClient, commande.typeProduit, commande.marqueProduit, 
                                            commande.couleurProduit, commande.prix, commande.acompte, commande.idTraitement, commande.traite
                                    FROM commande, client
                                    WHERE client.idClient = commande.idClient
                                    ORDER BY commande.idCommande DESC;");
    return $resultat;
}
    
    function unClient($idClient) {
    global $connexion;
    $resultat = $connexion->query(" SELECT nom, prenom, adresse, cp, ville, tel, portable
                                    FROM client
                                    WHERE idClient = $idClient");
    return $resultat;
}

function ajoutCommande($date, $idClient, $typeProduit, $marqueProduit, $couleurProduit, $prix, $acompte) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO commande (date, idClient, typeProduit, marqueProduit, couleurProduit, prix, acompte)
                                    VALUES ('$date', '$idClient', '$typeProduit', '$marqueProduit', '$couleurProduit','$prix', '$acompte');");
    return $resultat;
}

function ajoutAppel($date, $idClient, $idPersonnel, $motif, $idPriorite) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO appel (date, idClient, idPersonnel, motif, idPriorite)
                                    VALUES ('$date', '$idClient', '$idPersonnel', \"$motif\", '$idPriorite');");
    return $resultat;
}

function ajoutAtelier($date, $client, $formule, $typeProduit, $marqueProduit, $couleurProduit, $mdpProduit, $probleme, $priorite) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO atelier (dateEntree, idClient, idFormule, typeProduit, marqueProduit, couleurProduit, mdpProduit, probleme, idPriorite, idTraitement)
                                    VALUES ('$date', '$client', '$formule', \"$typeProduit\", \"$marqueProduit\", \"$couleurProduit\", \"$mdpProduit\", \"$probleme\", '$priorite', 1);");
    return $resultat;
}

function ajoutClient($nom, $prenom, $adresse, $cp, $ville, $courriel, $tel, $portable) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO client (nom, prenom, adresse, cp, ville, courriel, tel, portable)
                                    VALUES (\"$nom\", \"$prenom\", \"$adresse\", \"$cp\", \"$ville\", '$courriel', '$tel', '$portable');");
    return $resultat;
}

function modificationClient($idClient, $nom, $prenom, $adresse, $cp, $ville, $courriel, $tel, $portable) {
    global $connexion;
    $resultat = $connexion->exec("  UPDATE client
                                    SET nom = \"$nom\", prenom = \"$prenom\", adresse = \"$adresse\", cp = \"$cp\", ville = \"$ville\", courriel = '$courriel', tel = '$tel', portable = '$portable'
                                    WHERE idClient = $idClient;");
    return $resultat;
}

function ajoutCommentaire($idAppel, $commentaire) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE appel
                                    SET commentaire = \"$commentaire\"
                                    WHERE idAppel = $idAppel;");
    return $resultat;
}

function comboboxClient() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idClient, nom, prenom
                                    FROM client
                                    ORDER BY client.nom ASC;");
    return $resultat;
}

function comboboxMateriel() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idMateriel, libelle
                                    FROM materiel
                                    ORDER BY materiel.libelle ASC;");
    return $resultat;
}

function comboboxMarque() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idMarque, libelle
                                    FROM marque
                                    ORDER BY marque.libelle ASC;");
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

function comboboxFormule() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idFormule, libelle 
                                    FROM formule
                                    ORDER BY formule.idFormule ASC;");
    return $resultat;
}

function etatDepannage($idAtelier) {
    global $connexion;
    $resultat = $connexion->query(" SELECT idTraitement
                                    FROM atelier
                                    WHERE idAtelier = $idAtelier;");
    return $resultat;
}

function traiterAppel($idAppel) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE appel
                                    SET traite = 1
                                    WHERE idAppel = $idAppel;");
    return $resultat;
}

function traiterAtelier($idAtelier, $etat) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE atelier
                                    SET idTraitement = $etat + 1
                                    WHERE idAtelier = $idAtelier;");
    return $resultat;
}

?>
