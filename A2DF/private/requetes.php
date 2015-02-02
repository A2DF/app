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
    $resultat = $connexion->query(" SELECT  atelier.idAtelier, atelier.dateEntree, atelier.idClient AS idClient, priorite.libelle AS libellePriorite, 
                                            client.nom AS nomClient, client.prenom AS prenomClient, 
                                            materiel.libelle AS typeProduit, marque.libelle AS marqueProduit, 
                                            atelier.couleurProduit, atelier.mdpProduit, atelier.probleme, atelier.solution, atelier.prix, atelier.idTraitement
                                    FROM atelier, client, priorite, materiel, marque
                                    WHERE atelier.idClient = client.idClient
                                    AND atelier.idPriorite = priorite.idPriorite
                                    AND atelier.typeProduit = materiel.idMateriel
                                    AND atelier.marqueProduit = marque.idMarque
                                    ORDER BY atelier.idTraitement ASC;");
    return $resultat;
}

function listeCommande() {
    global $connexion;
    $resultat = $connexion->query(" SELECT  commande.idCommande, commande.dateCommande, commande.dateBonCommande, commande.idClient as idClient, 
                                            client.nom AS nomClient, client.prenom AS prenomClient, commande.typeProduit, commande.marqueProduit, 
                                            commande.couleurProduit, commande.quantite, commande.prix, commande.acompte, commande.idTraitement, commande.traite
                                    FROM commande, client
                                    WHERE client.idClient = commande.idClient
                                    ORDER BY commande.idCommande DESC;");
    return $resultat;
}

function listeVente() {
    global $connexion;
    $resultat = $connexion->query(" SELECT  vente.idVente, vente.dateVente, vente.dateLivraison, vente.idClient as idClient, 
                                            client.nom AS nomClient, client.prenom AS prenomClient, vente.typeProduit, vente.marqueProduit, 
                                            vente.couleurProduit, vente.reference, vente.quantite, vente.prix, vente.acompte, vente.idTraitement, vente.traite
                                    FROM vente, client
                                    WHERE client.idClient = vente.idClient
                                    ORDER BY vente.idVente DESC;");
    return $resultat;
}

function unClient($idClient) {
    global $connexion;
    $resultat = $connexion->query(" SELECT nom, prenom, adresse, cp, ville, courriel, tel, portable
                                    FROM client
                                    WHERE idClient = $idClient");
    return $resultat;
}

function unProbleme($idAtelier) {
    global $connexion;
    $resultat = $connexion->query(" SELECT probleme
                                    FROM atelier
                                    WHERE idAtelier = $idAtelier");
    return $resultat;
}

function uneSolution($idAtelier) {
    global $connexion;
    $resultat = $connexion->query(" SELECT solution
                                    FROM atelier
                                    WHERE idAtelier = $idAtelier");
    return $resultat;
}

function unPrix($idAtelier) {
    global $connexion;
    $resultat = $connexion->query(" SELECT prix
                                    FROM atelier
                                    WHERE idAtelier = $idAtelier");
    return $resultat;
}

function ajoutCommande($dateCommande, $idClient, $typeProduit, $marqueProduit, $couleurProduit, $quantite, $prix, $acompte) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO commande (dateCommande, idClient, typeProduit, marqueProduit, couleurProduit, quantite, prix, acompte)
                                    VALUES ('$dateCommande', '$idClient', \"$typeProduit\", \"$marqueProduit\", \"$couleurProduit\", '$quantite', '$prix', '$acompte');");
    return $resultat;
}

function ajoutVente($dateVente, $dateLivraison, $idClient, $typeProduit, $marqueProduit, $couleurProduit, $reference, $quantite, $prix, $acompte) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO commande (dateVente, dateLivraison, idClient, typeProduit, marqueProduit, couleurProduit, reference, quantite, prix, acompte)
                                    VALUES ('$dateVente', '$dateLivraison', '$idClient', \"$typeProduit\", \"$marqueProduit\", \"$couleurProduit\", \"$reference\", '$quantite', '$prix', '$acompte');");
    return $resultat;
}

function ajoutAppel($date, $idClient, $idPersonnel, $motif, $idPriorite) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO appel (date, idClient, idPersonnel, motif, idPriorite)
                                    VALUES ('$date', '$idClient', '$idPersonnel', \"$motif\", '$idPriorite');");
    return $resultat;
}

function ajoutAtelier($date, $client, $priorite, $typeProduit, $marqueProduit, $couleurProduit, $mdpProduit, $probleme, $solution, $prix) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO atelier (dateEntree, idClient, idPriorite, typeProduit, marqueProduit, couleurProduit, mdpProduit, probleme, solution, prix, idTraitement)
                                    VALUES ('$date', '$client', '$priorite', \"$typeProduit\", \"$marqueProduit\", \"$couleurProduit\", \"$mdpProduit\", \"$probleme\", \"$solution\", \"$prix\", 1);");
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

function modificationProbleme($idAtelier, $probleme) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE atelier
                                    SET probleme = \"$probleme\"
                                    WHERE idAtelier = $idAtelier;");
    return $resultat;
}

function modificationSolution($idAtelier, $solution) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE atelier
                                    SET solution = \"$solution\"
                                    WHERE idAtelier = $idAtelier;");
    return $resultat;
}

function modificationPrix($idAtelier, $prix) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE atelier
                                    SET prix = \"$prix\"
                                    WHERE idAtelier = $idAtelier;");
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

function payerCommande($idCommande) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE commande
                                    SET traite = 1
                                    WHERE idCommande = $idCommande;");
    return $resultat;
}

function traiterCommande($idCommande, $etat) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE commande
                                    SET idTraitement = $etat + 1
                                    WHERE idCommande = $idCommande;");
    return $resultat;
}

function traiterAtelier($idAtelier, $etat) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE atelier
                                    SET idTraitement = $etat + 1
                                    WHERE idAtelier = $idAtelier;");
    return $resultat;
}

function ajoutDateBonCommande($idCommande, $today_int) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE commande
                                    SET dateBonCommande = '$today_int'
                                    WHERE idCommande = $idCommande;");
    return $resultat;
}

?>
