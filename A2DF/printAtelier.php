<?php

require('lib/fpdf.php');

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

$id = filter_input(INPUT_GET, 'id');

global $connexion;
$unAtelier = $connexion->query(" SELECT  atelier.idAtelier, atelier.dateEntree, atelier.idClient AS idClient, priorite.libelle AS libellePriorite, 
                                            client.nom AS nomClient, client.prenom AS prenomClient, 
                                            materiel.libelle AS typeProduit, marque.libelle AS marqueProduit, 
                                            atelier.couleurProduit, atelier.mdpProduit, atelier.probleme, atelier.solution, atelier.prix, atelier.idTraitement
                                    FROM atelier, client, priorite, materiel, marque
                                    WHERE atelier.idClient = client.idClient
                                    AND atelier.idPriorite = priorite.idPriorite
                                    AND atelier.typeProduit = materiel.idMateriel
                                    AND atelier.marqueProduit = marque.idMarque
                                    ORDER BY atelier.idAtelier DESC;");

            foreach ($unAtelier as $atelier) {

                //Récupération des données dans la base
                $idAtelier = $atelier['idAtelier'];
                $dateEntree = $atelier['dateEntree'];
                $priorite = $atelier['libellePriorite'];
                $idClient = $atelier['idClient'];
                $nomClient = $atelier['nomClient'];
                $prenomClient = $atelier['prenomClient'];
                $typeProduit = $atelier['typeProduit'];
                $marqueProduit = $atelier['marqueProduit'];
                $couleurProduit = $atelier['couleurProduit'];
                $mdpProduit = $atelier['mdpProduit'];
                $probleme = $atelier['probleme'];
                $solution = $atelier['solution'];
                $prix = $atelier['prix'];

            }


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Hello World !');
$pdf->Output();
?>