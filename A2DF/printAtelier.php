<?php
setlocale(LC_CTYPE, 'fr_FR.UTF-8');
date_default_timezone_set('UTC');
require('lib/fpdf.php');
include('private/conf.php');

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

$id = filter_input(INPUT_GET, 'id');

global $connexion;
$unAtelier = $connexion->query("SELECT  atelier.idAtelier, atelier.dateEntree,
                                        client.nom AS nomClient, client.prenom AS prenomClient, client.adresse AS adresseClient, client.cp AS cpClient, client.ville AS villeClient,
                                        client.courriel AS courrielClient, client.tel AS telClient, client.portable AS portableClient,
                                        materiel.libelle AS typeProduit, marque.libelle AS marqueProduit, atelier.couleurProduit, atelier.mdpProduit, 
                                        atelier.probleme, atelier.solution, atelier.prix
                                FROM atelier, client, materiel, marque
                                WHERE atelier.idClient = client.idClient
                                AND atelier.typeProduit = materiel.idMateriel
                                AND atelier.marqueProduit = marque.idMarque
                                AND atelier.idAtelier = '$id';");

foreach ($unAtelier as $atelier) {

    //Récupération des données dans la base
    $idAtelier = $atelier['idAtelier'];
    $dateEntree = $atelier['dateEntree'];
    $nomClient = $atelier['nomClient'];
    $prenomClient = $atelier['prenomClient'];
    $adresseClient = $atelier['adresseClient'];
    $cpClient = $atelier['cpClient'];
    $villeClient = $atelier['villeClient'];
    $courrielClient = $atelier['courrielClient'];
    $telClient = $atelier['telClient'];
    $portableClient = $atelier['portableClient'];
    $typeProduit = $atelier['typeProduit'];
    $marqueProduit = $atelier['marqueProduit'];
    $couleurProduit = $atelier['couleurProduit'];
    $mdpProduit = $atelier['mdpProduit'];
    $probleme = $atelier['probleme'];
    $solution = $atelier['solution'];
    $prix = $atelier['prix'];
    $dateConvert = date_create($dateEntree);
    $dateFr = date_format($dateConvert, 'd/m/Y');
}

$border = 0;
$width = 127;
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell($width, 10, 'Fiche Atelier n' . iconv('UTF-8', 'ISO-8859-15', '°') . $idAtelier, 1, 0, 'C');
$pdf->Image('img/a2df.png', 110, 2, 30);
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell($width, 10, 'Fiche Atelier n' . iconv('UTF-8', 'ISO-8859-15', '°') . $idAtelier, 1, 0, 'C');
$pdf->Image('img/a2df.png', 260, 2, 30);
$pdf->Ln(14);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Date : ' . $dateFr, $border);
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Date : ' . $dateFr, $border);
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Client : ' . iconv('UTF-8', 'ISO-8859-15', $nomClient) . " " . iconv('UTF-8', 'ISO-8859-15', $prenomClient), $border);
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Client : ' . iconv('UTF-8', 'ISO-8859-15', $nomClient) . " " . iconv('UTF-8', 'ISO-8859-15', $prenomClient), $border);
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Adresse : ' . iconv('UTF-8', 'ISO-8859-15', $adresseClient) . " " . iconv('UTF-8', 'ISO-8859-15', $cpClient) . " " . iconv('UTF-8', 'ISO-8859-15', $villeClient), $border);
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Adresse : ' . iconv('UTF-8', 'ISO-8859-15', $adresseClient) . " " . iconv('UTF-8', 'ISO-8859-15', $cpClient) . " " . iconv('UTF-8', 'ISO-8859-15', $villeClient), $border);
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Telephone : ' . $telClient, $border);
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Telephone : ' . $telClient, $border);
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Portable : ' . $portableClient, $border);
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Portable : ' . $portableClient, $border);
$pdf->Ln(14);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell($width, 10, 'Machine', 1, 0, 'C');
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell($width, 10, 'Machine', 1, 0, 'C');
$pdf->Ln(14);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Produit : ' . iconv('UTF-8', 'ISO-8859-15', $typeProduit) . " " . iconv('UTF-8', 'ISO-8859-15', $marqueProduit) . " " . iconv('UTF-8', 'ISO-8859-15', $couleurProduit), $border);
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Produit : ' . iconv('UTF-8', 'ISO-8859-15', $typeProduit) . " " . iconv('UTF-8', 'ISO-8859-15', $marqueProduit) . " " . iconv('UTF-8', 'ISO-8859-15', $couleurProduit), $border);
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Mot de passe : ' . iconv('UTF-8', 'ISO-8859-15', $mdpProduit), $border);
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell($width, 10, 'Mot de passe : ' . iconv('UTF-8', 'ISO-8859-15', $mdpProduit), $border);
$pdf->Ln(9);

$pdf->SetFont('Arial', '', 14);
$pdf->MultiCell($width, 6, 'Probleme : ' . iconv('UTF-8', 'ISO-8859-15', $probleme), $border);
$pdf->Ln(1);

$pdf->SetFont('Arial', '', 14);
$pdf->MultiCell($width, 6, 'Solution : ' . iconv('UTF-8', 'ISO-8859-15', $solution), $border);
$pdf->Ln(6);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell($width, 10, 'Prix : ' . $prix . iconv('UTF-8', 'ISO-8859-15', ' euros'), 1, 0, 'C');
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell($width, 10, 'Prix : ' . $prix . iconv('UTF-8', 'ISO-8859-15', ' euros'), 1, 0, 'C');
$pdf->Ln(14);

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(64, 10, 'Signature A2DF : ', $border, 0, 'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(63, 10, 'Signature Client : ', $border, 0, 'C');
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(64, 10, 'Signature A2DF : ', $border, 0, 'C');
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(63, 10, 'Signature Client : ', $border, 0, 'C');
$pdf->Ln(23);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($width, 10, 'A2DF Informatique', $border, 0, 'C');
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($width, 10, 'A2DF Informatique', $border, 0, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell($width, 10, '2 rue des claircontres 44330 LE PALLET', $border, 0, 'C');
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($width, 10, '2 rue des claircontres 44330 LE PALLET', $border, 0, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell($width, 10, '02 40 97 29 61 - www.a2dfinformatique.com', $border, 0, 'C');
$pdf->Cell(23, 10, '', $border, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($width, 10, '02 40 97 29 61 - www.a2dfinformatique.com', $border, 0, 'C');

$pdf->Line(148.5, 0, 148.5, 220);

$pdf->Output();
?>