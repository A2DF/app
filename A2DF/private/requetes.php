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

function login($user, $pass) {
    global $connexion;
    $resultat = $connexion->query(" SELECT login, mdp
                                    FROM session
                                    WHERE login = '$user'
                                    AND mdp = '$pass'");
    return $resultat;
}

function listeAppel() {
    global $connexion;
    $resultat = $connexion->query(" SELECT appel.idAppel, appel.date, appel.idClient AS idClient, client.nom AS nomClient, client.prenom AS prenomClient, client.tel, client.portable, personnel.prenom AS personnel, appel.motif, priorite.libelle, appel.traite, appel.commentaire
                                    FROM appel, client, personnel, priorite
                                    WHERE appel.idClient = client.idClient
                                    AND appel.idPersonnel = personnel.idPersonnel
                                    AND appel.idPriorite = priorite.idPriorite
                                    ORDER BY appel.date DESC;");
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
                                    ORDER BY atelier.idTraitement, atelier.dateEntree ASC;");
    return $resultat;
}

function listeSav() {
    global $connexion;
    $resultat = $connexion->query(" SELECT sav.idSAV, sav.date, sav.dateAction, sav.idClient AS idClient, client.nom AS nomClient, client.prenom AS prenomClient, sav.typeProduit, sav.marqueProduit, sav.couleurProduit, sav.mdpProduit, sav.numSerie, sav.probleme, sav.idEtat
                                    FROM sav, client
                                    WHERE sav.idClient = client.idClient ORDER BY sav.idEtat, sav.date ASC;");
    
    return $resultat;
}

function listeCommande() {
    global $connexion;
    $resultat = $connexion->query(" SELECT  commande.idCommande, commande.dateCommande, commande.dateBonCommande, commande.idClient as idClient, 
                                            client.nom AS nomClient, client.prenom AS prenomClient, commande.typeProduit, commande.marqueProduit, 
                                            commande.couleurProduit, commande.quantite, commande.prix, commande.acompte, commande.idTraitement, commande.traite
                                    FROM commande, client
                                    WHERE client.idClient = commande.idClient
                                    ORDER BY commande.dateCommande DESC;");
    return $resultat;
}

function listeClient() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idClient, nom, prenom, adresse, cp, ville, courriel, tel, portable
                                    FROM client
                                    ORDER BY client.nom ASC;");
    return $resultat;
}

function listePret() {
    global $connexion;
    $resultat = $connexion->query(" SELECT pret.idPret, pret.datePret, pret.dateRetour, pret.idClient as idClient, client.nom AS nomClient, client.prenom AS prenomClient, marque.libelle AS marqueProduit, materiel.libelle AS typeProduit, pret.couleurProduit, pret.reference, pret.motif, pret.etat FROM pret, client, marque, materiel WHERE client.idClient = pret.idClient AND marque.idMarque = pret.marqueProduit AND materiel.idMateriel = pret.typeProduit ORDER BY pret.datePret DESC;");
    return $resultat;
}

function listeFournisseur() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idFournisseur, nom, adresse, cp, ville, courriel, tel, portable, login, mdp
                                    FROM fournisseur
                                    ORDER BY fournisseur.nom ASC;");
    return $resultat;
}

function listePersonnel() {
    global $connexion;
    $resultat = $connexion->query(" SELECT  personnel.idPersonnel, personnel.dateEmbauche, personnel.nom, personnel.prenom, 
                                            personnel.adresse, personnel.cp, personnel.ville, personnel.courriel, 
                                            personnel.tel, personnel.portable, personnel.numSecu, personnel.contrat, personnel.salaire, personnel.traite
                                    FROM personnel
                                    ORDER BY personnel.nom ASC;");
    return $resultat;
}

function listeVente() {
    global $connexion;
    $resultat = $connexion->query(" SELECT  vente.idVente, vente.dateVente, vente.dateLivraison, vente.idClient as idClient, 
                                            client.nom AS nomClient, client.prenom AS prenomClient, vente.typeProduit, vente.marqueProduit, 
                                            vente.couleurProduit, vente.reference, vente.quantite, vente.prix, vente.acompte, vente.idTraitement, vente.traite
                                    FROM vente, client
                                    WHERE client.idClient = vente.idClient
                                    ORDER BY vente.dateVente DESC;");
    return $resultat;
}

function listeProduit() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idProduit, produit.libelle, produit.idType, type.libelle AS type, marque.libelle AS marque, prix, image, etat, info1, info2, info3, info4, info5, info6, info7, info8
                                    FROM produit, type, marque
                                    WHERE produit.idType = type.idType
                                    AND produit.idMarque = marque.idMarque
                                    ORDER BY produit.idType, produit.idMarque, produit.libelle ASC;");
    return $resultat;
}

function unClient($idClient) {
    global $connexion;
    $resultat = $connexion->query(" SELECT nom, prenom, adresse, cp, ville, courriel, tel, portable
                                    FROM client
                                    WHERE idClient = $idClient");
    return $resultat;
}

function unFournisseur($idFournisseur) {
    global $connexion;
    $resultat = $connexion->query(" SELECT nom, adresse, cp, ville, courriel, tel, portable, login, mdp
                                    FROM fournisseur
                                    WHERE idFournisseur = $idFournisseur");
    return $resultat;
}

function unPersonnel($idPersonnel) {
    global $connexion;
    $resultat = $connexion->query(" SELECT dateEmbauche, nom, prenom, adresse, cp, ville, courriel, tel, portable, numSecu, contrat, salaire
                                    FROM personnel
                                    WHERE idPersonnel = $idPersonnel");
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
    $resultat = $connexion->exec("  INSERT INTO vente (dateVente, dateLivraison, idClient, typeProduit, marqueProduit, couleurProduit, reference, quantite, prix, acompte)
                                    VALUES ('$dateVente', '$dateLivraison', '$idClient', \"$typeProduit\", \"$marqueProduit\", \"$couleurProduit\", \"$reference\", '$quantite', '$prix', '$acompte');");
    return $resultat;
}

function ajoutPret($datePret, $dateRetour, $idClient, $typeProduit, $marqueProduit, $couleurProduit, $reference, $motif) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO pret (datePret, dateRetour, idClient, typeProduit, marqueProduit, couleurProduit, reference, motif)
                                    VALUES ('$datePret', '$dateRetour', '$idClient', \"$typeProduit\", \"$marqueProduit\", \"$couleurProduit\", \"$reference\", \"$motif\");");
    return $resultat;
}

function ajoutAppel($date, $idClient, $idPersonnel, $motif, $idPriorite) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO appel (date, idClient, idPersonnel, motif, idPriorite)
                                    VALUES ('$date', '$idClient', '$idPersonnel', \"$motif\", '$idPriorite');");
    return $resultat;
}

function ajoutSav($date, $idClient, $typeProduit, $marqueProduit, $couleurProduit, $mdpProduit, $numSerie, $probleme) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO sav (date, idClient, typeProduit, marqueProduit, couleurProduit, mdpProduit, numSerie, probleme)
                                    VALUES ('$date', '$idClient', \"$typeProduit\", \"$marqueProduit\", \"$couleurProduit\", \"$mdpProduit\", \"$numSerie\", \"$probleme\");");
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

function ajoutFournisseur($nom, $adresse, $cp, $ville, $courriel, $tel, $portable, $login, $mdp) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO fournisseur (nom, adresse, cp, ville, courriel, tel, portable, login, mdp)
                                    VALUES (\"$nom\", \"$adresse\", \"$cp\", \"$ville\", '$courriel', '$tel', '$portable', '$login', '$mdp');");
    return $resultat;
}

function ajoutPersonnel($dateEmbauche, $nom, $prenom, $adresse, $cp, $ville, $courriel, $tel, $portable, $numSecu, $contrat, $salaire) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO personnel (dateEmbauche, nom, prenom, adresse, cp, ville, courriel, tel, portable, numSecu, contrat, salaire)
                                    VALUES ('$dateEmbauche',\"$nom\", \"$prenom\", \"$adresse\", \"$cp\", \"$ville\", '$courriel', '$tel', '$portable', '$numSecu', '$contrat', '$salaire');");
    return $resultat;
}

function ajoutProduit($libelle, $type, $marque, $prix, $etat, $image, $info1, $info2, $info3, $info4, $info5, $info6, $info7, $info8) {
    global $connexion;
    $resultat = $connexion->exec("  INSERT INTO produit (libelle, idType, idMarque, prix, image, etat, info1, info2, info3, info4, info5, info6, info7, info8)
                                    VALUES (\"$libelle\", \"$type\", \"$marque\", '$prix', \"$image\", '$etat', \"$info1\", \"$info2\", \"$info3\", \"$info4\", \"$info5\", \"$info6\", \"$info7\", \"$info8\");");
    return $resultat;
}

function modificationClient($idClient, $nom, $prenom, $adresse, $cp, $ville, $courriel, $tel, $portable) {
    global $connexion;
    $resultat = $connexion->exec("  UPDATE client
                                    SET nom = \"$nom\", prenom = \"$prenom\", adresse = \"$adresse\", cp = \"$cp\", ville = \"$ville\", courriel = '$courriel', tel = '$tel', portable = '$portable'
                                    WHERE idClient = $idClient;");
    return $resultat;
}

function modificationFournisseur($idFournisseur, $nom, $adresse, $cp, $ville, $courriel, $tel, $portable, $login, $mdp) {
    global $connexion;
    $resultat = $connexion->exec("  UPDATE fournisseur
                                    SET nom = \"$nom\", adresse = \"$adresse\", cp = \"$cp\", ville = \"$ville\", courriel = '$courriel', tel = '$tel', portable = '$portable', login = '$login', mdp = '$mdp'
                                    WHERE idFournisseur = $idFournisseur;");
    return $resultat;
}

function modificationPersonnel($idPersonnel, $dateEmbauche, $nom, $prenom, $adresse, $cp, $ville, $courriel, $tel, $portable, $numSecu, $contrat, $salaire) {
    global $connexion;
    $resultat = $connexion->exec("  UPDATE personnel
                                    SET dateEmbauche = '$dateEmbauche', nom = \"$nom\", prenom = \"$prenom\", adresse = \"$adresse\", cp = \"$cp\", ville = \"$ville\", courriel = '$courriel', tel = '$tel', portable = '$portable', numSecu = '$numSecu', contrat = \"$contrat\", salaire = '$salaire'
                                    WHERE idPersonnel = $idPersonnel;");
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

function comboboxFournisseur() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idFournisseur, nom
                                    FROM fournisseur
                                    ORDER BY fournisseur.nom ASC;");
    return $resultat;
}

function comboboxMateriel() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idMateriel, libelle
                                    FROM materiel
                                    ORDER BY materiel.libelle ASC;");
    return $resultat;
}

function comboboxType() {
    global $connexion;
    $resultat = $connexion->query(" SELECT idType, libelle
                                    FROM type
                                    ORDER BY idType ASC;");
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
                                    WHERE traite = 0
                                    ORDER BY personnel.prenom ASC;");
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

function lastAtelier($client) {
    global $connexion;
    $resultat = $connexion->query(" SELECT MAX(idAtelier) AS idAtelier
                                    FROM atelier
                                    WHERE idClient = $client;");
    return $resultat;
}

function lastClient($nom) {
    global $connexion;
    $resultat = $connexion->query(" SELECT MAX(idClient) AS idClient
                                    FROM client
                                    WHERE nom = '$nom';");
    return $resultat;
}

function traiterAppel($idAppel) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE appel
                                    SET traite = 1
                                    WHERE idAppel = $idAppel;");
    return $resultat;
}

function traiterSav($idSAV, $etat) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE sav
                                    SET idEtat = $etat + 1
                                    WHERE idSAV = $idSAV;");
    return $resultat;
}

function payerCommande($idCommande) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE commande
                                    SET traite = 1
                                    WHERE idCommande = $idCommande;");
    return $resultat;
}

function payerVente($idVente) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE vente
                                    SET traite = 1
                                    WHERE idVente = $idVente;");
    return $resultat;
}

function traiterCommande($idCommande, $etat) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE commande
                                    SET idTraitement = $etat + 1
                                    WHERE idCommande = $idCommande;");
    return $resultat;
}

function traiterPret($idPret, $etat) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE pret
                                    SET etat = $etat + 1
                                    WHERE idPret = $idPret;");
    return $resultat;
}

function traiterVente($idVente, $etat) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE vente
                                    SET idTraitement = $etat + 1
                                    WHERE idVente = $idVente;");
    return $resultat;
}

function traiterProduit($idProduit) {
    global $connexion;
    $resultat = $connexion->query(" DELETE FROM produit
                                    WHERE idProduit = $idProduit");
    return $resultat;
}

function traiterPersonnel($idPersonnel) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE personnel
                                    SET traite = 1
                                    WHERE idPersonnel = $idPersonnel;");
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

function ajoutDateAction($idSAV, $today_int) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE sav
                                    SET dateAction = '$today_int'
                                    WHERE idSAV = $idSAV;");
    return $resultat;
}

function mdpDirection() {
    global $connexion;
    $resultat = $connexion->query(" SELECT mdp
                                    FROM session
                                    WHERE login = 'direction';");
    return $resultat;
}

function modifierMdpDirection($mdp) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE session
                                    SET mdp = '$mdp'
                                    WHERE login = 'direction';");
    return $resultat;
}

function modifierMdpAccueil($mdp) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE session
                                    SET mdp = '$mdp'
                                    WHERE login = 'accueil';");
    return $resultat;
}

function modifierMdpAtelier($mdp) {
    global $connexion;
    $resultat = $connexion->query(" UPDATE session
                                    SET mdp = '$mdp'
                                    WHERE login = 'atelier';");
    return $resultat;
}

?>