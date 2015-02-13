<?php
include ('../private/requetes.php');
header("Content-type: text/xml");
$xml = "<?xml version='1.0' encoding='UTF-8'?>\n\n";
$xml.= "<produits>\n";

$listeProduit = listeProduit();
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

//Affichage des données
    $xml.= "\t<produit";
    $xml.= " id=\"" . $idProduit . "\"";
    $xml.= " libelle=\"" . $libelle . "\"";
    $xml.= " type=\"" . $type . "\"";
    $xml.= " marque=\"" . $marque . "\"";
    $xml.= " prix=\"" . $prix . "\"";
    $xml.= " etat=\"" . $etat . "\"";
    $xml.= " image=\"" . $image . "\"";
    $xml.= " info1=\"" . $info1 . "\"";
    $xml.= " info2=\"" . $info2 . "\"";
    $xml.= " info3=\"" . $info3 . "\"";
    $xml.= " info4=\"" . $info4 . "\"";
    $xml.= " info5=\"" . $info5 . "\"";
    $xml.= " >\n";
    $xml.= "\t</produit>\n";
}

$xml.= "</produits>\n";
echo $xml;
?>