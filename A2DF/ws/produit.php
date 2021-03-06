<?php

include ('../private/conf.php');
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

global $connexion;
$listeProduit = $connexion->query(" SELECT idProduit, produit.libelle, produit.idType, type.libelle AS type, marque.libelle AS marque, prix, image, etat, info1, info2, info3, info4, info5, info6, info7, info8
                                    FROM produit, type, marque
                                    WHERE produit.idType = type.idType
                                    AND produit.idMarque = marque.idMarque
                                    ORDER BY produit.idProduit DESC;");

$statutMagasin = $connexion->query("SELECT online
                                    FROM magasin;");

foreach ($statutMagasin as $statut) {
    $online = $statut['online'];
}

header("Content-type: text/xml");
$xml = "<?xml version='1.0' encoding='UTF-8'?>";
$xml.= "<magasin>";
$xml.= "<online>" . $online . "</online>";

if ($online == 1) {
    $xml.= "<produits>";

    foreach ($listeProduit as $produit) {

//Récupération des données dans la base
        $idProduit = $produit['idProduit'];
        $libelle = $produit['libelle'];
        $typeid = $produit['idType'];
        $type = $produit['type'];
        $marque = $produit['marque'];
        $prix = $produit['prix'];
        $etat = $produit['etat'];
        $image = $produit['image'];
        $info1 = $produit['info1'];
        $info2 = $produit['info2'];
        $info3 = $produit['info3'];
        $info4 = $produit['info4'];
        $info5 = $produit['info5'];
        $info6 = $produit['info6'];
        $info7 = $produit['info7'];
        $info8 = $produit['info8'];

//Affichage des données
        $xml.= "<produit>";
        $xml.= "<id>" . $idProduit . "</id>";
        $xml.= "<libelle>" . $libelle . "</libelle>";
        $xml.= "<type>" . $typeid . "</type>";
        $xml.= "<marque>" . $marque . "</marque>";
        $xml.= "<prix>" . $prix . "</prix>";
        $xml.= "<etat>" . $etat . "</etat>";
        $xml.= "<image>" . $image . "</image>";
        $xml.= "<info1>" . $info1 . "</info1>";
        $xml.= "<info2>" . $info2 . "</info2>";
        $xml.= "<info3>" . $info3 . "</info3>";
        $xml.= "<info4>" . $info4 . "</info4>";
        $xml.= "<info5>" . $info5 . "</info5>";
        $xml.= "<info6>" . $info6 . "</info6>";
        $xml.= "<info7>" . $info7 . "</info7>";
        $xml.= "<info8>" . $info8 . "</info8>";
        $xml.= "</produit>";
    }
    $xml.= "</produits>";
}
$xml.= "</magasin>";
echo $xml;
?>